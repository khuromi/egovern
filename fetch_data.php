<?php
// fetch_data.php
require 'config/init.php';


// Initialize the query
$query = "SELECT * FROM residents WHERE 1=1";

// Check if any filters are set and modify the query accordingly
if (!empty($_POST['sector'])) {
    $sector = $_POST['sector'];
    $query .= " AND sector_code = :sector";
}

if (!empty($_POST['ethnicity'])) {
    $ethnicity = $_POST['ethnicity'];
    $query .= " AND ethnicity = :ethnicity";
}

if (!empty($_POST['employment_status'])) {
    $employment_status = $_POST['employment_status'];
    $query .= " AND employment_status = :employment_status";
}
if (!empty($_POST['age'])) {
    $age = $_POST['age'];
    
    if ($age == 'senior') {
        $query .= " AND TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) >= 60";
    }

    elseif (is_numeric($age)) {
        $query .= " AND TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) = :age";
    }

   
}

$stmt = $db->prepare($query);

if (!empty($sector)) {
    $stmt->bindParam(':sector', $sector, PDO::PARAM_STR);
}

if (!empty($ethnicity)) {
    $stmt->bindParam(':ethnicity', $ethnicity, PDO::PARAM_STR);
}

if (!empty($employment_status)) {
    $stmt->bindParam(':employment_status', $employment_status, PDO::PARAM_STR);
}

if (!empty($age)) {
    $stmt->bindParam(':age', $age, PDO::PARAM_STR);
}


$stmt->execute();

$data = array();
while ($row = $stmt->fetch()) {
    $data[] = $row;
}

// Return the data as JSON
echo json_encode([
    "data" => $data
]);
?>
