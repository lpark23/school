<?php
class ClassModel extends BaseModel
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

    public function checkTerm($term)
    {
        $stmTermCheck = self::$db->prepare("SELECT ID, term FROM terms WHERE term = ?");
        $stmTermCheck->bind_param("s", $term);
        $stmTermCheck->execute();
        $result = $stmTermCheck->get_result()->fetch_assoc();
        if($result['term'] != $term){
            $stmInsertTerm = self::$db->prepare("INSERT INTO terms (term) VALUES (?)");
            $stmInsertTerm->bind_param("s", $term);
            $stmInsertTerm->execute();
            return $insertIdTerm = self::$db->insert_id;
        }
        else{
            return $insertIdTerm = $result['ID'];
        }
    }

    public function checkTermYear($termyear)
    {
        $stmTermYearCheck = self::$db->prepare("SELECT ID, termYear FROM termyear WHERE termYear = ?");
        $stmTermYearCheck->bind_param("s", $termyear);
        $stmTermYearCheck->execute();
        $result = $stmTermYearCheck->get_result()->fetch_assoc();
        if($result['termYear'] != $termyear){
            $stmInsertTermYear = self::$db->prepare("INSERT INTO termyear (termYear) VALUES (?)");
            $stmInsertTermYear->bind_param("s", $termyear);
            $stmInsertTermYear->execute();
            return $insertIdTermYear = self::$db->insert_id;
        }
        else{
            return $insertIdTermYear = $result['ID'];
        }
    }

    public function createStudyPeriod($termID, $termYearID): bool
    {
        $termm = $this->checkTerm($termID);
        $termy = $this->checkTermYear($termYearID);
        $checkTermAndYear = self::$db->prepare("SELECT termID , termYearID  FROM studyperiod " .
            "WHERE termID = ? AND termYearID = ?");
        $checkTermAndYear->bind_param("ii", $termm, $termy );
        $checkTermAndYear->execute();
        $LastResult = $checkTermAndYear->get_result()->fetch_assoc();
        if (($LastResult['termID'] != $termm) && ($LastResult['termYearID'] != $termy)){
            $stmInsertStudyPeriod = self::$db->prepare("INSERT INTO studyperiod (termID, termYearID) " .
                "VALUES (?, ?)");
            $stmInsertStudyPeriod->bind_param("ii", $termm, $termy);
            $stmInsertStudyPeriod->execute();
            if($stmInsertStudyPeriod->affected_rows !=1){
                return false;
            }else{
                $studyPeriodID = self::$db->query("SELECT LAST_INSERT_ID()")->fetch_row()[0];
                $_SESSION['studyperiod'] = $studyPeriodID;
                return $stmInsertStudyPeriod->affected_rows == 1;
            }
        }
        else{
            return false;
        }
    }

    public function getStudyPeriod() : array
    {
        $statement = self::$db->query(
            "SELECT DISTINCT studyperiod.ID as studyPeriodID ,term, termYear " .
            "FROM class INNER JOIN studyperiod ON class.studyPeriodID = studyperiod.ID
            INNER JOIN terms ON studyperiod.termID = terms.ID
            INNER JOIN termyear ON studyperiod.termYearID = termyear.ID
            ORDER BY termyear.termYear ASC ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getClassNumber() : array
    {
        $statement = self::$db->query(
            "SELECT * " .
            "FROM classnumbers ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getClassLetter() : array
    {
        $statement = self::$db->query(
            "SELECT * " .
            "FROM classletters ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function createClassGroup(int $numberID,int $letterID) : bool
    {
        $stmInsertClassGroup = self::$db->prepare("INSERT INTO classgroup (numberID, letterID) " .
            "VALUES (?, ?)");
        $stmInsertClassGroup->bind_param("ii", $numberID, $letterID);
        $stmInsertClassGroup->execute();
        if($stmInsertClassGroup->affected_rows !=1){
            return false;
        }else{
            $classGroupID = self::$db->query("SELECT LAST_INSERT_ID()")->fetch_row()[0];
            $_SESSION['classGroupID'] = $classGroupID;
            return $stmInsertClassGroup->affected_rows == 1;
        }
    }

    public function selectClassLetter()
    {
        $statement = self::$db->query("SELECT  classgroup.ID as classID , classletters.ID as letterID, ".
            "classLetterType as letterType, numberID " .
            "FROM classletters INNER JOIN classgroup ON classletters.ID = classgroup.letterID " .
            "INNER JOIN classnumbers ON classgroup.numberID = classnumbers.ID;");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function selectClassNumber()
    {
        $statement = self::$db->query("SELECT * FROM classnumbers");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function selectClassByNumber($period)
    {
        $statement = self::$db->query("SELECT DISTINCT classNumberType, classnumbers.ID as classnumberID " .
            "FROM classletters INNER JOIN classgroup ON classletters.ID = classgroup.letterID
            INNER JOIN classnumbers ON classgroup.numberID = classnumbers.ID
            INNER JOIN class ON classgroup.ID = class.classgroupID
            INNER JOIN studyperiod ON class.studyPeriodID = studyperiod.ID
                WHERE studyperiod.ID = $period");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function classLetterByNumber($number)
    {
        $statement = self::$db->query("SELECT classLetterType, classletters.ID as classLetterID, classgroup.ID as grpID   " .
            "FROM classletters INNER JOIN classgroup ON classletters.ID = classgroup.letterID
            INNER JOIN classnumbers ON classgroup.numberID = classnumbers.ID
            INNER JOIN class ON classgroup.ID = class.classgroupID
            INNER JOIN studyperiod ON class.studyPeriodID = studyperiod.ID
            WHERE classnumbers.ID = $number");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getClassGroup() : array
    {
        $statement = self::$db->query("SELECT classgroup.ID as classID, numberID, letterID, ".
            "classNumberType as numberType, classLetterType as letterType " .
            "FROM classgroup " .
            "INNER JOIN classnumbers ON classgroup.numberID = classnumbers.ID " .
            "INNER JOIN classletters ON classgroup.letterID = classletters.ID;");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getClassGroupBy(int $classID) : array
    {
        $statement = self::$db->query("SELECT classgroup.ID as classID, numberID, letterID, ".
            "classNumberType as numberType, classLetterType as letterType " .
            "FROM classgroup " .
            "INNER JOIN classnumbers ON classgroup.numberID = classnumbers.ID " .
            "INNER JOIN classletters ON classgroup.letterID = classletters.ID " .
            "WHERE classgroup.ID = $classID");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function setExamMark($studentID, $teacherID, $subjectID, $mark)
    {
        $stmInsertExamMak = self::$db->prepare(
            "INSERT INTO evaluation(StudentID, TeacherID, SubjectID, exammark)VALUE (?,?,?,?)");
        $stmInsertExamMak->bind_param("iiii", $studentID, $teacherID, $subjectID, $mark);
        $stmInsertExamMak->execute();
        if($stmInsertExamMak->affected_rows !=1){
            return false;
        }else{
            return $stmInsertExamMak->affected_rows == 1;
        }
    }

    public function getEvaluationBy(int $markID) :array
    {
        $statement = self::$db->prepare(
            "SELECT * FROM evaluation WHERE ID = $markID;");
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return  $result;
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

    public function getStudentBy(int $classgrp,int $period) :array
    {
        $statement = self::$db->query("SELECT persons.ID as PersonID, Fname, Lname, class.ID as ClassID, studyPeriodID, " .
            " classgroupID, students.ID as studentID , studentnumber, users.ID as userID, username " .
            "FROM students INNER JOIN persons ON students.PersonID = persons.ID " .
            "INNER JOIN users ON persons.UserID = users.ID " .
            "INNER JOIN  class ON students.classID = class.ID " .
            "WHERE classgroupID = $classgrp and studyPeriodID = $period");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getStudentSubjects(int $personid) : array
    {
        $statement = self::$db->query("SELECT DISTINCT subjects.ID as subjectID, subjects.Name as subName " .
            "FROM persons INNER JOIN students ON persons.ID = students.PersonID
            INNER JOIN evaluation ON students.ID = evaluation.StudentID
            INNER JOIN subjects ON evaluation.SubjectID = subjects.ID
            WHERE persons.ID = $personid ;");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function teachersConects(int $teacherID) : array
    {
        $statement = self::$db->query("SELECT * " .
            "FROM teaching INNER JOIN class ON teaching.ClassID = class.ID " .
            "INNER JOIN teachers ON teaching.TeacherID = teachers.ID " .
            "INNER JOIN persons ON teachers.PersonID = persons.ID " .
            "INNER JOIN teach ON teachers.ID = teach.TeacherID " .
            "INNER JOIN subjects ON teach.SubjectID = subjects.ID " .
            "WHERE teachers.ID = $teacherID ;");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function teachersteachingBy(int $subject) : array
    {
        $statement = self::$db->prepare("SELECT * " .
            "FROM teaching INNER JOIN class ON teaching.ClassID = class.ID " .
            "INNER JOIN teachers ON teaching.TeacherID = teachers.ID " .
            "INNER JOIN persons ON teachers.PersonID = persons.ID " .
            "INNER JOIN teach ON teachers.ID = teach.TeacherID " .
            "INNER JOIN subjects ON teach.SubjectID = subjects.ID " .
            "WHERE SubjectID = $subject ;");
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function teachersConectsBy(int $classgrp, int $period,int $teacherID) : array
    {
        $statement = self::$db->query("SELECT * " .
            "FROM subjects INNER JOIN teach ON subjects.ID = teach.SubjectID " .
            "INNER JOIN teachers ON teach.TeacherID = teachers.ID " .
            "INNER JOIN persons ON teachers.PersonID = persons.ID " .
            "INNER JOIN teaching ON teachers.ID = teaching.TeacherID " .
            "INNER JOIN class ON teaching.ClassID = class.ID " .
            "WHERE classgroupID = $classgrp AND studyPeriodID = $period AND teachers.ID = $teacherID ;");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getStudentByID(int $studentID) :array
    {
        $statement = self::$db->query("SELECT persons.ID as PersonID, Fname, Lname, class.ID as ClassID, studyPeriodID, " .
            " classgroupID, studentnumber, users.ID as userID, username  " .
            "FROM students INNER JOIN persons ON students.PersonID = persons.ID " .
            "INNER JOIN users ON persons.UserID = users.ID " .
            "INNER JOIN  class ON students.classID = class.ID " .
            "WHERE students.ID = $studentID ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getClassBy(int $classID, int $period) : array
    {
        $statement = self::$db->query("SELECT class.ID as ClassID, classNumberType as numberType, classLetterType as letterType, " .
            "term, termYear, s.Fname as sFname, s.Lname as sLname, subjects.Name as subjectName, subjects.ABB as subjectABB , " .
            "students.ID as StudentID, studentnumber as studNumber , classgroupID, studyPeriodID, " .
            "evaluation.ID as MarkID,exammark as Mark, examdate as MarkDate, " .
            "teachers.ID as TeacherID, t.Fname as tFname, t.Lname as tLname, " .
            "present.ID as presentID , present.StudentID as presentStudentID, present.TeacherID as presentTeacherID, " .
            "present.ClassID as presenClassID, present.SubjectID as presentSubjectID, present , subjects.ID as subjectID  " .
            "FROM class INNER JOIN classgroup ON class.classgroupID = classgroup.ID " .
            "INNER JOIN classletters ON classgroup.letterID = classletters.ID " .
            "INNER JOIN classnumbers ON classgroup.numberID = classnumbers.ID " .
            "INNER JOIN studyperiod ON class.studyPeriodID = studyperiod.ID " .
            "INNER JOIN terms ON studyperiod.termID = terms.ID " .
            "INNER JOIN termyear ON studyperiod.termYearID = termyear.ID " .
            "INNER JOIN students ON class.ID = students.classID " .
            "INNER JOIN persons s ON students.PersonID = s.ID " .
            "LEFT JOIN evaluation ON students.ID = evaluation.StudentID " .
            "LEFT JOIN teachers ON evaluation.TeacherID = teachers.ID " .
            "LEFT JOIN persons t ON teachers.PersonID = t.ID " .
            "LEFT JOIN subjects ON evaluation.SubjectID = subjects.ID " .
            "LEFT JOIN present ON students.ID = present.StudentID " .
            "WHERE classgroupID = $classID AND studyPeriodID = $period " .
            "ORDER BY sFname, subjectName ASC ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function updateEvaluation($editmark,$markID) : bool
    {
        $statement = self::$db->prepare("UPDATE evaluation SET exammark = ?, examdate = CURRENT_TIMESTAMP " .
            "WHERE ID = ?;");
        $statement->bind_param("ii", $editmark, $markID);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

    public function deleteEvaluation($markIDdelete) : bool
    {
        $statement = self::$db->prepare(
            "DELETE FROM evaluation WHERE ID = ?");
        $statement->bind_param("i", $markIDdelete);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

    public function createSubject($subject, $abb)
    {
        $subjectConvert = mb_convert_case(mb_convert_case($subject,1),2);
        $abbConvert = mb_convert_case($abb,0);
        $stmSubjectCheck = self::$db->prepare("SELECT ID, Name, ABB FROM subjects WHERE Name = ?");
        $stmSubjectCheck->bind_param("s", $subjectConvert);
        $stmSubjectCheck->execute();
        $result = $stmSubjectCheck->get_result()->fetch_assoc();

        if($result['Name'] != $subjectConvert || $result['ABB'] != $abbConvert){
            $stmInsertSubject = self::$db->prepare("INSERT INTO subjects (Name, ABB) VALUES (? , ?)");
            $stmInsertSubject->bind_param("ss",$subjectConvert, $abbConvert);
            $stmInsertSubject->execute();
            return $insertIdSubject = self::$db->insert_id;
        }
        else{
            return $insertIdSubject = $result['ID'];
        }
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

    public function getHomeClassBy(int $personid) :array
    {
        $statement = self::$db->prepare("SELECT classgroupID , studyPeriodID " .
            "FROM class INNER JOIN students ON class.ID = students.classID " .
            "INNER JOIN persons ON students.PersonID = persons.ID " .
            "WHERE students.ID = $personid");
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return  $result;
    }
}