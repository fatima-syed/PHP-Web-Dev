<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once(".\config.php");

// all attributes of employee table uncluded in input fields
if(isset($_POST['Submit'])) {	
	$picPath = mysqli_real_escape_string($mysqli, $_POST['picPath']);
	$employeeNumber = mysqli_real_escape_string($mysqli, $_POST['employeeNumber']);
	$firstName = mysqli_real_escape_string($mysqli, $_POST['firstName']);
	$lastName = mysqli_real_escape_string($mysqli, $_POST['lastName']);
	$extension = 'x' . mysqli_real_escape_string($mysqli, $_POST['extension']);   // format of extension: x0000
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);
	$officeCode = mysqli_real_escape_string($mysqli, $_POST['officeCode']);
	$reportsTo = mysqli_real_escape_string($mysqli, $_POST['reportsTo']);
	$jobTitle = mysqli_real_escape_string($mysqli, $_POST['jobTitle']);
		
	// checking empty fields
	if(empty($picPath) || empty($employeeNumber) ||empty($firstName) ||empty($lastName) || empty($extension) || empty($email)||empty($officeCode) ||empty($reportsTo)||empty($jobTitle)) {
		if(empty($picPath)) {
			$picPath = "";
		}

		if(empty($employeeNumber)) {
			echo "<font color='red'>ID field is empty.</font><br/>";
		}
		if(empty($firstName)) {
			echo "<font color='red'>First Name field is empty.</font><br/>";
		}
		if(empty($lastName)) {
			echo "<font color='red'>Last Name field is empty.</font><br/>";
		}
		
		if(empty($extension)) {
			echo "<font color='red'>Extension field is empty.</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}
		if(empty($officeCode)) {
			echo "<font color='red'>Office Code field is empty.</font><br/>";
		}
		if(empty($reportsTo)) {
			echo "<font color='red'>Reports To field is empty.</font><br/>";
		}
		if(empty($jobTitle)) {
			echo "<font color='red'>Job Title field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO employees VALUES('$picPath','$employeeNumber','$lastName', '$firstName','$extension','$email','$officeCode','$reportsTo','$jobTitle')");
		
		//display success message
		echo "<font color='green'>Record added successfully!";
		echo "<br/><a style=\"text-decoration:none;color:royalblue;\" href='index.php'>View Changes</a>";
	}
	
	$mysqli->close();
}
?>
</body>
</html>
