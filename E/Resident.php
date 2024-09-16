<?php

    class Resident {


        private Database $db;

        public function __construct(){
            $this->db = Database::getInstance();
        }

        public function fetchResidents(){

            $sql = "SELECT * FROM household";

            $stmt = $this->db->query($sql);
            if($stmt->execute()){

                return $stmt->fetchAll();

            }

        }


    }