<?php
$query = "
    SELECT doctor.firstname AS dfirstname, doctor.lastname AS dlastname, patient.firstname AS pfirstname, patient.lastname AS plastname 
    FROM doctor
    JOIN patient ON doctor.docid = patient.treatsdocid";

$result = mysqli_query($connection, $query);

if (!$result) {
    die("Database query failed.");
}

$result = mysqli_query($connection, $query);
echo "<ul>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<li>Doctor: " . $row['dfirstname'] . " " . $row['dlastname'] . " - Patient: " . $row['pfirstname'] . " " . $row['plastname'] . "</li>";
}
echo "</ul>";

mysqli_free_result($result);
?>
