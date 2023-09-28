<?php

require("./inc/conn/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $lastname = $_POST["lastname"];
  $firstname = $_POST["firstname"];
  $middlename = $_POST["middlename"];
  $timein = $_POST["timein"];
  $timeout = $_POST["timeout"];
  $studentnumber = $_POST["studentnumber"];
  $course = $_POST["course"];

  // Create the SQL query to insert the data
  $sql = "INSERT INTO cics_tbl (lastname, firstname, middlename, timein, timeout, studentnumber,course)
          VALUES ('$lastname', '$firstname', '$middlename', '$timein', '$timeout', '$studentnumber','$course')";

  // Execute the query
  if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully.";
    header("Location: index.php");
    exit; // Make sure to exit after the redirect
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
