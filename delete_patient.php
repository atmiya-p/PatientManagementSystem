<!This deletes an existing patient. It displays a list of users and the user can pick which patient they would like to delete. It gives the user a chance to back out and confirm if they want to delete.
>
<!DOCTYPE html>
<html>
<head>
<div id="header">
<title>Delete Patients</title>
</div>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="Main Menu and Buttons">
<p class="Welcome">
<h1><center>Welcome to Delete Patient!</center></h1>
</p>
<hr>
<div class="button-group"><center>
    <a href="mainmenu.php"><button>Main Menu</button></a>
    <a href="list_patients.php"><button>List Patients</button></a>
    <a href="delete_patient.php"><button>Delete Patient</button></a>
    <a href="update_patient.php"><button>Update Patient</button></a>
    <a href="show_doctors.php"><button>View Doctors</button></a>
    <a href="nurse_details.php"><button>View Nurse Details</button></a>
</center></div>
<hr>
<h2>Delete Patient</h2>
<form method="POST" action="">
    <label for="ohip">Select Patient to Delete:</label>
    <select id="ohip" name="ohip" required>
        <option value="" disabled selected>Select a patient you would like to delete</option>
        <?php
        include 'connectdb.php';

        $query = "SELECT ohip, firstname, lastname FROM patient";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Database query failed: " . mysqli_error($connection));
        }

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['ohip'] . "'>Patient " . $row['firstname'] . " " . $row['lastname'] . " - Ohip: " . $row['ohip'] . "</option>";
        }

        mysqli_free_result($result);
        ?>
    </select>
    <br><br>
    
    <label>
        <input type="radio" name="confirm_delete" value="yes" required>
        This must be selected to confirm that you would like to delete the patient. If it is not, then user will not be deleted.
    </label>
    <br><br>
    <button type="submit" name="delete">Delete Patient</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] === 'yes') {
        $ohip = $_POST['ohip'];
        $delete_query = "DELETE FROM patient WHERE ohip = '$ohip'";
        if (mysqli_query($connection, $delete_query)) {
            echo "Patient with OHIP $ohip was deleted successfully.";
        } else {
            echo "Error deleting patient: " . mysqli_error($connection);
        }
    }
    else {
        echo "You have not confirmed that you want to delete the patient.";
    }

    mysqli_close($connection);
}
?>
</div>
</body>
</html>
