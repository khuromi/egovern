<?php

    class Resident {


        private Database $db;

        public function __construct(){
            $this->db = Database::getInstance();
        }

        public function fetchResidents(){

            $sql = "SELECT * FROM residents";

            $stmt = $this->db->query($sql);
            if($stmt->execute()){

                return $stmt->fetchAll();

            }

        }

        public function fetchResidentByID($id)
        {
            $sql = "SELECT * FROM residents WHERE resident_id = :rid";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":rid", $id, PDO::PARAM_INT);
            if ($stmt->execute()){
                if ($stmt->rowCount() > 0){
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo json_encode($row);
                }
            }
        }

        public function editResident()
        {
        
            try {
                $resident_id = intval($_POST['resident_id']);
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $middlename = $_POST['middlename'];
                $qualifier = $_POST['qualifier'];
                $birthdate = $_POST['birthdate'];
                $sex = $_POST['sex'];
                $birthplace = $_POST['birthplace'];
                $civil_status = $_POST['civil_status'];
                $ethnicity = $_POST['ethnicity'];
                $education = $_POST['education'];
                $monthly_income = $_POST['monthly_income'];
                $occupation = $_POST['occupation'];
                $employment_status = $_POST['employment_status'];
                $head_relationship = $_POST['head_relationship'];
                $mother_name = $_POST['mother_name'];
                $father_name = $_POST['father_name'];
    
                $sql = "
                    UPDATE residents 
                    SET 
                        firstname = :firstname, 
                        lastname = :lastname, 
                        middlename = :middlename, 
                        qualifier = :qualifier, 
                        birthdate = :birthdate, 
                        sex = :sex, 
                        birthplace = :birthplace, 
                        civil_status = :civil_status, 
                        ethnicity = :ethnicity, 
                        educational_attainment = :education, 
                        avg_monthly_income = :monthly_income, 
                        occupation = :occupation, 
                        employment_status = :employment_status, 
                        household_head_relationship = :head_relationship, 
                        mothers_maiden_name = :mother_name, 
                        fathers_name = :father_name 
                    WHERE resident_id = :resident_id
                ";
    
                // Prepare the statement
                $stmt = $this->db->prepare($sql);
    
                // Bind parameters
                $stmt->bindParam(':resident_id', $resident_id, PDO::PARAM_INT);
                $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
                $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
                $stmt->bindParam(':middlename', $middlename, PDO::PARAM_STR);
                $stmt->bindParam(':qualifier', $qualifier, PDO::PARAM_STR);
                $stmt->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
                $stmt->bindParam(':sex', $sex, PDO::PARAM_STR);
                $stmt->bindParam(':birthplace', $birthplace, PDO::PARAM_STR);
                $stmt->bindParam(':civil_status', $civil_status, PDO::PARAM_STR);
                $stmt->bindParam(':ethnicity', $ethnicity, PDO::PARAM_STR);
                $stmt->bindParam(':education', $education, PDO::PARAM_STR);
                $stmt->bindParam(':monthly_income', $monthly_income, PDO::PARAM_STR);
                $stmt->bindParam(':occupation', $occupation, PDO::PARAM_STR);
                $stmt->bindParam(':employment_status', $employment_status, PDO::PARAM_STR);
                $stmt->bindParam(':head_relationship', $head_relationship, PDO::PARAM_STR);
                $stmt->bindParam(':mother_name', $mother_name, PDO::PARAM_STR);
                $stmt->bindParam(':father_name', $father_name, PDO::PARAM_STR);
    
                // Execute the query
                if ($stmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Resident information updated successfully.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update resident information.']);
                }
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
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