<!This prompts user for a nurse, and it lists the nurse name, doctors that nurse works for, and the number of hours for each doctor. At the end, it shows the total number of hours a nurse has worked and also gives the name of the nurse who is the supervisor for this nurse.
>
<!DOCTYPE html>
<html>
<head>
    <title>View Nurse Details</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="Main Menu and Buttons">
<p class="Welcome">
    <h1><center>Welcome to Nurse Details!</center></h1>
</p>
<hr>
<div class="button-group"><center>
    <a href="mainmenu.php"><button>Main Menu</button></a>
    <a href="list_patients.php"><button>List Patients</button></a>
    <a href="add_patient.php"><button>Add Patient</button></a>
    <a href="delete_patient.php"><button>Delete Patient</button></a>
    <a href="update_patient.php"><button>Update Patient</button></a>
    <a href="show_doctors.php"><button>View Doctors</button></a>
</center></div>
<hr>
<h2>Select a Nurse:</h2>
<form method="POST" action="">
    <label for="nurse">Nurse:</label>
    <select id="nurse" name="nurse" required>
        <option value="" disabled selected>Select a Nurse</option>
        <?php
        include 'connectdb.php';

        $query = "SELECT nurseid, firstname, lastname FROM nurse";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Database query failed: " . mysqli_error($connection));
        }

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['nurseid'] . "'>" . $row['firstname'] . " " . $row['lastname'] . "</option>";
        }

        mysqli_free_result($result);
        ?>
    </select>
    <br><br>
    <button type="submit" name="view_details">View Nurse Details</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['view_details'])) {
    $nurse_id = $_POST['nurse'];

    $nurse_query = "SELECT firstname, lastname, reporttonurseid FROM nurse WHERE nurseid = '$nurse_id'";
    $nurse_result = mysqli_query($connection, $nurse_query);

    if (!$nurse_result) {
        die("Database query failed: " . mysqli_error($connection));
    }

    $nurse = mysqli_fetch_assoc($nurse_result);
    $nurse_name = $nurse['firstname'] . " " . $nurse['lastname'];
    $supervisor_id = $nurse['reporttonurseid'];

    echo "<h3>Nurse: $nurse_name</h3>";

    $doctors_query = "
        SELECT doctor.firstname AS docfirstname, doctor.lastname AS doclastname, workingfor.hours
        FROM workingfor
        JOIN doctor ON workingfor.docid = doctor.docid
        WHERE workingfor.nurseid = '$nurse_id'";

    $doctors_result = mysqli_query($connection, $doctors_query);

    if (!$doctors_result) {
        die("Database query failed: " . mysqli_error($connection));
    }

    echo "<h4>Doctors the nurse works for:</h4>";
    echo "<ul>";
    $total_hours = 0;

    while ($row = mysqli_fetch_assoc($doctors_result)) {
        $hours = $row['hours'];
        $total_hours += $hours;

        echo "<li>Doctor " . $row['docfirstname'] . " " . $row['doclastname'] . " - Hours: $hours</li>";
    }

    echo "</ul>";

    echo "Total hours worked: $total_hours<br><br>";
    if ($supervisor_id) {
        $supervisor_query = "SELECT firstname, lastname FROM nurse WHERE nurseid = '$supervisor_id'";
        $supervisor_result = mysqli_query($connection, $supervisor_query);

        if ($supervisor_result) {
            $supervisor = mysqli_fetch_assoc($supervisor_result);
            echo "Supervisor: " . $supervisor['firstname'] . " " . $supervisor['lastname'];
            mysqli_free_result($supervisor_result);
        }
    } else {
        echo "Nurse has no supervisor.";
    }

    mysqli_free_result($nurse_result);
    mysqli_free_result($doctors_result);
}
mysqli_close($connection);
?>
</div>
</body>
</html>

