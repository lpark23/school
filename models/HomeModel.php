<?php

class HomeModel extends BaseModel
{
    function  getLatestEvents(int $maxCount)
    {
        $statement = self::$db->query(
            "SELECT events.ID, Title, content, dateofcreate, persons.Fname " .
            "FROM events INNER JOIN teachers ON events.TeacherID = teachers.ID ".
            "INNER JOIN persons ON teachers.PersonID = persons.ID " .
            "ORDER BY  dateofcreate DESC LIMIT  " . $maxCount);
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
    
    function  getEventById(int $id)
    {
        $statement = self::$db->prepare(
            "SELECT events.ID, Title, content, dateofcreate, persons.Fname " .
            "FROM events INNER JOIN teachers ON events.TeacherID = teachers.ID ".
            "INNER JOIN persons ON teachers.PersonID = persons.ID " .
            "WHERE events.ID = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }
    
}
