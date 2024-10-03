<?php

class RequestDocument {

    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getDocuments()
    {
        $sql = "SELECT * FROM `documents`";
        $stmt = $this->db->query($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}