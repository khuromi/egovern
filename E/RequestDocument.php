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

    public function requestDocument($resident_id, $document_type, $clearance_purpose, $community_tax_cert_number, $community_tax_cert_date) 
    {
        $sql = "INSERT INTO document_requests (resident_id, document_type)";
        $stmt = $this->db->prepare($sql);
        
    }


}