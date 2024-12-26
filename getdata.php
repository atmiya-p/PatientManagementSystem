<?php
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'lastname';
$order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

// Query to fetch patient data
$query = "
    SELECT patient.*, doctor.firstname AS docfirstname, doctor.lastname AS doclastname
    FROM patient
    LEFT JOIN doctor ON patient.treatsdocid = doctor.docid
    ORDER BY $sort_by $order";

$result = mysqli_query($connection, $query);

if (!$result) {
    die("Database query failed.");
}

echo "<ol>";
while ($row = mysqli_fetch_assoc($result)) {
    $weightkg = $row["weight"];
    $weightlbs = $weightkg * 2.205;
    
    $heightm = $row["height"];
    $heightft = floor($heightm * 3.281);
    $heightin = round(($heightm * 39.37) % 12);

    echo "<li>";
    echo "OHIP: " . $row["ohip"] . "<br>";
    echo "Patient first name: " . $row["firstname"] . "<br>";
    echo "Patient last name: " . $row["lastname"] . "<br>";
    echo "Weight: " . $weightkg . " kg / " . $weightlbs . " lbs<br>";
    echo "Height: " . $heightm . " m / " . $heightft . " ft " . $heightin . " in<br>";
    echo "Birthdate: " . $row["birthdate"] . "<br>";
    echo "Doctor first name: " . $row["docfirstname"] . "<br>";
    echo "Doctor last name: " . $row["doclastname"] . "<br>";
    echo "</li><br>";
}
echo "</ol>";

mysqli_free_result($result);
mysqli_close($connection);
?>
