<!This inserts a new patient. It will make sure that the ohip is unique. The user is allowed to pick the doctor they would like to assign to this patient>
<!DOCTYPE html>
<html>
<head>
<div id="header">
<title>Add Patients</title>
</div>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="Main Menu and Buttons">
<p class="Welcome">
<h1><center>Welcome to Insert Patient!</center></h1>
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
<h2>Insert Patient Details</h2>
    <form method="POST" action="add_patient.php">
        <label for="ohip">OHIP Number:</label><br>
        <input type="text" id="ohip" name="ohip" required><br><br>

        <label for="firstname">First Name:</label><br>
        <input type="text" id="firstname" name="firstname" required><br><br>

        <label for="lastname">Last Name:</label><br>
        <input type="text" id="lastname" name="lastname" required><br><br>

        <label for="weight">Weight (kg):</label><br>
        <input type="number" id="height" name="weight" step="0.01" min="0" required><br><br>

        <label for="height">Height (m):</label><br>
        <input type="number" id="height" name="height" step="0.01" min="0" required><br><br>

        <label for="birthdate">Birthdate:</label><br>
        <input type="date" id="birthdate" name="birthdate" required><br><br>

        <label for="doctor">Assign Doctor:</label><br>
        <select id="doctor" name="doctor" required>
            <option value="" disabled selected>Select a Doctor</option>
            <?php
            include 'connectdb.php'; // Database connection

            $query = "SELECT docid, firstname, lastname FROM doctor";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                die("Database query failed: " . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['docid'] . "'>Doctor " . $row['firstname'] . " " . $row['lastname'] . "</option>";
            }

            mysqli_free_result($result);
            ?>
        </select><br><br>

        <button type="submit" name="submit">Add Patient</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $ohip = $_POST['ohip'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $birthdate = $_POST['birthdate'];
        $doctor = $_POST['doctor'];

        $check_query = "SELECT COUNT(*) AS count FROM patient WHERE ohip = '$ohip'";
        $check_result = mysqli_query($connection, $check_query);

        if (!$check_result) {
            die("Database query failed: " . mysqli_error($connection));
        }

        $row = mysqli_fetch_assoc($check_result);

        if ($row['count'] == 1) {
            echo "This OHIP number exists. Try again.";
        }
        else {
            $insert_query = "INSERT INTO patient (ohip, firstname, lastname, weight, height, birthdate, treatsdocid) VALUES ('$ohip', '$firstname', '$lastname', '$weight', '$height', '$birthdate', '$doctor')";
            if (mysqli_query($connection, $insert_query)) {
                echo "The patient was added successfully.";
            }
            else {
                echo "Error: " . mysqli_error($connection);
            }
        }
        mysqli_free_result($check_result);
        mysqli_close($connection);
    }
    ?>
</div>
</body>
</html>
