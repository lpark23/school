<?php

class UsersModel extends BaseModel
{
    public function getSchool() : array
    {
        $statement = self::$db->prepare(
            "SELECT name, countryName, cityName, streetName " .
            "FROM schools INNER JOIN address ON schools.addressID = address.ID " .
            "INNER JOIN countries ON address.countryID = countries.ID " .
            "INNER JOIN cities ON address.cityID = cities.ID " .
            "INNER JOIN streets ON address.streetID = streets.ID " .
            "WHERE schools.ID = 1");
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function login(string $username, string $password)
    {
        $statement = self::$db->prepare(
            "SELECT id, password_hash FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();


        if(password_verify($password, $result['password_hash']))
            {
            return $result['id'];
            }
        else return false;
    }

    public function getPositionById(int $id)
    {
        $statement = self::$db->prepare(
            "SELECT users.ID, username, email, positionID,status,type " .
            "FROM users " .
            "INNER JOIN position ON users.positionID = position.ID " .
            "WHERE users.ID = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }
    
    public function register(string $username, string $password, string $email)
    {
        $username = mb_convert_case($username,1);

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $statement = self::$db->prepare(
            "INSERT INTO users(username, password_hash, email) VALUES (?,?,?)");
        $statement->bind_param("sss", $username, $password_hash, $email);
        $statement->execute();
        if($statement->affected_rows !=1)
            return false;
        $userid = self::$db->query("SELECT LAST_INSERT_ID()")->fetch_row()[0];
        return $userid;
    }

    public function getAllTeachers() : array
    {
        $statement = self::$db->query(
            "SELECT users.ID as UserID, persons.ID as PersonID, teachers.ID as TeacherID, Fname, Lname, PhoneN, " .
            "cities.cityName as city,username, position.ID as positionID ,position.type as positionType " .
            "FROM teachers INNER JOIN  persons ON teachers.PersonID = persons.ID " .
            "INNER JOIN users ON persons.UserID = users.ID " .
            "INNER JOIN position ON teachers.positionID = position.ID " .
            "INNER JOIN address ON persons.AdressID = address.ID " .
            "INNER JOIN cities ON address.cityID = cities.ID " .
            "INNER JOIN countries ON address.countryID = countries.ID " .
            "INNER JOIN streets ON address.streetID = streets.ID ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserBy(int $personid) : array
    {

        $statement = self::$db->query("SELECT users.ID as UserID, username, Fname, Lname  " .
            "FROM users LEFT JOIN persons ON users.ID = persons.UserID " .
            "LEFT JOIN teachers ON persons.ID = teachers.PersonID " .
            "LEFT JOIN students ON persons.ID = students.PersonID " .
            "LEFT JOIN parents ON persons.ID = parents.personID " .
            "WHERE persons.ID = $personid ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getTecherClassBy(int $teacherid) : array
    {
        $statement = self::$db->query(
            "SELECT terms.term as classterm, termYear as classtermYear, classNumberType, classLetterType " .
            "FROM class " .
            "INNER JOIN classgroup ON class.classgroupID = classgroup.ID " .
            "INNER JOIN classnumbers ON classgroup.numberID = classnumbers.ID " .
            "INNER JOIN classletters ON classgroup.letterID = classletters.ID " .
            "INNER JOIN studyperiod ON class.studyPeriodID = studyperiod.ID " .
            "INNER JOIN terms ON studyperiod.termID = terms.ID " . 
            "INNER JOIN termyear ON studyperiod.termYearID = termyear.ID " .
            "INNER JOIN teaching ON class.ID = teaching.ClassID " .
            "INNER JOIN teachers ON teaching.TeacherID = teachers.ID " .
            "WHERE teachers.ID = $teacherid");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getTecherSubjectBy(int $teacherid) : array
    {
        $statement = self::$db->query("SELECT * " .
            "FROM subjects " .
            "INNER JOIN teach ON subjects.ID = teach.SubjectID " .
            "INNER JOIN teachers ON teach.TeacherID = teachers.ID " . 
            "WHERE teachers.ID = $teacherid");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getSubjects() : array
    {
        $statement = self::$db->query("SELECT * FROM subjects");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getSubjectBy(int $subject) :array
    {
        $statement = self::$db->prepare(
            "SELECT * " . "FROM subjects WHERE ID =  $subject ;");
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return  $result;
    }

    public function getClsGrpStpBy(int $personsid)
    {
        $statement = self::$db->prepare(
            "SELECT classgroup.ID as classgroupID, studyperiod.ID as studyperiodID " .
            "FROM
              students INNER JOIN persons  ON students.PersonID = persons.ID
              INNER JOIN users ON persons.UserID = users.ID
              INNER JOIN class ON students.classID = class.ID
              INNER JOIN studyperiod ON class.studyPeriodID = studyperiod.ID
              INNER JOIN terms ON studyperiod.termID = terms.ID
              INNER JOIN termyear ON studyperiod.termYearID = termyear.ID
              INNER JOIN classgroup ON class.classgroupID = classgroup.ID
              INNER JOIN classnumbers ON classgroup.numberID = classnumbers.ID
              INNER JOIN classletters ON classgroup.letterID = classletters.ID
            WHERE persons.ID = ?");
        $statement->bind_param("i", $personsid);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function getStudEvaluationBy(int $personid, int $subject) :array
    {
        $statement = self::$db->prepare(
            "SELECT * " ."FROM evaluation WHERE StudentID = $personid AND SubjectID = $subject " .
            "ORDER BY examdate DESC");
        $statement->execute();
        $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
        return  $result;
    }

    public function getAllStudents(int $classgrp,int $classstp) : array
    {
        $statement = self::$db->query("SELECT students.ID as StudentID, s.ID as PersonID, studentnumber, classNumberType as numberType, " .
            "classLetterType as letterType, terms.term as term, termyear.termYear as termYear, s.Fname, s.Mname, s.Lname, " .
            "s.DOB, s.egn, s.PhoneN, countryName, cityName, streetName, position.type as positionType, formmaster.TeacherID as mssterTeacherID, " .
            "classmanagers.StudentID as managerStudentID, t.Fname as teacherFname, t.Lname as teacherLname, username, " .
            "users.ID as UserID, position.ID as PositionID  " .
            "FROM students INNER JOIN persons s ON students.PersonID = s.ID " .
            "INNER JOIN users ON s.UserID = users.ID " .
            "INNER JOIN position ON students.positionID = position.ID " .
            "INNER JOIN address ON s.AdressID = address.ID " .
            "INNER JOIN countries ON address.countryID = countries.ID " .
            "INNER JOIN cities ON address.cityID = cities.ID " .
            "INNER JOIN streets ON address.streetID = streets.ID " .
            "INNER JOIN class ON students.classID = class.ID " .
            "INNER JOIN studyperiod ON class.studyPeriodID = studyperiod.ID " .
            "INNER JOIN terms ON studyperiod.termID = terms.ID " .
            "INNER JOIN termyear ON studyperiod.termYearID = termyear.ID " .
            "INNER JOIN classgroup ON class.classgroupID = classgroup.ID " .
            "INNER JOIN classnumbers ON classgroup.numberID = classnumbers.ID " .
            "INNER JOIN classletters ON classgroup.letterID = classletters.ID " .
            "LEFT JOIN formmaster ON class.formMasterID = formmaster.ID " .
            "LEFT JOIN teachers ON formmaster.TeacherID = teachers.ID " .
            "left JOIN persons t ON teachers.PersonID = t.ID " .
            "LEFT JOIN classmanagers ON class.classManegerID = classmanagers.ID " .
            "WHERE classgroup.ID = $classgrp and studyperiod.ID = $classstp ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllParents() : array 
    {
        $statement = self::$db->query("SELECT Fname, Mname, Lname, DOB, gender, PhoneN, egn, " .
            "position.type as positionType, countryName, cityName, streetName " .
            "FROM parents INNER JOIN persons ON parents.personID = persons.ID " .
            "INNER JOIN position ON parents.positionID = position.ID " .
            "INNER JOIN address ON persons.AdressID = address.ID " .
            "INNER JOIN countries ON address.countryID = countries.ID " .
            "INNER JOIN cities ON address.cityID = cities.ID " .
            "INNER JOIN streets ON address.streetID = streets.ID");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getProfileById(int $id)
    {
        $statement = self::$db->prepare(
            "SELECT persons.ID as pid, UserID, Fname, Mname, Lname, persons.status as pstatus, username, positionID, users.status as ustatus " . 
            "FROM persons INNER JOIN address  ON persons.AdressID = address.ID " .
            "INNER JOIN users ON persons.UserID = users.ID " .
            "INNER JOIN countries ON address.countryID = countries.ID " .
            "INNER JOIN cities ON address.cityID = cities.ID " .
            "INNER JOIN streets ON address.streetID = streets.ID " .
            "INNER JOIN position ON position.ID = users.positionID " .
            "WHERE UserID = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function setPosition($profileID,$position)
    {
        $statement = self::$db->query("SELECT ID FROM $position  WHERE PersonID = $profileID");
        return $statement->fetch_row()[0];
    }

    public function getPosition() : array
    {
        $statement = self::$db->query("SELECT * FROM  position");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getAll() : array
    {
        $statement = self::$db->query("SELECT * " .
            "FROM persons INNER JOIN address  ON persons.AdressID = address.ID
            INNER JOIN users ON persons.UserID = users.ID
            INNER JOIN countries ON address.countryID = countries.ID
            INNER JOIN cities ON address.cityID = cities.ID
            INNER JOIN streets ON address.streetID = streets.ID
            INNER JOIN position ON position.ID = users.positionID");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllUsers() : array
    {
        $statement = self::$db->query("SELECT username FROM users");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }







}
