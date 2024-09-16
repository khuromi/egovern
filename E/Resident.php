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

        public  function  editResident($residentID, $firstname, $lastname, $middlename,$qualifier, $birthdate, $educational_attainment, $annual_income, $sex, $civil_status,$citizenship,$religion,$occupation,$household_head_relationship )

        {
            $stmt = $this->db->prepare("UPDATE `resident` SET `lastname`= :lastname, `firstname` =:firstname,`middlename`=:middlename, `qualifier`=:qulifier, `birthdate`=:birthdate, `educational_attainment`=:educational_attainment,`annual_income`=:annual_income, `sex`=:sex, `civil_status`=:civil_status,`religion`=:religion,`occupation`=:occupation,`household_head_relationship`=:household_head_relationship where resident_id=:resident_id=:rid");
            $stmt->bindParam(":rid", $residentID);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":middlename", $middlename);
            $stmt->bindParam(":qulifier",$qualifier);
            $stmt->bindParam(":birthdate",$birthdate);
            $stmt->bindParam(":educational_attainment",$educational_attainment);
            $stmt->bindParam(":annual_income", $annual_income);
            $stmt->bindParam(":sex",$sex);
            $stmt->bindParam(":civil_status",$civil_status);
            $stmt->bindParam(":citizenship",$citizenship);
            $stmt->bindParam(":religion",$religion);
            $stmt->bindParam(":occupation",$occupation);
            $stmt->bindParam(":household_head_relationship",$household_head_relationship);

            if ($stmt->execute()){
                return true;
            }

        }
        public function deleteResident($residentID )
        {
            $stmt =$this->db->prepare("DELETE FROM `resident` WHERE resident_id=:rid ");

                $stmt->bindParam(":rid",$residentID);
            if ($stmt->execute()){
                return true;
            }

        }

        public function insertResident($firstname, $lastname, $middlename,$qualifier, $birthdate, $educational_attainment, $annual_income, $sex, $civil_status,$citizenship,$religion,$occupation,$household_head_relationship )
        {
            $stmt =$this->db->prepare("INSERT INTO `resident`(`firstname`, `lastname`, `middlename`,`qualifier`, `birthdate`, `educational_attainment`, `annual_income`, `sex`, `civil_status`,`citizenship`,`religion`,`occupation`,`household_head_relationship`) VALUES (:firstname, :lastname, :middlename,:qualifier, :birthdate, :educational_attainment, :annual_income,:sex, :civil_status,:citizenship,:religion,:occupation,:household_head_relationship)");
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":middlename", $middlename);
            $stmt->bindParam(":qulifier",$qualifier);
            $stmt->bindParam(":birthdate",$birthdate);
            $stmt->bindParam(":educational_attainment",$educational_attainment);
            $stmt->bindParam(":annual_income", $annual_income);
            $stmt->bindParam(":sex",$sex);
            $stmt->bindParam(":civil_status",$civil_status);
            $stmt->bindParam(":citizenship",$citizenship);
            $stmt->bindParam(":religion",$religion);
            $stmt->bindParam(":occupation",$occupation);
            $stmt->bindParam(":household_head_relationship",$household_head_relationship);

            if ($stmt->execute()){
                return true;
            }

        }



    }