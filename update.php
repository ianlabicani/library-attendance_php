<?php
require('./inc/conn/db.php');
date_default_timezone_set('Asia/Manila');

// Get and display the current time in the Philippines timezone
$current_time = date("Y-m-d H:i:s"); // You can adjust the format as needed

if (isset($_POST['input_time'])) {
  $student_id = $_POST['student_id']; // Replace with your method of obtaining the student ID
  $time_in = date("Y-m-d H:i:s"); // Get the current timestamp

  // Prepare and execute the SQL update statement

  $sql = "UPDATE students_tbl SET time_in = ? WHERE id = ?";
  // $sql1 = "UPDATE students_tbl SET time_in = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $time_in, $student_id); // Assuming student_number is the correct column name

  if ($stmt->execute()) {
    // $sql1 = "Select * from students_tbl where id = $student_id";
    echo "";
    echo "Time-in updated successfully.";
    header("Location: index.php");
  } else {
    echo "Error updating time-in: " . $stmt->error;
  }

  // Handle the button click event here
  // For example, update database records or perform any desired action.
}
