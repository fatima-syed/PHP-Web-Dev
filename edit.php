<?php
// including the database connection file
include_once(".\config.php");

if(isset($_POST['update'])){    
    $picPath = mysqli_real_escape_string($mysqli, $_POST['picPath']);
    $employeeNumber = mysqli_real_escape_string($mysqli, $_POST['employeeNumber']);
    $firstName = mysqli_real_escape_string($mysqli, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($mysqli, $_POST['lastName']);
    $extension = 'x' . mysqli_real_escape_string($mysqli, $_POST['extension']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $officeCode = mysqli_real_escape_string($mysqli, $_POST['officeCode']);
    $reportsTo = mysqli_real_escape_string($mysqli, $_POST['reportsTo']);
    $jobTitle = mysqli_real_escape_string($mysqli, $_POST['jobTitle']);
    
    // checking empty fields
    if(empty($picPath) || empty($employeeNumber) ||empty($firstName) ||empty($lastName) || empty($extension) || empty($email)||empty($officeCode) ||empty($reportsTo)||empty($jobTitle)) {
          
        if(empty($picPath)) {
          $picPath="";
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
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE employees SET picPath='$picPath', firstName='$firstName',lastName='$lastName',extension='$extension',email='$email',officeCode='$officeCode',reportsTo='$reportsTo',jobTitle='$jobTitle' WHERE employeeNumber=$employeeNumber");
        
        $mysqli->close();
        //redirectig to the display page. In our case, it is index.php
        header("Location: index.php");
    }
}
?>

<?php
// using GET to retrieve employee number from URL
$employeeNumber = $_GET['id'];

// Retrieving data of the selected employee
$result = mysqli_query($mysqli, "SELECT * FROM employees WHERE employeeNumber=$employeeNumber");

while($res = mysqli_fetch_array($result)){
    $picPath = $res['picPath'];
    $firstName =  $res['firstName'];
    $lastName =  $res['lastName'];
    $extension =  substr($res['extension'],1);
    $email =  $res['email'];
    $officeCode =  $res['officeCode'];
    $reportsTo = $res['reportsTo'];
    $jobTitle =  $res['jobTitle'];
}
$mysqli->close();
?>

<html>
<head>  
    <title>Edit Data</title>
    <link rel="stylesheet" href="styles.css">
    <style>
      #updatebtn{
        padding:8px 12px;
        margin-top:15px;
        transition: background 0.8s;
        background-color: white;
        border-radius: 5px;
        color: black;
        font-weight: bold;
      }
      #updatebtn:hover{
          background: violet;
      }
      body>a{
        text-decoration: none;
        color: royalblue;
        transition: color 0.8s;
      }
      body>a:hover{
        color:navy;
      }
    </style>
</head>

<body>
    <a href="index.php"><h3>Home</h3></a>
    <br/>
    <form action="edit.php" method="post" name="form1">
      <div style="width: 20%">
        <div class="flex">
          <label>First Name</label>
          <input type="text" name="firstName" required value="<?php echo $firstName;   ?>"/>
        </div>
        <div class="flex">
          <label>Last Name</label>
          <input type="text" name="lastName" required value="<?php echo $lastName;   ?>"/>
        </div>
        <div class="flex">
          <label>Extension</label>
          <input type="number" name="extension" required value="<?php echo $extension;   ?>"/>
        </div>
        <div class="flex">
          <label>Email</label>
          <input type="email" name="email" required value="<?php echo $email;   ?>"/>
        </div>
        <div class="flex">
          <label>Office Code</label>
          <input type="number" name="officeCode" required value="<?php echo $officeCode;   ?>"/>
        </div>
        <div class="flex">
          <label>Reports To</label>
          <input type="number" name="reportsTo" required value="<?php echo $reportsTo;   ?>"/>
        </div>
        <div class="flex">
          <label>Job Title</label>
          <input type="text" name="jobTitle" required value="<?php echo $jobTitle;   ?>"/>
        </div>
        <div class="flex">
          <label for="img">Profile Picture:</label>
          <input type="text" name="picPath" value="<?php echo $picPath;   ?>"/>
        </div>
        <div class="flex">
            <td><input type="hidden" name="employeeNumber" value="<?php echo $_GET['id'];?>"></td>
            <td><input type="submit" name="update" value="Update" id="updatebtn"></td>
        </div>
      </div>
    </form>
            
        
</body>
</html>

