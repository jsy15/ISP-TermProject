<!DOCTYPE html>

<html>
<head>
      <title> Database Grading </title>
      <meta charset = "utf-8" />
      <style type = "text/css">
      td, th, table {border: thin solid black; border-collapse: collapse;}
          </style>
      <script>
          function show() {
              document.getElementById("out").innerHTML = document.getElementById("in").value;
        }
      </script>
</head>
<body>
<button id="showtable" onclick="showtable()" style="display:none;">Show the Table</button>
<button id="hidetable" onclick="hidetable()" style="display:block;">Hide the Table</button>
<script>
function showtable(){
  document.getElementById('databaseshow').style.display = "block";
  document.getElementById('hidetable').style.display = "inherit";
  document.getElementById('showtable').style.display = "none";
}

function hidetable(){
  document.getElementById('databaseshow').style.display = "none";
  document.getElementById('hidetable').style.display = "none";
  document.getElementById('showtable').style.display = "block";
}
</script>
<?php
print "<div id = \"databaseshow\" style=\"display:block;\">";
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
    print "</div>";
?>

    <form action = "http://pausch.cs.uakron.edu/~jsy15/php/db-starter1.php"
          method = "post">
      <h2> Playing with Database </h2>
      <table>
          <tr>
            <th> Student ID </th>
            <th> First Name </th>
            <th> Last Name </th>
            <th> Grade1 </th>
            <th> Grade2 </th>
            <th> Grade3 </th>
            <th> Grade4 </th>
            <th> Grade5 </th>
          </tr>
          <tr>
            <td><input type = "text"  name = "uaid" size = "6" value = "0" /></td>
            <td><input type = "text"  name = "fname" size = "16" value = "Test" /></td>
            <td><input type = "text"  name = "lname" size = "16" value = "test" /></td>
            <td><input type = "text"  name = "grade1" size = "2" value = "A" /></td>
            <td><input type = "text"  name = "grade2" size = "2" value = "A" /></td>
            <td><input type = "text"  name = "grade3" size = "2" value = "A" /></td>
            <td><input type = "text"  name = "grade4" size = "2" value = "A" /></td>
            <td><input type = "text"  name = "grade5" size = "2" value = "A" /></td>

          </tr>
      </table>
      <p />
<h3> Action </h3>
      <p>
        <input type = "radio"  name = "action"  value = "display" checked = "checked" />
		Display all records <br />
        <input type = "radio"  name = "action"  value = "insert" />
		Add a new record <br />
        <input type = "radio"  name = "action"  value = "update" />
		Update an existing record <br />
        <input type = "radio"  name = "action"  value = "delete" />
		Delete an existing record <br />
        <input type = "radio"  name = "action"  value = "user" />
		Enter your own SQL statement below <br />
        <input type = "text";  name = "statement" size = "40" value = "select * from term_project" id = "in" /> <br /><br />
        <input type = "reset"  value = "Reset Form" />
        <input type = "submit"  value = "Excute SQL" />
<br />

 <button type="button" onclick="show()">Show SQL</button><br />
 <span id = "out" style="color:red"></span> <br /><br />

        </p>
    </form>
  </body>
</html>
