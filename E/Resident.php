<?php

    class Resident {


        private Database $db;

        public function __construct(){
            $this->db = Database::getInstance();
        }

        public function fetchResidents(){

            $sql = "SELECT * FROM resident LIMIT 5";

            $stmt = $this->db->query($sql);
            if($stmt->execute()){

                return $stmt->fetchAll();

            }

        }

        public function fetchResidentByID($id)
        {
            $sql = "SELECT * FROM resident WHERE resident_id = :rid";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":rid", $id, PDO::PARAM_INT);
            if ($stmt->execute()){
                if ($stmt->rowCount() > 0){
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo json_encode($row);
                }
            }
        }


    }