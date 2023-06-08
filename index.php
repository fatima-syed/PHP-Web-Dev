<?php
//including the database connection file
include_once(".\config.php");

$result = mysqli_query($mysqli, "SELECT e1.employeeNumber, e1.picPath, concat(e1.firstName, ' ', e1.lastName) as name,e1.email,e1.jobTitle, concat(COALESCE(addressLine1, ''), ' ', COALESCE(addressLine2, ''), ' ',COALESCE(city, ''), ' ', COALESCE(state, ''),' ',COALESCE(country, '')) as officeAddress,concat(e2.firstName, ' ', e2.lastName, ', ' , e2.jobTitle) as reportsTo FROM employees e1,employees e2, offices where e1.reportsTo = e2.employeeNumber and e1.officeCode = offices.officeCode;"); // using mysqli_query instead
?>

<html>
<head>  
    <title>Table</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .flex {
        display: flex;
        justify-content: space-between;
        margin: 0px 0px 20px 0px;
        }
        table td,table th {
            border: 2px solid white;
            padding:5px;
        }
        table th {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        table td a{
            text-decoration: none;
        }
        #addbtn{
            padding:8px 12px;
            margin-top:15px;
            transition: background 0.8s;
            background-color: white;
            border-radius: 5px;
        }
        #addbtn:hover{
            background: violet;
        }
        #addbtn a{
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body style="background-image: url(https://mdbootstrap.com/img/Photos/new-templates/glassmorphism-article/img7.jpg);">
<?php

session_start();
$cValue = $_COOKIE['University'];
if(isset($_SESSION['userName'])){
    echo('Welcome ' . $_SESSION['userName']);
    echo('<br>CMS ID: ' . $_SESSION['cmdId']);
    echo("<br>University: <i><b>$cValue</b></i>");

    echo "<br/><a href='logout.php'>Go to Logout Page</a>";
}
else{
    echo('Please Log In to Continue');
    echo ('<br/><a href="login.php" target="_blank">Login Page</a>'); 
}
?>


<table border=3 style="margin:auto;border-collapse: collapse;border-color: royalblue;background:white">
    <caption><h2 style="color:white;">Employee Table</h2></caption>

    <tr bgcolor='violet'>
        <th></th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>JOB TITLE</th>
        <th>OFFICE ADDRESS</th>
        <th>REPORTS TO</th>
        <th>UPDATE</th>
    </tr>
    <?php 
        while($res = mysqli_fetch_array($result)) {         
            echo "<tr>";
            if($res['picPath'] != NULL){
                echo "<td> <a href=edit.php?id=$res[employeeNumber]>";
                echo "<img src=".$res['picPath']." alt='Employee Picture' width = '80px' height = '80px'>";
                echo "</a></td>";
            }
            else{
                echo "<td> <a href='edit.php?id=$res[employeeNumber]'>";
                echo "<img src='.\imgs\user-1699635_960_720.png' alt='Default Picture' width = '80px' height = '80px'>";
                echo "</a></td>";
            }

            echo "<td><b>".$res['name']."</td>";
            echo "<td>".$res['email']."</td>";
            echo "<td>".$res['jobTitle']."</td>";
            echo "<td>".$res['officeAddress']."</td>";  
            echo "<td>".$res['reportsTo']."</td>";  
            echo "<td><a style=\"color:orange;\" href=\"edit.php?id=$res[employeeNumber]\">Edit</a> | <a style=\"color:red;\" href=\"delete.php?id=$res[employeeNumber]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";       
        }
        $mysqli->close();
    ?>
    </table>
    <div style="text-align:center">
        <button id="addbtn"> <a href="create.html"><b>Add Employee</a></button>
    </div>
</body>
</html>

