<?php

require("./inc/conn/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $lastname = $_POST["lastname"];
  $firstname = $_POST["firstname"];
  $middlename = $_POST["middlename"];
  $student_number = $_POST["student_number"];
  $course = $_POST["course"];
  $year_level = $_POST["year_level"];
  $section = $_POST["section"];

  // Create the SQL query to insert the data
  $sql = "INSERT INTO students_tbl (lastname, firstname, middlename, student_number,course, year_level, section)
          VALUES ('$lastname', '$firstname', '$middlename', '$student_number','$course','$year_level','$section')";

  // Execute the query
  if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully.";
    header("Location: index.php");
    exit; // Make sure to exit after the redirect
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}


//  register user
// time buttons: 1-0
// when user timeins, switch buttons: 0 - 1
// time buttons: 1-0