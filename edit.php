<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$edit_id = $_GET['edit_id'] ?? null;

if ($edit_id) {
    $sql = "SELECT * FROM dash WHERE user_id = $edit_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row["name"]; 
        $position = $row["position"];
        $office = $row["office"];
        $age = $row["age"];
        $startdate = $row["startdate"];
        $salary = $row["salary"];
    } else {
        echo "0 results";
    }
}

$conn->close();
?>