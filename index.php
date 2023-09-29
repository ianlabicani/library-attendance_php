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
      <label for="student_number">Student Number:</label>
      <input type="text" id="student_number" name="student_number" required><br><br>
      <label for="course">Course:</label>
      <select name="course" id="course">
        <option value="bsit">bsit</option>
        <option value="crim">crim</option>
        <option value="chm">chm</option>
        <option value="educ">educ</option>
        <option value="cit">cit</option>
        <option value="cfas">cfas</option>
        <option value="cbea">cbea</option>
      </select>
      <BR></BR>

      <label for="year_level">Year Level:</label>
      <select name="year_level" id="year-level">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
      </select>
      <br>
      <label for="section">Section:</label>
      <select name="section" id="section">
        <option value="a">a</option>
        <option value="b">b</option>
        <option value="c">c</option>
        <option value="d">d</option>
        <option value="e">e</option>
        <option value="f">f</option>
      </select>
      <br>


      <input type="submit" value="Submit">
    </form>
    <br><br><br>
    <hr>

  </body>

  </html>

  <?php
  // Include the database connection file
  include("./inc/conn/db.php");
  date_default_timezone_set('Asia/Manila');

  // Get and display the current time in the Philippines timezone
  $current_time = date("Y-m-d H:i:s"); // You can adjust the format as needed


  // Create an SQL query to select data from the database
  $sql = "SELECT * FROM students_tbl";

  // Execute the query and store the result
  $result = $conn->query($sql);

  // Check if there are any records
  if ($result->num_rows > 0) {
    echo "<h2>Attendance Records</h2>";
    echo "<table border='1'>";
    echo "<tr>
    <th>Last Name</th>
    <th>First Name</th>
    <th>Middle Name</th>
    <th>Student Number</th>
    <th>course</th>
    <th>Year Level</th>
    <th>Section</th>
    <th>time in</th>
    <th>time out</th>
  </tr>";

    // Loop through the records and display them in a table
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<form action='update.php' method='post'>";
      echo "<input type='hidden' name='student_id' value='${row['id']}'>";
      echo "<td>" . $row["lastname"] . "</td>";
      echo "<td>" . $row["firstname"] . "</td>";
      echo "<td>" . $row["middlename"] . "</td>";
      echo "<td>" . $row["student_number"] . "</td>";
      echo "<td>" . $row["course"] . "</td>";
      echo "<td>" . $row["year_level"] . "</td>";
      echo "<td>" . $row["section"] . "</td>";
      echo "<td>" . $row["time_in"] . "</td>";
      echo "<td>" . $row["time_out"] . "</td>";
      if (!$row["time_in"]) {
        echo "<td><button name='input_time' value='input_time'>time in</button></td>";
        echo "<td ><button disabled>time out</button></td>";
      } else {
        echo "<td ><button disabled>time in</button></td>";
        echo "<td ><button name='input_time' value='input_time'>time out</button></td>";
      }
      echo "</>";
      echo "</tr>";
    }

    echo "</table>";
  } else {
    echo "No attendance records found.";
  }

  // Close the database connection
  $conn->close();
  ?>

  <!-- 
  
    click time in
    get primary key
    update the record
    if success
    rerender
    do client side manipulation
  
  
   -->