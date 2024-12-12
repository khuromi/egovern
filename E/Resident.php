<?php

    class Resident {


        private Database $db;

        public function __construct(){
            $this->db = Database::getInstance();
        }

        public function fetchResidents(){

            $sql = "SELECT r.* FROM residents r LEFT JOIN deactivation_reasons dr ON r.Resident_ID = dr.resident_id WHERE dr.resident_id IS NULL;";

            $stmt = $this->db->query($sql);
            if($stmt->execute()){

                return $stmt->fetchAll();

            }

        }

        public function fetchDeactivatedResidents(){

            $sql = "SELECT r.*, dr.* FROM residents r LEFT JOIN deactivation_reasons dr ON r.Resident_ID = dr.resident_id WHERE dr.resident_id IS NOT NULL;";

            $stmt = $this->db->query($sql);
            if($stmt->execute()){

                return $stmt->fetchAll();

            }

        }

        public function fetchResidentByID($id)
        {
            $sql = "SELECT * FROM residents WHERE Resident_ID = :rid";
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
                $query = "SELECT Resident_ID, Firstname, Middlename, Lastname 
                          FROM residents 
                          WHERE Firstname LIKE :search OR Middlename LIKE :search OR Lastname LIKE :search
                          LIMIT :limit OFFSET :offset";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
                $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
                
                $stmt->execute();
        
                $residents = [];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $residents[] = [
                        'id' => $row['Resident_ID'],
                        'text' => $row['Firstname'] . ' ' . $row['Middlename'] . ' ' . $row['Lastname']
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
                $mother_name = $_POST['head_relationship'];
                $father_name = $_POST['father_name'];
                $household_number = $_POST['household_number'];
                $sector_code = $_POST['sector_code'];
    
                $sql = "
                    UPDATE residents 
                    SET 
                        Firstname = :firstname, 
                        Lastname = :lastname, 
                        Middlename = :middlename, 
                        Qualifier = :qualifier, 
                        Birthdate = :birthdate, 
                        Gender = :sex, 
                        Address = :address, 
                        Birthplace = :birthplace, 
                        Civil_Status = :civil_status, 
                        Ethnicity = :ethnicity, 
                        Educational_Attainment = :education, 
                        Avg_Monthly_Income = :monthly_income, 
                        Occupation = :occupation, 
                        Employment_Status = :employment_status, 
                        Relation_To_Head = :head_relationship, 
                        Household_Number = :household_number, 
                        Mothers_Maiden_Name = :mother_name, 
                        Fathers_Name = :father_name,
                        Sector_Code = :sector_code
                    WHERE Resident_ID = :resident_id
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
        
        public function deactivateResident($residentID, $reason)
        {
            $date = date('Y-m-d');
            $stmt =$this->db->prepare("INSERT INTO deactivation_reasons (resident_id, deactivation_reason, deactivation_date) VALUES (:rid, :dr, :dd)");
            $stmt->bindParam(":dr", $reason);
            $stmt->bindParam(":rid", $residentID);
            $stmt->bindParam(":dd", $date);
            if($stmt->execute()){
                echo json_encode(
                    [
                        'success' => true
                    ]
                );
            }

        }

        public function addResident($data) {
            
            $firstname = isset($data['Firstname']) ? trim($data['Firstname']) : null;
            $lastname = isset($data['Lastname']) ? trim($data['Lastname']) : null;
            $middlename = isset($data['Middlename']) ? trim($data['Middlename']) : null;
            $qualifier = isset($data['Qualifier']) ? trim($data['Qualifier']) : null;
            $birthdate = isset($data['Birthdate']) ? trim($data['Birthdate']) : null;
            $birthplace = isset($data['Birthplace']) ? trim($data['Birthplace']) : null;
            $address = isset($data['Address']) ? trim($data['Address']) : null;
            $sex = isset($data['Gender']) ? trim($data['Gender']) : null;
            $civil_status = isset($data['Civil_Status']) ? trim($data['Civil_Status']) : null;
            $ethnicity = isset($data['Ethnicity']) ? trim($data['Ethnicity']) : null;
            $education = isset($data['Educational_Attainment']) ? trim($data['Educational_Attainment']) : null;
            $mother_name = isset($data['Mothers_Maiden_Name']) ? trim($data['Mothers_Maiden_Name']) : null;
            $father_name = isset($data['Fathers_Name']) ? trim($data['Fathers_Name']) : null;
            $employment_status = isset($data['Employment_Status']) ? trim($data['Employment_Status']) : null;
            $occupation = isset($data['Occupation']) ? trim($data['Occupation']) : null;
            $monthly_income = isset($data['Avg_Monthly_Income']) ? trim($data['Avg_Monthly_Income']) : null;
            $head_relationship = isset($data['Relation_To_Head']) ? trim($data['Relation_To_Head']) : null;
            $household_number = isset($data['Household_Number']) ? trim($data['Household_Number']) : null;
            $sector_code = isset($data['Sector_Code']) ? trim($data['Sector_Code']) : null;
        

            if (!$firstname || !$lastname || !$birthdate) {
                return ['status' => 'error', 'message' => 'First name, last name, and birthdate are required.'];
            }
        
            try {

                $sql = "
                    INSERT INTO residents 
                    (Firstname, Lastname, Middlename, Qualifier, Birthdate, Birthplace, Gender, Address, Civil_Status, Ethnicity, 
                    Educational_Attainment, Mothers_Maiden_Name, Fathers_Name, Employment_Status, Occupation, 
                    Avg_Monthly_Income, Relation_To_Head, Household_Number, Sector_Code)
                    VALUES 
                    (:firstname, :lastname, :middlename, :qualifier, :birthdate, :birthplace, :sex, :address, :civil_status, :ethnicity, 
                    :education, :mother_name, :father_name, :employment_status, :occupation, 
                    :monthly_income, :head_relationship, :household_number, :sector_code)
                ";
        

                $stmt = $this->db->prepare($sql);
        
                // Bind the parameters
                $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
                $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
                $stmt->bindParam(':middlename', $middlename, PDO::PARAM_STR);
                $stmt->bindParam(':qualifier', $qualifier, PDO::PARAM_STR);
                $stmt->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
                $stmt->bindParam(':birthplace', $birthplace, PDO::PARAM_STR);
                $stmt->bindParam(':sex', $sex, PDO::PARAM_STR);
                $stmt->bindParam(':address', $address, PDO::PARAM_STR);
                $stmt->bindParam(':civil_status', $civil_status, PDO::PARAM_STR);
                $stmt->bindParam(':ethnicity', $ethnicity, PDO::PARAM_STR);
                $stmt->bindParam(':education', $education, PDO::PARAM_STR);
                $stmt->bindParam(':mother_name', $mother_name, PDO::PARAM_STR);
                $stmt->bindParam(':father_name', $father_name, PDO::PARAM_STR); // Fixed typo in parameter
                $stmt->bindParam(':employment_status', $employment_status, PDO::PARAM_STR);
                $stmt->bindParam(':occupation', $occupation, PDO::PARAM_STR);
                $stmt->bindParam(':monthly_income', $monthly_income, PDO::PARAM_STR); // If it's numeric, change to PDO::PARAM_INT
                $stmt->bindParam(':head_relationship', $head_relationship, PDO::PARAM_STR);
                $stmt->bindParam(':household_number', $household_number, PDO::PARAM_STR);
                $stmt->bindParam(':sector_code', $sector_code, PDO::PARAM_STR);
        
                if ($stmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Resident added successfully.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to add resident.']);
                }
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
            }
        }
        


    }