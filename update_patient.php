<!This is used to modify an existing patient. The user can change the patient's weight and they can enter in either lbs or kg and it stores it in kilos>
<!DOCTYPE html>
<html>
<head>
<div id="header">
<title>Update Patient</title>
</div>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="Main Menu and Buttons">
<p class="Welcome">
<h1><center>Welcome to Update Patient!</center></h1>
</p>
<hr>
<div class="button-group"><center>
    <a href="mainmenu.php"><button>Main Menu</button></a>
    <a href="list_patients.php"><button>List Patients</button></a>
    <a href="add_patient.php"><button>Add Patient</button></a>
    <a href="delete_patient.php"><button>Delete Patient</button></a>
    <a href="show_doctors.php"><button>View Doctors</button></a>
    <a href="nurse_details.php"><button>View Nurse Details</button></a>
</center></div>
<hr>
<h2>Update Patient Weight</h2>
    <form method="POST" action="">
        <label for="ohip">Select Patient to Update Weight For:</label>
        <select id="ohip" name="ohip" required>
            <option value="" disabled selected>Select a patient to update</option>
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
        <label for="weight">Weight:</label>
        <input type="number" id="weight" name="weight" step="0.1" min="0" required>
        <br><br>

        <label>Weight Unit:</label><br>
        <input type="radio" id="kg" name="weight_unit" value="kg" required>
        <label for="kg">Kilograms</label><br>
        <input type="radio" id="lb" name="weight_unit" value="lb">
        <label for="lb">Pounds</label><br><br>

        <button type="submit" name="update">Update Weight</button>
    </form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $ohip = $_POST['ohip'];
    $weight = $_POST['weight'];
    $weight_unit = $_POST['weight_unit'];

    if ($weight_unit === 'lb') {
        $weight = $weight / 2.20462;
    }

    $update_query = "UPDATE patient SET weight = '$weight' WHERE ohip = '$ohip'";
    if (mysqli_query($connection, $update_query)) {
        echo "Patient's weight updated successfully!";
    } else {
        echo "Error updating weight: " . mysqli_error($connection);
    }
}

mysqli_close($connection);
?>
</div>
</body>
</html>
