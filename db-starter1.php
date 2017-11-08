<!-- db-starter.php
     A PHP script to demonstrate database programming.
-->
<html>
<head>
    <title> Database Programming with PHP </title>
    <style type = "text/css">
    td, th, table {border: thin solid black;}
    </style>
</head>
<body>

<?php

// Get input data
    $id = $_POST['uaid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $grade1 = $_POST['grade1'];
    $grade2 = $_POST['grade2'];
    $grade3 = $_POST['grade3'];
    $grade4 = $_POST['grade4'];
    $grade5 = $_POST['grade5'];
    $link1 = $_POST['link1'];
    $link2 = $_POST['link2'];
    $link3 = $_POST['link3'];
    $link4 = $_POST['link4'];
    $link5 = $_POST['link5'];
    $action = $_POST["action"];
    $statement = $_POST["statement"];

    // If any of numerical values are blank, set them to zero
    //if ($id == "") $id = 0;
    //if ($miles == "") $miles = 0.0;
    //if ($year == "") $year = 0;
    //if ($state == "") $state = 0;

// Connect to MySQL
//$db = mysql_connect("db1.cs.uakron.edu:3306", "xiaotest", "wpdb");
$db = mysqli_connect("db1.cs.uakron.edu:3306", "jsy15", "ookuHoh1");
//$db = mysqli_connect("db1.cs.uakron.edu:3306", "xiaotest", "wpdb","xiaotest");
if (!$db) {
     print "Error - Could not connect to MySQL";
     exit;
}

// Select the database
$er = mysqli_select_db($db,"ISP_jsy15");
if (!$er) {
    print "Error - Could not select the database";
    exit;
}

// print "<b> The action is: </b> $action <br />";

if($action == "display")
    $query = "select * from term_project";
else if ($action == "insert")
    $query = "insert into term_project values($id, $fname, $lname, $grade1, $grade2, $grade3, $grade4, $grade5, $link1, $link2, $link3, $link4, $link5)";
else if ($action == "update")
    $query = "update term_project set stud_id = $id, fname = $fname, lname = $lname, grade1 = $grade1, grade2 = $grade2, grade3 = $grade3, grade4 = $grade4, grade5 = $grade5 where stud_id = $id";
else if ($action == "delete")
    $query = "delete from term_project where Vette_id = $id";
else if ($action == "user")
    $query = $statement;


if($query != ""){
    trim($query);
    $query_html = htmlspecialchars($query);
    print "<b> The query is: </b> " . $query_html . "<br />";

    // Don't remove or comment out the line below untill you switched to your own database. VIOLATORS WILL BE SEVERELY PUNISHED!!! :-).
    //$query = "SELECT * FROM Corvettes";

    $result = mysqli_query($db,$query);
    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysqli_error();
        print "<p>" . $error . "</p>";
    }
}

// Final Display of All Entries
/*
$query = "SELECT * FROM term_project";
$result = mysqli_query($db,$query);
if (!$result) {
    print "Error - the query could not be executed";
    $error = mysqli_error();
    print "<p>" . $error . "</p>";
    exit;
}
*/

// Get the number of rows in the result, as well as the first row
//  and the number of fields in the rows
$num_rows = "";
$num_rows = mysqli_num_rows($result);
//print "Number of rows = $num_rows <br />";

print "<table><caption> <h2> Grades ($num_rows) </h2> </caption>";
print "<tr align = 'center'>";

$row = mysqli_fetch_array($result);
$num_fields = mysqli_num_fields($result);

// Produce the column labels
$keys = array_keys($row);
for ($index = 0; $index < $num_fields; $index++)
    print "<th>" . $keys[2 * $index + 1] . "</th>";
print "</tr>";

// Output the values of the fields in the rows
for ($row_num = 0; $row_num < $num_rows; $row_num++) {
    print "<tr align = 'center'>";
    $values = array_values($row);
    for ($index = 0; $index < $num_fields; $index++){
        $value = htmlspecialchars($values[2 * $index + 1]);
        print "<th>" . $value . "</th> ";
    }
    print "</tr>";
    $row = mysqli_fetch_array($result);
}
print "</table>";
?>
</body>
</html>

</body>
</html>
