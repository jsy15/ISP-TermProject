<!DOCTYPE html>

<html>
<div class="topbar" id="topbar">
  <div class="topbarpanel">
      Jacob Yelling
  </div>
  <div class="topmidpanel">
    ISP Grade Assistance Website
  </div>
  <div class="topbarpanel">
      Matthew Britton
  </div>
</div>
<head>
      <title> Database Grading </title>
      <meta charset = "utf-8" />
      <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
  <br /><br /><br />
<!--Input section-->
<p>Add/Remove Students</p>
<form id="add-students" method="POST" action="termproj.php">
        <input class="inputColor" type="text" name="fname">First Name<br>
        <input class="inputColor" type="text" name="lname">Last Name<br>
        <input class="inputColor" type="text" name="stud_id">Student ID<br>
        <input class="myButton" type="submit" name="add_student" value="Add">
        <input class="myButton" type="submit" name="remove_student" value="Remove">
        <input class="myButton" type="reset" value="Reset">
</form>
<hr class="blackHr">
<p>Update Grades</p>
<form id="add-grades" method="POST" action="termproj.php">
        <input class="inputColor" type="text" name="stud_id_g">Student ID<br>
        <select class="myButton" name= "asgmt" form="add-grades">
          <option class="myButton" value="grade1">PA1</option>
          <option class="myButton" value="grade2">PA2</option>
          <option class="myButton" value="grade3">PA3</option>
          <option class="myButton" value="grade4">PA4</option>
          <option class="myButton" value="grade5">PA5</option>
        </select>
        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;
        Assignment<br>
        <input class="inputColor" type="text" name="grade">Grade (ABCDF+-)<br>
        <input class="myButton" type="submit" name="update_grade" value="Update">
        <input class="myButton" type="reset" value="Reset">
</form>
<hr class="blackHr"><br /><br />



<!-- I need to move these buttons to look better. Also style them in external css -->
<button id="showtable" onclick="showtable()" style="display:none;" class="myButton">Show the Table</button>
<button id="hidetable" onclick="hidetable()" style="display:block;" class="myButton">Hide the Table</button>
<button id="tableupdate" onclick="popupNot()" class="myButton">Force Update Table</button>

<div class="popup" style="position:absolute; top: 120px; left: 750px;"><span class="popuptext" id="myPopup">Table Updated</span></div>
<script src="script.js"></script>

<div id = "databaseshow" class="tableShow">
</div>

<!-- Can't move this into external file. Ajax call and defining. -->
<script>
function popupNot(){
  displayTable();
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
  setTimeout(function(){popup.classList.toggle("show");},2000);

}
function displayTable(){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById('databaseshow').innerHTML = this.responseText;
  }
  }
  xmlhttp.open("GET","tabledisplay.php",true);
  xmlhttp.send();
}
    displayTable();
</script>

<?php
//print "<div id = \"databaseshow\" style=\"display:block;\">";
$db = mysqli_connect("db1.cs.uakron.edu:3306", "jsy15", "termProjJacob17");
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
/*
  $query = "SELECT * FROM term_project";
  $result = mysqli_query($db,$query);
  if (!$result) {
      print "Error - the query could not be executed";
      $error = mysqli_error();
      print "<p>" . $error . "</p>";
      exit;
    }
    $num_rows = "";
    $num_rows = mysqli_num_rows($result);

    print "<table><caption> <h2> Grades ($num_rows) </h2> </caption>";
    print "<tr align = 'center'>";

    $row = mysqli_fetch_array($result);
    $num_fields = mysqli_num_fields($result);

    // Produce the column labels
    $keys = array_keys($row);
    for ($index = 0; $index < $num_fields; $index++)
        print "<th>" . $keys[2 * $index + 1] . "</th>";
    for ($temp = 1; $temp <= 5; $temp++)
      print"<th> Project $temp </th>";
    print "</tr>";

    $store = "";


    // Output the values of the fields in the rows
    for ($row_num = 0; $row_num < $num_rows; $row_num++) {
        print "<tr align = 'center'>";
        $values = array_values($row);
        for ($index = 0; $index < $num_fields; $index++){
            $value = htmlspecialchars($values[2 * $index + 1]);
            if($store == ""){
              $store =  htmlspecialchars($values[1]);
            }
            print "<th>" . $value;

        }
        print "<th><a href=\"http://pausch.cs.uakron.edu/~$store/pa1/pa1.html\" target=\"_blank\">Link 1</a> </th>";
        print "<th><a href=\"http://pausch.cs.uakron.edu/~$store/pa2/pa2.html\" target=\"_blank\">Link 2</a> </th>";
        print "<th><a href=\"http://pausch.cs.uakron.edu/~$store/pa3/pa3.php\" target=\"_blank\">Link 3</a> </th>";
        print "<th><a href=\"http://pausch.cs.uakron.edu/~$store/pa4/pa4.html\" target=\"_blank\">Link 4</a> </th>";
        print "<th><a href=\"http://pausch.cs.uakron.edu/~$store/pa5/pa1.html\" target=\"_blank\">Link 5</a> </th>";
        print "</tr>";
        $row = mysqli_fetch_array($result);
        $store = "";
    }
    print "</table>";
//    print "</div>";
*/

    //Handle input, if any
  if(!empty($_POST)) {
    //Add student
    if(isset($_POST["add_student"])) {
      if(isset($_POST["fname"]) && isset($_POST["lname"]) && $_POST["stud_id"]){

        $stud_id = $_POST["stud_id"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];

        //Insert the student's info into the database
        $query = "INSERT INTO term_project (stud_id, fname, lname, grade1, grade2, grade3, grade4, grade5)
                            VALUES ('$stud_id', '$fname', '$lname', NULL, NULL, NULL, NULL, NULL);";
        if(mysqli_query($db, $query)) {
          print "<p> $fname's information was successfully inserted.</p>";
        }
        else {
          print "<p>Error: " . mysqli_error($db) . "</p>";
        }
      }
    }
    //Remove student
    elseif(isset($_POST["remove_student"])) {
      if(isset($_POST["fname"]) && isset($_POST["lname"]) && $_POST["stud_id"]){
        //Remove the student's info from the database
        $stud_id = $_POST["stud_id"];

        $query = "DELETE FROM term_project WHERE stud_id = '$stud_id';";

        if(mysqli_query($db, $query)) {
          print "<p>Successfully removed $stud_id's record.</p>";
        }
        else {
          print "<p>Error deleting record: " . mysqli_error($db) . "</p>";
        }
      }
    }
    //Update grades
    elseif(isset($_POST["update_grade"])) {
      if(isset($_POST["stud_id_g"]) && isset($_POST["asgmt"]) && isset($_POST["grade"])) {
        //Update the grade for the given assignment
        $stud_id_g = $_POST["stud_id_g"];
        $asgmt = $_POST["asgmt"];
        $grade = $_POST["grade"];

        $query = "UPDATE term_project SET $asgmt='$grade' WHERE stud_id='$stud_id_g';";

        if(mysqli_query($db, $query)) {
          print "Grade for $stud_id_g updated successfully.";
        }
        else {
          print "Error updating grade: " . mysqli_error($db);
        }
      }
    }
  }
?>
        </p>
        <div id="tableout">

        </div>
    </form>
  </body>
</html>
