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

    
}