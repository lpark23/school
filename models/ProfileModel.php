<?php
class ProfileModel extends BaseModel
{
    public function getAllAddress() : array
    {
        $statement = self::$db->query(
            "SELECT address.ID, countryName, cityName, streetName " .
            "FROM address INNER JOIN countries ON address.countryID = countries.ID " .
            "INNER JOIN cities ON address.cityID = cities.ID " .
            "INNER JOIN streets ON address.streetID = streets.ID " .
            "ORDER BY ID");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

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

    public function getAllCity() : array
    {
        $statement = self::$db->query(
            "SELECT * FROM cities ORDER BY cityName ASC ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllProfile() : array
    {
        $statement = self::$db->query(
            "SELECT * " .
            "FROM persons INNER JOIN address  ON persons.AdressID = address.ID " .
            "INNER JOIN users ON persons.UserID = users.ID " .
            "INNER JOIN countries ON address.countryID = countries.ID " .
            "INNER JOIN cities ON address.cityID = cities.ID " .
            "INNER JOIN streets ON address.streetID = streets.ID " .
            "INNER JOIN position ON position.ID = users.positionID");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function checkProfileSet() : array
    {
        $statement = self::$db->query("SELECT * " .
            "FROM persons INNER JOIN address  ON persons.AdressID = address.ID " .
            "INNER JOIN users ON persons.UserID = users.ID " .
            "INNER JOIN countries ON address.countryID = countries.ID " .
            "INNER JOIN cities ON address.cityID = cities.ID " .
            "INNER JOIN streets ON address.streetID = streets.ID " .
            "INNER JOIN position ON position.ID = users.positionID ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getPersonClass(int $id)
    {
        $statement = self::$db->prepare(
            "SELECT classNumberType as numberType, classLetterType as letterType " .
            "FROM persons INNER JOIN users ON persons.UserID = users.ID " .
            "INNER JOIN students ON persons.ID = students.PersonID
                INNER JOIN class ON students.classID = class.ID
                INNER JOIN studyperiod ON class.studyPeriodID = studyperiod.ID
                INNER JOIN terms ON studyperiod.termID = terms.ID
                INNER JOIN termyear ON studyperiod.termYearID = termyear.ID
                INNER JOIN classgroup ON class.classgroupID = classgroup.ID
                INNER JOIN classnumbers ON classgroup.numberID = classnumbers.ID
                INNER JOIN classletters ON classgroup.letterID = classletters.ID
                WHERE users.ID = ?; ");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function getStudEvaluationBy(int $pid,int $subject) :array
    {
        $statement = self::$db->prepare(
            "SELECT exammark ,  examdate " .
            "FROM evaluation INNER JOIN subjects ON evaluation.SubjectID = subjects.ID
            INNER JOIN students ON evaluation.StudentID = students.ID
            INNER JOIN persons ON students.PersonID = persons.ID
            WHERE persons.ID = $pid AND subjects.ID = $subject
            ORDER BY examdate DESC ");
        $statement->execute();
        $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
        return  $result;
    }

    public function getSubjectBy(int $subject) :array
    {
        $statement = self::$db->prepare(
            "SELECT * " . "FROM subjects WHERE ID =  $subject ;");
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return  $result;
    }

    public function getPersonTeacherByUserId($id)
    {
        $statement = self::$db->prepare("SELECT persons.ID as personID , UserID, Fname, Lname, Mname, DOB, gender, " .
            "PhoneN, egn, teachers.ID as TeacherID, username, email, dateofcreate as userDate, " .
            "position.ID as PositionID, position.type as PositionType " .
            "FROM persons " .
            "INNER JOIN teachers ON persons.ID = teachers.PersonID " .
            "INNER JOIN users ON persons.UserID = users.ID " .
            "INNER JOIN position ON teachers.positionID = position.ID " .
            "WHERE users.ID = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function getPersonByUserId(int $id)
    {
        $statement = self::$db->prepare(
            "SELECT username,users.status as tatoos,persons.ID as pid,Fname,Mname,Lname,persons.status as pstatus, " .
            "DOB,egn, gender, email,dateofcreate, countryName,cityName, streetName, users.status as ustatus, " .
            "PhoneN , address.ID as addressID, positionID, users.ID as userID    
            FROM persons INNER JOIN address  ON persons.AdressID = address.ID 
            INNER JOIN users ON persons.UserID = users.ID 
            INNER JOIN countries ON address.countryID = countries.ID 
            INNER JOIN cities ON address.cityID = cities.ID 
            INNER JOIN streets ON address.streetID = streets.ID 
            WHERE UserID = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }



    public function getPositiondByUser(int $id)
    {
        $statement = self::$db->prepare("SELECT users.ID as userID, position.type as positionType, position.ID as positionID  " .
            "FROM users INNER JOIN position ON users.positionID = position.ID " .
            "WHERE users.ID = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function setParentConection(string  $parenttype,int  $studentID,int $parentID) :bool
    {
        $typeConvert = mb_convert_case(mb_convert_case($parenttype,1),2);
        $statement = self::$db->prepare("INSERT INTO familyconnect (connectType, StudentID, ParentID) VALUES (? ,?, ?)");
        $statement->bind_param("sii", $typeConvert, $studentID, $parentID);
        $statement->execute();
        if ($statement->affected_rows !=1){
            return false;
        }
        else{
            return $statement->affected_rows == 1;
        }
    }

    public function kidProfile(int $id) : array
    {
        $statement = self::$db->query("SELECT s.ID as personStudentID, s.Fname as personStudentFname, ".
            "s.Lname as personStudentLname, s.Mname as personStudentMname, classNumberType as numberType, " .
            "classLetterType as letterType, terms.term as term, termyear.termYear as termyear, s.UserID as userid,  " .
            "familyconnect.ID as famID  
            FROM students
            INNER JOIN persons s ON students.PersonID = s.ID
            INNER JOIN familyconnect ON students.ID = familyconnect.StudentID
            INNER JOIN parents ON familyconnect.ParentID = parents.ID
            INNER JOIN persons p ON parents.personID = p.ID
            INNER JOIN class ON students.classID = class.ID
            INNER JOIN classgroup ON class.classgroupID = classgroup.ID
            INNER JOIN classletters ON classgroup.letterID = classletters.ID
            INNER JOIN classnumbers ON classgroup.numberID = classnumbers.ID
            INNER JOIN studyperiod ON class.studyPeriodID = studyperiod.ID
            INNER JOIN terms ON studyperiod.termID = terms.ID
            INNER JOIN termyear ON studyperiod.termYearID = termyear.ID
            WHERE parents.ID = $id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getParents(int $userID) : array
    {
        $statement = self::$db->query("SELECT p.Fname as parentFname, p.Lname as parentLname , connectType as type, " .
            "p.UserID as parentUserID " .
            "FROM familyconnect INNER JOIN students ON familyconnect.StudentID = students.ID
            INNER JOIN persons pp ON students.PersonID = pp.ID
            INNER JOIN users ON pp.UserID = users.ID
            LEFT JOIN parents ON familyconnect.ParentID = parents.ID
            LEFT JOIN persons p ON parents.personID = p.ID
            WHERE pp.UserID = $userID");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getParent(int $id) : array
    {
        $statement = self::$db->query("SELECT p.Fname as parentFname, p.Lname as parentLname, connectType, " .
            "p.UserID as useridparent 
            FROM parents INNER JOIN familyconnect ON parents.ID = familyconnect.ParentID
            INNER JOIN persons p ON parents.personID = p.ID
            INNER JOIN students ON familyconnect.StudentID = students.ID
            INNER JOIN persons s ON students.PersonID = s.ID 
            INNER JOIN users ON s.UserID = users.ID
            WHERE users.ID =  $id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function searchEGN($search) : array
    {
        $statement = self::$db->query("SELECT users.ID as userID, Fname, Lname, Mname, students.ID as studID, egn " .
            "FROM users INNER JOIN persons ON users.ID = persons.UserID
            INNER JOIN students ON persons.ID = students.PersonID
            WHERE egn LIKE '%$search%'");
        return $statement->fetch_all(MYSQLI_ASSOC);

    }

    public function getProfileById(int $id)
    {
        $statement = self::$db->prepare(
            "SELECT username,users.status as tatoos,persons.ID as pid,Fname,Mname,Lname,persons.status as pstatus, " .
            "DOB,egn, gender, email,dateofcreate, countryName,cityName, streetName, position.ID as posID, " .
            "position.type as ptype, users.status as ustatus, students.ID as studentID, parents.ID as parentID, " .
            "teachers.ID as teacherID , students.classID as SClassID,formmaster.ID as FMID, formmaster.ClassID as FClassID, ".
            "formmaster.TeacherID as FTeacherID, teaching.ID as TTeachingID, " .
            "PhoneN , address.ID as addressID, users.ID as userid, familyconnect.connectType as parentType   " .
            "FROM persons INNER JOIN address  ON persons.AdressID = address.ID " .
            "INNER JOIN users ON persons.UserID = users.ID " .
            "INNER JOIN countries ON address.countryID = countries.ID " .
            "INNER JOIN cities ON address.cityID = cities.ID " .
            "INNER JOIN streets ON address.streetID = streets.ID " .
            "LEFT JOIN teachers ON persons.ID = teachers.PersonID " .
            "LEFT JOIN students ON persons.ID = students.PersonID ".
            "LEFT JOIN parents ON persons.ID = parents.personID " .
            "LEFT JOIN familyconnect ON parents.ID = familyconnect.ParentID " .
            "LEFT JOIN position ON users.positionID = position.ID " .
            "LEFT JOIN class ON students.classID = class.ID " .
            "LEFT JOIN formmaster ON class.formMasterID = formmaster.ID " .
            "LEFT JOIN teaching ON class.ID = teaching.ClassID " .
            "WHERE UserID = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function createProfile($userId, $fname, $mname, $lname, $dateofbirth, $egn, $AddressID, $gender, $phoneN) :bool
    {
        $fnameConvert = mb_convert_case(mb_convert_case($fname,1),2);
        $mnameConvert = mb_convert_case(mb_convert_case($mname,1),2);
        $lnameConvert = mb_convert_case(mb_convert_case($lname,1),2);
        $stmCreateProfile = self::$db->prepare(
            "INSERT INTO persons (ID, UserID, Fname, Mname, Lname, DOB, gender, PhoneN, AdressID, egn) " .
            "VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
        $stmCreateProfile->bind_param("issssssis", $userId,$fnameConvert,$mnameConvert, $lnameConvert, $dateofbirth, $gender, $phoneN, $AddressID, $egn);
        $stmCreateProfile->execute();
        if($stmCreateProfile->affected_rows !=1){
            return false;
        }else{
            $ProfileID = self::$db->query("SELECT LAST_INSERT_ID()")->fetch_row()[0];
            $_SESSION['profileID'] = $ProfileID;
            $profileStatus = self::$db->query("SELECT status FROM persons WHERE ID = $ProfileID");
            $_SESSION['isreg'] = $profileStatus;
            return $stmCreateProfile->affected_rows == 1;
        }
    }

    public function createAddress($country, $city, $street) : bool
    {
        $countryConvert = mb_convert_case(mb_convert_case($country,1),2);
        $q = self::$db->prepare("SELECT ID, countryName FROM countries WHERE countryName = ?");
        $q->bind_param("s", $countryConvert);
        $q->execute();
        $result = $q->get_result()->fetch_assoc();
        if($result['countryName'] != $countryConvert){
            $stmInsertCountry = self::$db->prepare("INSERT INTO countries (countryName) VALUES (?)");
            $stmInsertCountry->bind_param("s",$countryConvert);
            $stmInsertCountry->execute();
            $insertIdCountry = self::$db->insert_id;
        }
        else{
            $insertIdCountry = $result['ID'];
        }

        $cityConvert = mb_convert_case(mb_convert_case($city,1),2);
        $qq = self::$db->prepare("SELECT ID, cityName FROM cities WHERE cityName = ?");
        $qq->bind_param("s", $cityConvert);
        $qq->execute();
        $resultt = $qq->get_result()->fetch_assoc();
        var_dump($resultt);
        if($resultt['cityName'] != $cityConvert){
            $stmInsertCity = self::$db->prepare("INSERT INTO cities (cityName) VALUES (?)");
            $stmInsertCity->bind_param("s", $cityConvert);
            $stmInsertCity->execute();
            $insertIdCity = self::$db->insert_id;
        }
        else{
            $insertIdCity = $resultt['ID'];
        }

        $streetConvert = mb_convert_case(mb_convert_case($street,1),2);
        $qqq = self::$db->prepare("SELECT ID, streetName FROM streets WHERE streetName = ?");
        $qqq->bind_param("s", $streetConvert);
        $qqq->execute();
        $resulttt = $qqq->get_result()->fetch_assoc();
        var_dump($resulttt);
        if($resulttt['streetName'] != $streetConvert){
            $stmInsertStreet = self::$db->prepare("INSERT INTO streets (streetName) VALUES (?)");
            $stmInsertStreet->bind_param("s", $streetConvert);
            $stmInsertStreet->execute();
            $insertIdStreet = self::$db->insert_id;
        }
        else{
            $insertIdStreet = $resulttt['ID'];

        }

        $stmInsertAddress = self::$db->prepare("INSERT INTO address (countryID, cityID, streetID) " .
            "VALUES (?, ?, ?)");
        $stmInsertAddress->bind_param("iii", $insertIdCountry, $insertIdCity, $insertIdStreet);
        $stmInsertAddress->execute();
        if($stmInsertAddress->affected_rows !=1){
            return false;
        }else{
            $AddressID = self::$db->query("SELECT LAST_INSERT_ID()")->fetch_row()[0];
            $_SESSION['addressID'] = $AddressID;
            return $stmInsertAddress->affected_rows == 1;
        }
    }

    public function editAddress($country, $city, $street, $addressID) : bool
    {
        $q = self::$db->prepare("SELECT ID, countryName FROM countries WHERE countryName = ?");
        $q->bind_param("s", $country);
        $q->execute();
        $result = $q->get_result()->fetch_assoc();

        if($result['countryName'] != $country){
            $stmInsertCountry = self::$db->prepare("INSERT INTO countries (countryName) VALUES (?)");
            $stmInsertCountry->bind_param("s", $country);
            $stmInsertCountry->execute();
            $insertIdCountry = self::$db->insert_id;
        }
        else{
            $insertIdCountry = $result['ID'];
        }

        $qq = self::$db->prepare("SELECT ID, cityName FROM cities WHERE cityName = ?");
        $qq->bind_param("s", $city);
        $qq->execute();
        $resultt = $qq->get_result()->fetch_assoc();

        if($resultt['cityName'] != $city){
            $stmInsertCity = self::$db->prepare("INSERT INTO cities (cityName) VALUES (?)");
            $stmInsertCity->bind_param("s", $city);
            $stmInsertCity->execute();
            $insertIdCity = self::$db->insert_id;
        }
        else{
            $insertIdCity = $resultt['ID'];
        }

        $qqq = self::$db->prepare("SELECT ID, streetName FROM streets WHERE streetName = ?");
        $qqq->bind_param("s", $street);
        $qqq->execute();
        $resulttt = $qqq->get_result()->fetch_assoc();

        if($resulttt['streetName'] != $street){
            $stmInsertStreet = self::$db->prepare("INSERT INTO streets (streetName) VALUES (?)");
            $stmInsertStreet->bind_param("s", $street);
            $stmInsertStreet->execute();
            $insertIdStreet = self::$db->insert_id;
        }
        else{
            $insertIdStreet = $resulttt['ID'];

        }

        $stmUpdateAddress = self::$db->prepare("UPDATE address SET " .
            " countryID = ?, cityID = ?, streetID= ? WHERE  ID = ?");
        $stmUpdateAddress->bind_param("iiii", $insertIdCountry, $insertIdCity, $insertIdStreet, $addressID);
        $stmUpdateAddress->execute();
        return $stmUpdateAddress->affected_rows >= 0;
    }

    public function getClassGroup() : array
    {
        $statement = self::$db->query("SELECT classgroup.ID as ID,classLetterType as letter, classNumberType as number " .
            "FROM classgroup INNER JOIN classnumbers ON classgroup.numberID = classnumbers.ID " .
            "INNER JOIN classletters ON classgroup.letterID = classletters.ID");
        return $statement->fetch_all(MYSQLI_ASSOC);
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

    public function editProfile($fname, $mname, $lname, $dateofbirth, $egn, $gender, $phoneN, $profileID) : bool
    {
        $stmCreateProfile = self::$db->prepare(
            "UPDATE persons SET Fname = ?, Mname = ? , Lname = ? , DOB = ? , " .
            "gender = ? , PhoneN = ? , egn = ? WHERE ID = ?");
        $stmCreateProfile->bind_param("sssssssi",  $fname, $mname, $lname, $dateofbirth, $gender, $phoneN, $egn, $profileID);
        $stmCreateProfile->execute();
        if($stmCreateProfile->affected_rows !=1){
            return false;
        }else{
            return $stmCreateProfile->affected_rows == 1;
        }
    }

    public function setPosition($positionid, $userid) : bool
    {
        $statement = self::$db->prepare("UPDATE users SET positionID = ? WHERE users.ID = ?;");
        $statement->bind_param("ii", $positionid, $userid);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

    public function getAllSubjects() : array
    {
        $statement = self::$db->query("SELECT * " .
            "FROM subjects ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }


    public function getSubjects(int $pid) : array
    {
        $statement = self::$db->query("SELECT DISTINCT subjects.ID as subid , subjects.Name as subname  " .
            "FROM subjects INNER JOIN evaluation ON subjects.ID = evaluation.SubjectID
            INNER JOIN students ON evaluation.StudentID = students.ID
            INNER JOIN persons ON students.PersonID = persons.ID
            WHERE persons.ID = $pid ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getAvailableClass()
    {
        $statement = self::$db->query("SELECT class.ID as ClassID ,classNumberType,classLetterType, term, termYear " .
            "FROM class LEFT JOIN classgroup ON class.classgroupID = classgroup.ID " .
            "INNER JOIN studyperiod ON class.studyPeriodID = studyperiod.ID " .
            "INNER JOIN terms ON studyperiod.termID = terms.ID " .
            "INNER JOIN termyear ON studyperiod.termYearID = termyear.ID ".
            "INNER JOIN classnumbers ON classgroup.numberID = classnumbers.ID " .
            "INNER JOIN classletters ON classgroup.letterID = classletters.ID;");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getStudyPeriod() : array
    {
        $statement = self::$db->query(
            "SELECT studyperiod.ID ,term, termYear " .
            "FROM studyperiod INNER JOIN terms ON studyperiod.termID = terms.ID " .
            "INNER JOIN termyear ON studyperiod.termYearID = termyear.ID " .
            "ORDER BY termyear.termYear ASC ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function setTeach($teacherID, $subjectset) : bool
    {
        $statement = self::$db->prepare("INSERT INTO teach (TeacherID, SubjectID) VALUES (? , ?)");
        $statement->bind_param("ii", $teacherID, $subjectset);
        $statement->execute();
        if ($statement->affected_rows !=1){
            return false;
        }
        else{
            return $statement->affected_rows == 1;
        }
    }

    public function setTeaching($teacherID, $classInsertID) : bool
    {
        $statement = self::$db->prepare("INSERT INTO teaching (TeacherID, ClassID) VALUES (? , ?)");
        $statement->bind_param("ii", $teacherID, $classInsertID);
        $statement->execute();
        if ($statement->affected_rows !=1){
            return false;
        }
        else{
            return $statement->affected_rows == 1;
        }
    }

    public function getSubjectsTeacher($teacherID)
    {
        $statement = self::$db->query("SELECT subjects.ID as SubID, teach.ID as teachID,Name, ABB " .
            "FROM teach INNER JOIN subjects ON teach.SubjectID = subjects.ID " .
            "WHERE TeacherID = $teacherID");

        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getFormMaster($teacherID)
    {
        $statement = self::$db->query("SELECT class.ID as ClassID, term, termYear, classNumberType as number, " .
            " classLetterType as letter " .
            "FROM class INNER JOIN studyperiod ON class.studyPeriodID = studyperiod.ID " .
            "INNER JOIN terms ON studyperiod.termID = terms.ID " .
            "INNER JOIN termyear ON studyperiod.termYearID = termyear.ID " .
            "INNER JOIN classgroup ON class.classgroupID = classgroup.ID " .
            "INNER JOIN classnumbers ON classgroup.numberID = classnumbers.ID " .
            "INNER JOIN classletters ON classgroup.letterID = classletters.ID " .
            "LEFT JOIN formmaster ON class.formMasterID = formmaster.ID " .
            "WHERE TeacherID = $teacherID ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getStudentTeachersClass($teacherID)
    {
        $statement = self::$db->query("SELECT students.ID as StudentID, Fname, Lname, studentnumber " .
            "FROM class INNER JOIN students ON class.ID = students.classID " .
            "INNER JOIN formmaster ON class.formMasterID = formmaster.ID " .
            "LEFT JOIN persons ON students.PersonID = persons.ID " .
            "WHERE TeacherID = $teacherID");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getClassWithoutFormMaster()
    {
        $statement = self::$db->query("SELECT class.ID as ClassID, term, termYear, classNumberType, classLetterType " .
            "FROM class INNER JOIN studyperiod ON class.studyPeriodID = studyperiod.ID " .
            "INNER JOIN terms ON studyperiod.termID = terms.ID " .
            "INNER JOIN termyear ON studyperiod.termYearID = termyear.ID " .
            "INNER JOIN classgroup ON class.classgroupID = classgroup.ID " .
            "INNER JOIN classnumbers ON classgroup.numberID = classnumbers.ID " .
            "INNER JOIN classletters ON classgroup.letterID = classletters.ID " .
            "LEFT JOIN formmaster ON class.formMasterID = formmaster.ID " .
            "WHERE class.formMasterID IS NULL ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getTeachingClass($teacherID)
    {
        $statement = self::$db->query("SELECT class.ID as ClassID ,term, termYear, classLetterType as letter, classNumberType as number, " .
            "teaching.ID as teachingID, studyPeriodID as period, classletters.ID as classletter, classgroupID  " .
            "FROM teaching INNER JOIN class ON teaching.ClassID = class.ID " .
            "INNER JOIN studyperiod ON class.studyPeriodID = studyperiod.ID ".
            "INNER JOIN terms ON studyperiod.termID = terms.ID " .
            "INNER JOIN termyear ON studyperiod.termYearID = termyear.ID " .
            "INNER JOIN classgroup ON class.classgroupID = classgroup.ID " .
            "INNER JOIN classletters ON classgroup.letterID = classletters.ID " .
            "INNER JOIN classnumbers ON classgroup.numberID = classnumbers.ID " .
            "WHERE TeacherID = $teacherID " .
            "ORDER BY number , letter ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function setFormMaster($teacherID,$formMasterInsertID) : bool
    {
        $stmInsertFormMaster = self::$db->prepare("INSERT INTO formmaster (ClassID,TeacherID) " .
            "VALUES (?, ?)");
        $stmInsertFormMaster->bind_param("ii", $formMasterInsertID, $teacherID);
        $stmInsertFormMaster->execute();
        $stmInsertFormMaster = self::$db->insert_id;
        $statement = self::$db->prepare("UPDATE class SET formMasterID = ? WHERE ID = ? ");
        $statement->bind_param("ii", $stmInsertFormMaster, $formMasterInsertID);
        $statement->execute();
        if($statement->affected_rows !=1){
            return false;
        }else{
            return $statement->affected_rows ==1;
        }
    }

    public function setClassManager($classManagerInsertID,$ClassManagerID) : bool
    {
        $stmInsertClassManager = self::$db->prepare("INSERT INTO classmanagers (StudentID,ClassID) " .
            "VALUES (?, ?)");
        $stmInsertClassManager->bind_param("ii", $classManagerInsertID, $ClassManagerID);
        $stmInsertClassManager->execute();
        $stmInsertClassManager= self::$db->insert_id;
        $statement = self::$db->prepare("UPDATE class SET classManagerID = ? WHERE ID = ? ");
        $statement->bind_param("ii", $stmInsertClassManager, $ClassManagerID);
        $statement->execute();
        if($statement->affected_rows !=1){
            return false;
        }else{
            return $statement->affected_rows ==1;
        }
    }

    public function getClassManager($teacherID)
    {
        $statement = self::$db->query("SELECT persons.ID as pid,Fname, Lname, studentnumber, users.ID as userID  " .
            "FROM classmanagers INNER JOIN students ON classmanagers.StudentID = students.ID " .
            "INNER JOIN persons ON students.PersonID = persons.ID " .
            "INNER JOIN users ON persons.UserID = users.ID " .
            "INNER JOIN class ON students.classID = class.ID " .
            "INNER JOIN formmaster ON class.formMasterID = formmaster.ID " .
            "INNER JOIN teachers ON formmaster.TeacherID = teachers.ID " .
            "WHERE TeacherID = $teacherID ");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function setClass($classgr,$period)
    {
        $stmQuery = self::$db->prepare("SELECT ID FROM class WHERE classgroupID = ? AND studyPeriodID = ?");
        $stmQuery->bind_param("ii",$classgr, $period );
        $stmQuery->execute();
        $classIDInsert = $stmQuery->get_result()->fetch_row()[0];
        if ($classIDInsert){
            return $classIDInsert;
        }
        else{
            $stmInsertClassData = self::$db->prepare("INSERT INTO class (classgroupID, studyPeriodID) " .
                "VALUES (?, ?)");
            $stmInsertClassData->bind_param("ii", $classgr, $period);
            $stmInsertClassData->execute();
            if($stmInsertClassData->affected_rows !=1){
                return false;
            }else{
                $stmInsertClassData = self::$db->insert_id;
                $_SESSION['classID'] = $stmInsertClassData;
                return $stmInsertClassData;
            }
        }
    }

    public function setClassStudents ($classgr,$period, $stnumber,$studentid)
    {
        $Classid = $this->setClass($classgr,$period);
        $position = $_SESSION['positionID'];
        $stmInsertStudentData = self::$db->prepare("UPDATE students " .
            "SET classID = ? , studentnumber = ? , positionID = ? WHERE PersonID = ?");
        $stmInsertStudentData->bind_param("iiii", $Classid, $stnumber, $position, $studentid);
        $stmInsertStudentData->execute();
        if($stmInsertStudentData->affected_rows !=1){
            return false;
        }else{
            return $stmInsertStudentData->affected_rows == 1;
        }
    }

    public function insertStudent($profileBy,$positionID)
    {
        $stmInsertTeacher = self::$db->prepare("INSERT INTO students (PersonID, positionID) VALUES (?,?)");
        $stmInsertTeacher->bind_param("ii", $positionID,$profileBy);
        $stmInsertTeacher->execute();
        if($stmInsertTeacher->affected_rows !=1){
            return false;
        }else{
            return $stmInsertTeacher->affected_rows == 1;
        }
    }

    public function insertTeacher($profileBy,$positionID)
    {
        $stmInsertTeacher = self::$db->prepare("INSERT INTO teachers ( PersonID, positionID) VALUES (?,?)");
        $stmInsertTeacher->bind_param("ii", $profileBy,$positionID);
        $stmInsertTeacher->execute();
        if($stmInsertTeacher->affected_rows !=1){
            return false;
        }else{
            return $stmInsertTeacher->affected_rows == 1;
        }
    }

    public function insertParent($profileBy,$positionID)
    {
        $stmInsertTeacher = self::$db->prepare("INSERT INTO parents ( personID, positionID) VALUES (?,?)");
        $stmInsertTeacher->bind_param("ii", $positionID,$profileBy);
        $stmInsertTeacher->execute();
        if($stmInsertTeacher->affected_rows !=1){
            return false;
        }else{
            return $stmInsertTeacher->affected_rows == 1;
        }
    }

    public function getClass($PersondID)
    {
        $statement = self::$db->prepare("SELECT class.ID as classID, studyPeriodID, term, termYear, teachers.ID as teacherID, " .
            "classNumberType as Number, classLetterType as Letter, Fname, Lname, studentnumber " .
            "FROM class INNER JOIN studyperiod ON class.studyPeriodID = studyperiod.ID " .
            "INNER JOIN terms ON studyperiod.termID = terms.ID " .
            "INNER JOIN termyear ON studyperiod.termYearID = termyear.ID " .
            "INNER JOIN teaching ON class.ID = teaching.ClassID " .
            "INNER JOIN teachers ON teaching.TeacherID = teachers.ID " .
            "INNER JOIN formmaster ON class.formMasterID = formmaster.ID " .
            "LEFT JOIN students ON class.ID = students.classID " .
            "LEFT JOIN classgroup ON class.classgroupID = classgroup.ID " .
            "LEFT JOIN classletters ON classgroup.letterID = classletters.ID " .
            "LEFT JOIN classnumbers ON classgroup.numberID = classnumbers.ID " .
            "LEFT JOIN persons ON students.PersonID = persons.ID " .
            "WHERE teachers.PersonID = ?");
        $statement->bind_param("i", $PersondID);
        $statement->execute();
        $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function deleteTeaching(int $deleteTeaching) : bool
    {
        $statement = self::$db->prepare(
            "DELETE FROM teaching WHERE teaching.ID = ?");
        $statement->bind_param("i", $deleteTeaching);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

    public function deleteSubject(int $deletesubject):bool
    {
        $statement = self::$db->prepare(
            "DELETE FROM teach WHERE teach.ID = ?");
        $statement->bind_param("i", $deletesubject);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

    public function deleteFamConn(int $id) :bool
    {
        $statement = self::$db->prepare(
            "DELETE FROM familyconnect WHERE familyconnect.ID = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

    public function delete(int $id) : bool
    {
        $statement = self::$db->prepare(
            "DELETE FROM persons WHERE UserID = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }
}