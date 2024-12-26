<!This displays the first and last name of the doctor along with the id of doctors who has no patients, and for the doctors who do have patients, it displays the name of the patients alongside them
>
<!DOCTYPE html>
<html>
<head>
<div id="header">
<title>View Doctors</title>
</div>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
include 'connectdb.php';
?>
<div id="Main Menu and Buttons">
<p class="Welcome">
<h1><center>Welcome to View Doctors!</center></h1>
</p>
<hr>
<div class="button-group"><center>
    <a href="mainmenu.php"><button>Main Menu</button></a>
    <a href="list_patients.php"><button>List Patients</button></a>
    <a href="add_patient.php"><button>Add New Patient</button></a>
    <a href="delete_patient.php"><button>Delete Patient</button></a>
    <a href="update_patient.php"><button>Update Patient</button></a>
    <a href="nurse_details.php"><button>View Nurse Details</button></a>
</center></div>
<hr>
<h2>Doctors and their Patients</h2>
<?php
    include "doc_patients.php";
?>
<br><br><br>
<h2>Doctors with no Patients:</h2>
<?php
    include "no_doc_patients.php"
?>
</div>
</body>
</html>
