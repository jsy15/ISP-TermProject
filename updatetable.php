<?php

$id = $_POST["row"];

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
  $query = "DELETE FROM term_project WHERE stud_id = '$id'";
  if($query != ""){
    trim($query);
    $query_html = htmlspecialchars($query);
    print "<b> The query is: </b> " . $query_html . "<br />";

    $result = mysqli_query($db,$query);
    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysqli_error();
        print "<p>" . $error . "</p>";
    }

    header("location: index.php");
}
