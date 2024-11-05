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

        public function fetchResidentName() {
            header('Content-Type: application/json');
            try {
                $search = $_POST['search'] ?? '';
                $page = $_POST['page'] ?? 1;
                $limit = 20; // Adjust the limit as needed
                $offset = ($page - 1) * $limit;
        
                // Fetch residents based on search query
                $query = "SELECT resident_id, firstname, middlename, lastname 
                          FROM residents 
                          WHERE firstname LIKE :search OR middlename LIKE :search OR lastname LIKE :search
                          LIMIT :limit OFFSET :offset";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
                $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
                
                $stmt->execute();
        
                $residents = [];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $residents[] = [
                        'id' => $row['resident_id'],
                        'text' => $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']
                    ];
                }
        
                // Check if more data is available
                $hasMore = count($residents) === $limit;
        
                echo json_encode([
                    'results' => $residents,
                    'pagination' => ['more' => $hasMore]
                ]);
                
            } catch (Exception $e) {
                // Handle error, log as needed
                echo json_encode([
                    'error' => 'An error occurred while fetching resident data.',
                    'message' => $e->getMessage()
                ]);
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
                $address = $_POST['address'];
                $education = $_POST['education'];
                $monthly_income = $_POST['monthly_income'];
                $occupation = $_POST['occupation'];
                $employment_status = $_POST['employment_status'];
                $head_relationship = $_POST['head_relationship'];
                $mother_name = $_POST['mother_name'];
                $father_name = $_POST['father_name'];
                $household_number = $_POST['household_number'];
                $sector_code = $_POST['sector_code'];
    
                $sql = "
                    UPDATE residents 
                    SET 
                        firstname = :firstname, 
                        lastname = :lastname, 
                        middlename = :middlename, 
                        qualifier = :qualifier, 
                        birthdate = :birthdate, 
                        sex = :sex, 
                        address = :address, 
                        birthplace = :birthplace, 
                        civil_status = :civil_status, 
                        ethnicity = :ethnicity, 
                        educational_attainment = :education, 
                        avg_monthly_income = :monthly_income, 
                        occupation = :occupation, 
                        employment_status = :employment_status, 
                        household_head_relationship = :head_relationship, 
                        household_number = :household_number, 
                        mothers_maiden_name = :mother_name, 
                        fathers_name = :father_name,
                        sector_code = :sector_code
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
                $stmt->bindParam(':address', $address, PDO::PARAM_STR);
                $stmt->bindParam(':occupation', $occupation, PDO::PARAM_STR);
                $stmt->bindParam(':employment_status', $employment_status, PDO::PARAM_STR);
                $stmt->bindParam(':head_relationship', $head_relationship, PDO::PARAM_STR);
                $stmt->bindParam(':mother_name', $mother_name, PDO::PARAM_STR);
                $stmt->bindParam(':father_name', $father_name, PDO::PARAM_STR);
                $stmt->bindParam(':sector_code', $sector_code, PDO::PARAM_STR);
                $stmt->bindParam(':household_number', $household_number, PDO::PARAM_STR);
    
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
            $stmt =$this->db->prepare("DELETE FROM `residents` WHERE resident_id=:rid ");

                $stmt->bindParam(":rid",$residentID);
            if ($stmt->execute()){
                return true;
            }

        }

        function addResident($data) {

            $firstname = isset($data['firstname']) ? trim($data['firstname']) : null;
            $lastname = isset($data['lastname']) ? trim($data['lastname']) : null;
            $middlename = isset($data['middlename']) ? trim($data['middlename']) : null;
            $qualifier = isset($data['qualifier']) ? trim($data['qualifier']) : null;
            $birthdate = isset($data['birthdate']) ? trim($data['birthdate']) : null;
            $birthplace = isset($data['birthplace']) ? trim($data['birthplace']) : null;
            $address = isset($data['address']) ? trim($data['address']) : null;
            $sex = isset($data['sex']) ? trim($data['sex']) : null;
            $civil_status = isset($data['civil_status']) ? trim($data['civil_status']) : null;
            $ethnicity = isset($data['ethnicity']) ? trim($data['ethnicity']) : null;
            $education = isset($data['education']) ? trim($data['education']) : null;
            $mother_name = isset($data['mother_name']) ? trim($data['mother_name']) : null;
            $father_name = isset($data['father_name']) ? trim($data['father_name']) : null;
            $employment_status = isset($data['employment_status']) ? trim($data['employment_status']) : null;
            $occupation = isset($data['occupation']) ? trim($data['occupation']) : null;
            $monthly_income = isset($data['monthly_income']) ? trim($data['monthly_income']) : null;
            $head_relationship = isset($data['head_relationship']) ? trim($data['head_relationship']) : null;
            $household_number = isset($data['household_number']) ? trim($data['household_number']) : null;
            $sector_code = isset($data['sector_code']) ? trim($data['sector_code']) : null;
        
            if (!$firstname || !$lastname || !$birthdate) {
                return ['status' => 'error', 'message' => 'First name, last name, and birthdate are required.'];
            }
        
            try {
                // Prepare the SQL query to insert a new resident
                $sql = "
                    INSERT INTO residents 
                    (firstname, lastname, middlename, qualifier, birthdate, birthplace, sex, address, civil_status, ethnicity, 
                    educational_attainment, mothers_maiden_name, fathers_name, employment_status, occupation, 
                    avg_monthly_income, household_head_relationship, household_number, sector_code)
                    VALUES 
                    (:firstname, :lastname, :middlename, :qualifier, :birthdate, :birthplace, :sex, :address, :civil_status, :ethnicity, 
                    :education, :mother_name, :father_name, :employment_status, :occupation, 
                    :monthly_income, :head_relationship, :household_number, :sector_code)
                ";
        
                // Prepare the PDO statement
                $stmt = $this->db->prepare($sql);
        
                // Bind the parameters
                $stmt->bindParam(':firstname', $firstname);
                $stmt->bindParam(':lastname', $lastname);
                $stmt->bindParam(':middlename', $middlename);
                $stmt->bindParam(':qualifier', $qualifier);
                $stmt->bindParam(':birthdate', $birthdate);
                $stmt->bindParam(':birthplace', $birthplace);
                $stmt->bindParam(':sex', $sex);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':civil_status', $civil_status);
                $stmt->bindParam(':ethnicity', $ethnicity);
                $stmt->bindParam(':education', $education);
                $stmt->bindParam(':mother_name', $mother_name);
                $stmt->bindParam(':father_name', $father_name);
                $stmt->bindParam(':employment_status', $employment_status);
                $stmt->bindParam(':occupation', $occupation);
                $stmt->bindParam(':monthly_income', $monthly_income);
                $stmt->bindParam(':head_relationship', $head_relationship);
                $stmt->bindParam(':household_number', $household_number);
                $stmt->bindParam(':sector_code', $sector_code);
        
                // Execute the query
                if ($stmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Resident added successfully.']) ;
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to add resident.']);
                }
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
            }
        }
        


    }