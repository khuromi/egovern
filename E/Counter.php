<?php

class Counter {


    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function countPopulations()
    {
        $sql = "SELECT COUNT(*) as total FROM `residents`";
    
        try {
            // Prepare the SQL statement
            $stmt = $this->db->prepare($sql);
            
            // Execute the statement
            $stmt->execute();
            
            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result['total']; // Return the total count of residents
        } catch (PDOException $e) {
            // Handle any errors (e.g., log them)
            error_log("Database query failed: " . $e->getMessage());
            return 0; // or handle the error as needed
        }
    }
    public function countHouseholds()
{
    // SQL query to count the number of unique household numbers
    $sql = "SELECT COUNT(DISTINCT household_number) AS total_households FROM `residents`";

    try {
        // Prepare the SQL statement
        $stmt = $this->db->prepare($sql);
        
        // Execute the statement
        $stmt->execute();   
        
        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['total_households']; // Return the total count of unique households
    } catch (PDOException $e) {
        // Handle any errors (e.g., log them)
        error_log("Database query failed: " . $e->getMessage());
        return 0; // Return 0 or handle the error as needed
    }
}
public function countEthnicity()
{
    // SQL query to count the number of unique ethnicities
    $sql = "SELECT COUNT(DISTINCT ethnicity) as total_ethnicities FROM `residents`";

    try {
        // Prepare the SQL statement
        $stmt = $this->db->prepare($sql);  // Prepare the query
        $stmt->execute();                  // Execute the query
        
        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Return the total number of unique ethnicities
        return $result['total_ethnicities']; 
    } catch (PDOException $e) {
        // Log any errors
        error_log("Database query failed: " . $e->getMessage());
        return 0; // Return 0 if there's an error
    }
}
public function countEmploymentRate(): array
{
    // SQL query to count the number of employed and self-employed residents
    $sql = "SELECT 
                COUNT(CASE WHEN employment_status = 'Employed' THEN 1 END) as total_employed,
                COUNT(CASE WHEN employment_status = 'Self-employed' THEN 1 END) as total_self_employed
            FROM `residents`";

    try {
        // Prepare the SQL statement
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Return the counts as an associative array
        return [
            'total_employed' => (int) $result['total_employed'],
            'total_self_employed' => (int) $result['total_self_employed']
        ];
    } catch (PDOException $e) {
        // Log any errors
        error_log("Database query failed: " . $e->getMessage());
        return [
            'total_employed' => 0,
            'total_self_employed' => 0
        ];
    }
}
public function countResidents(): int
{
    // SQL query to count the total number of residents
    $sql = "SELECT COUNT(*) as total_residents FROM `residents`";

    try {
        // Prepare and execute the SQL statement
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        // Fetch the result and return the total number of residents
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $result['total_residents'];
    } catch (PDOException $e) {
        // Log any errors for debugging purposes
        error_log("Database query failed: " . $e->getMessage());
        return 0; // Return 0 if there's an error
    }
}




    
}