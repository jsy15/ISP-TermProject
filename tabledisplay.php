<?php
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
        print "<th class=\"labels\">" . $keys[2 * $index + 1] . "</th>";
    for ($temp = 1; $temp <= 5; $temp++)
      print"<th class=\"labels\"> Project $temp </th>";
    print "</tr>";

    $store = "";


    // Output the values of the fields in the rows
    for ($row_num = 0; $row_num < $num_rows; $row_num++) {
        print "<tr align = 'center'>";
        $values = array_values($row);
        $value = htmlspecialchars($values[1]);
        if($store == ""){
          $store =  htmlspecialchars($values[1]);
        }
        print "<th>" . $value;
        for ($index = 1; $index < $num_fields; $index++){
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
    ?>
