<?php
$query = "
    SELECT doctor.firstname AS dfirstname, doctor.lastname AS dlastname, doctor.docid 
    FROM doctor
    LEFT JOIN patient ON doctor.docid = patient.treatsdocid
    WHERE patient.treatsdocid IS NULL";

$result = mysqli_query($connection, $query);

if (!$result) {
    die("Database query failed.");
}

echo "<ul>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<li>Doctor " . $row['dfirstname'] . " " . $row['dlastname'] . " ID: " . $row['docid'] . "</li>";
}
echo "</ul>";

mysqli_free_result($result);
mysqli_close($connection);
?>
