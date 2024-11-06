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

    public function fetchRequestById($id) {
        $sql = "SELECT 
        documents.document_name, 
        document_requests.*,
        CONCAT(residents.firstname, ' ', residents.middlename, ' ', residents.lastname) AS resident_name, 
        document_requests.date_requested 
    FROM `document_requests` 
    INNER JOIN residents ON residents.resident_id = document_requests.resident_id 
    INNER JOIN documents ON document_requests.document_type = documents.document_id
    WHERE document_requests.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);


    }

    public function fetchRequests() {
        $sql = "SELECT 
        documents.document_name, 
        document_requests.*,
        CONCAT(residents.firstname, ' ', residents.middlename, ' ', residents.lastname) AS resident_name, 
        document_requests.date_requested 
    FROM `document_requests` 
    INNER JOIN residents ON residents.resident_id = document_requests.resident_id 
    INNER JOIN documents ON document_requests.document_type = documents.document_id
    ORDER BY document_requests.id DESC";
    $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchRequestsById($id) {
        $sql = "SELECT 
        documents.document_name, 
        document_requests.*,
        CONCAT(residents.firstname, ' ', residents.middlename, ' ', residents.lastname) AS resident_name, 
        document_requests.date_requested 
    FROM `document_requests` 
    INNER JOIN residents ON residents.resident_id = document_requests.resident_id 
    INNER JOIN documents ON document_requests.document_type = documents.document_id
    WHERE document_requests.user_id = :uid";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(":uid", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}