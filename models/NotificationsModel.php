<?php
class NotificationsModel extends BaseModel
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
    
    public function getAllUsers() : array 
    {
        $statement = self::$db->query("SELECT users.ID as ID, username, password_hash, email, positionID as posID,type, " .
            "users.status as ustatus, persons.status as pstatus " .
            "FROM users LEFT JOIN position ON users.positionID = position.ID " .
            "LEFT JOIN persons ON users.ID = persons.UserID " .
            "ORDER BY  pstatus, posID, dateofcreate DESC LIMIT 0,4 ;");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getAllProfile($records, $N) : array
    {
        $statement = self::$db->query(
            "SELECT users.ID as userid,username,users.status as ustatus,persons.ID as pID,Fname,Mname,Lname,persons.status as pstatus " .
            ",DOB ,egn,gender,email,dateofcreate, countryName, cityName, streetName, position.ID as posID,position.type " .
            "FROM persons  INNER JOIN users ON persons.UserID = users.ID " .
            "INNER JOIN address ON persons.AdressID = address.ID " .
            "INNER JOIN countries ON address.countryID = countries.ID " .
            "INNER JOIN cities ON address.cityID = cities.ID " .
            "INNER JOIN streets ON address.streetID = streets.ID " .
            "LEFT JOIN teachers ON persons.ID = teachers.PersonID " .
            "LEFT JOIN  students ON persons.ID = students.PersonID ".
            "LEFT JOIN parents ON persons.ID = parents.personID " .
            "LEFT JOIN position ON users.positionID = position.ID " . 
            "ORDER BY userid DESC LIMIT $records,$N");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function RecordsProfile( $records, $N)
    {
        $statement = self::$db->query("SELECT * " . 
            "FROM persons ORDER BY id ASC LIMIT $records,$N");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function chekPro()
    {
        $statement = self::$db->query("SELECT count(*) AS records " .
            "FROM persons");
        $result = mysqli_fetch_row($statement);
        return $rec_count = $result['0'];
    }

    public function addUstatus(int $ustatus, int $userid) : bool 
    {
        $statement = self::$db->prepare("UPDATE users SET status = ? WHERE users.ID = ?");
        $statement->bind_param("ii", $ustatus, $userid);
        $statement->execute();
        return $statement->affected_rows == 1;
    }
    
    public function addPstatus(int $pstatus, int $userid) : bool
    {
        $statement = self::$db->prepare("UPDATE persons SET status = ? WHERE UserID = ?");
        $statement->bind_param("ii", $pstatus, $userid);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

    public function setPosition(int $posid,int $userid) : bool
    {
        $statement = self::$db->prepare("UPDATE users SET positionID = ? WHERE users.ID = ?");
        $statement->bind_param("ii", $posid, $userid);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

    public function searchEGN($search) : array
    {
        $statement = self::$db->query(
            "SELECT username,users.status as ustatus,persons.ID as pid,Fname,Mname,Lname,persons.status as pstatus, " .
            "DOB,egn, gender, email,dateofcreate, countryName,cityName, streetName, position.ID as posID, " .
            "position.type, users.ID as userid ,students.ID as studentID, parents.ID as parentID, " .
            "teachers.ID as teacherID " .
            "FROM persons INNER JOIN address  ON persons.AdressID = address.ID " .
            "INNER JOIN users ON persons.UserID = users.ID " .
            "INNER JOIN countries ON address.countryID = countries.ID " .
            "INNER JOIN cities ON address.cityID = cities.ID " .
            "INNER JOIN streets ON address.streetID = streets.ID " .
            "LEFT JOIN teachers ON persons.ID = teachers.PersonID " .
            "LEFT JOIN students ON persons.ID = students.PersonID " .
            "LEFT JOIN parents ON persons.ID = parents.personID " .
            "LEFT JOIN position ON users.positionID = position.ID " .
            "WHERE egn LIKE '%$search%'");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    
    public function insertStudent($posid, $profileID)
    {
        $stmInsertTeacher = self::$db->prepare("INSERT INTO students (PersonID, positionID) VALUES (?,?)");
        $stmInsertTeacher->bind_param("ii",$profileID, $posid);
        $stmInsertTeacher->execute();
        if($stmInsertTeacher->affected_rows !=1){
            return false;
        }else{
            return $stmInsertTeacher->affected_rows == 1;
        }
    }

    public function insertTeacher($posid, $profileID)
    {
        $stmInsertTeacher = self::$db->prepare("INSERT INTO teachers ( PersonID, positionID) VALUES (?,?)");
        $stmInsertTeacher->bind_param("ii", $profileID,$posid);
        $stmInsertTeacher->execute();
        if($stmInsertTeacher->affected_rows !=1){
            return false;
        }else{
            return $stmInsertTeacher->affected_rows == 1;
        }
    }

    public function insertParent($posid, $profileID)
    {
        $stmInsertTeacher = self::$db->prepare("INSERT INTO parents ( personID, positionID) VALUES (?,?)");
        $stmInsertTeacher->bind_param("ii", $profileID,$posid);
        $stmInsertTeacher->execute();
        if($stmInsertTeacher->affected_rows !=1){
            return false;
        }else{
            return $stmInsertTeacher->affected_rows == 1;
        }
    }
}