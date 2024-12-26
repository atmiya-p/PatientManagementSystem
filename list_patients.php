<!This lists all the patients and it allows the user to order the data depending on if they want it by last name or first name. This also allows the user to order the patients they list out in assending or descending order. The weight and height are calculated to be in pounds and kilos and feet and inches and meters>
<!DOCTYPE html>
<html>
<head>
<div id="header">
<title>List Patients</title>
</div>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
include 'connectdb.php';
?>
<div id="Main Menu and Buttons">
<p class="Welcome">
<h1><center>Welcome to List Patients!</center></h1>
</p>
<hr>
<div class="button-group"><center>
    <a href="mainmenu.php"><button>Main Menu</button></a>
    <a href="add_patient.php"><button>Add New Patient</button></a>
    <a href="delete_patient.php"><button>Delete Patient</button></a>
    <a href="update_patient.php"><button>Update Patient</button></a>
    <a href="show_doctors.php"><button>View Doctors</button></a>
    <a href="nurse_details.php"><button>View Nurse Details</button></a>
</center></div>
<hr>
<form method="GET" action="list_patients.php">
<div class="radio-buttons">
    <h4>Sort by:</h4>
    <input type="radio" name="sort_by" value="lastname" checked> Last Name
    <input type="radio" name="sort_by" value="firstname"> First Name
    <br>
    <h4>Order:</h4>
    <input type="radio" name="order" value="ASC" checked> Ascending
    <input type="radio" name="order" value="DESC"> Descending
    <br><br>
    <button type="submit">Sort</button>
</div>
</form>
</div>
<?php
include 'getdata.php';
?>
</body>
</html>
