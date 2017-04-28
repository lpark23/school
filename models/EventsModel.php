<?php
class EventsModel extends BaseModel
{
    public function getAll() : array
    {
        $statement = self::$db->query(
            "SELECT events.ID as ID, teachers.ID as tID, persons.ID as pID, Title, content, dateofcreate, Fname, Lname  " .
            "FROM events INNER JOIN teachers ON events.TeacherID = teachers.ID
            INNER JOIN persons ON teachers.PersonID = persons.ID
            ORDER BY dateofcreate DESC");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getById(int $id)
    {
        $statement = self::$db->prepare(
            "SELECT * FROM events WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function create(string $title, string $content, int $userID) : bool
    {
        $contentPrg = "<p>".$content."</p>";
        $statement = self::$db->prepare(
            "INSERT INTO events(Title, content, TeacherID) VALUES (?,?,?)");
        $statement->bind_param("ssi", $title, $contentPrg, $userID);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

    public function edit(string $id, string $title, string $content, string $date, int $TeacherID) : bool
    {
        $contentPrg = "<p>".$content."</p>";
        $statement = self::$db->prepare("UPDATE events SET Title = ?, content = ?, " . 
            " dateofcreate = ?, TeacherID = ? WHERE ID = ?");
        $statement->bind_param("sssii", $title, $contentPrg, $date, $TeacherID, $id);
        $statement->execute();
        return $statement->affected_rows >= 0;
    }

    public function delete(int $id) : bool
    {
        $statement = self::$db->prepare(
            "DELETE FROM events WHERE ID = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }
}