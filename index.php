<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Attendance</title>
</head>

<body>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CICS Attendance</title>

    <style>
      #signature {
        border: 1px solid black;
      }
    </style>
  </head>

  <body>
    <h2>Attendance Form</h2>
    <form action="process.php" method="post">
      <label for="lastname">Last Name:</label>
      <input type="text" id="lastname" name="lastname" required><br><br>

      <label for="firstname">First Name:</label>
      <input type="text" id="firstname" name="firstname" required><br><br>

      <label for="middlename">Middle Name:</label>
      <input type="text" id="middlename" name="middlename"><br><br>

      <label for="timein">Time In:</label>
      <input type="time" id="timein" name="timein" required><br><br>

      <label for="timeout">Time Out:</label>
      <input type="time" id="timeout" name="timeout" required><br><br>

      <label for="studentnumber">Student Number:</label>
      <input type="text" id="studentnumber" name="studentnumber" required><br><br>
      <label for="course">Course:</label>
      <input type="text" id="course" name="course" required><br><br>

      <input type="submit" value="Submit">
    </form>
    <br><br><br>
    <hr>

  </body>

  </html>

  <?php
  // Include the database connection file
  include("./inc/conn/db.php");

  // Create an SQL query to select data from the database
  $sql = "SELECT * FROM cics_tbl";

  // Execute the query and store the result
  $result = $conn->query($sql);

  // Check if there are any records
  if ($result->num_rows > 0) {
    echo "<h2>Attendance Records</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Last Name</th><th>First Name</th><th>Middle Name</th><th>Time In</th><th>Time Out</th><th>Student Number</th><th>course</th></tr>";

    // Loop through the records and display them in a table
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["lastname"] . "</td>";
      echo "<td>" . $row["firstname"] . "</td>";
      echo "<td>" . $row["middlename"] . "</td>";
      echo "<td>" . $row["timein"] . "</td>";
      echo "<td>" . $row["timeout"] . "</td>";
      echo "<td>" . $row["studentnumber"] . "</td>";
      echo "<td>" . $row["course"] . "</td>";
      echo "</tr>";
    }

    echo "</table>";
  } else {
    echo "No attendance records found.";
  }

  // Close the database connection
  $conn->close();
  ?>