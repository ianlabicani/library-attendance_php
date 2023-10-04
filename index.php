<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Attendance</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js
" defer></script>
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
    <div class="container mt-5">
      <form action="process.php" method="post">
        <div class="form-group">
          <label for="lastname">Last Name:</label>
          <input type="text" class="form-control" id="lastname" name="lastname" required>
        </div>

        <div class="form-group">
          <label for="firstname">First Name:</label>
          <input type="text" class="form-control" id="firstname" name="firstname" required>
        </div>

        <div class="form-group">
          <label for="middlename">Middle Name:</label>
          <input type="text" class="form-control" id="middlename" name="middlename">
        </div>

        <div class="form-group">
          <label for="student_number">Student Number:</label>
          <input type="text" class="form-control" id="student_number" name="student_number" required>
        </div>

        <div class="form-group">
          <label for="course">Course:</label>
          <select class="form-control" id="course" name="course">
            <option value="bsit">bsit</option>
            <option value="crim">crim</option>
            <option value="chm">chm</option>
            <option value="educ">educ</option>
            <option value="cit">cit</option>
            <option value="cfas">cfas</option>
            <option value="cbea">cbea</option>
          </select>
        </div>

        <div class="form-group">
          <label for="year_level">Year Level:</label>
          <select class="form-control" id="year-level" name="year_level">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </div>

        <div class="form-group">
          <label for="section">Section:</label>
          <select class="form-control" id="section" name="section">
            <option value="a">a</option>
            <option value="b">b</option>
            <option value="c">c</option>
            <option value="d">d</option>
            <option value="e">e</option>
            <option value="f">f</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
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
  $sql = "SELECT * FROM students_tbl ORDER BY id DESC";

  // Execute the query and store the result
  $result = $conn->query($sql);

  // Check if there are any records
  if ($result->num_rows > 0) {
    echo "<h2>Attendance Records</h2>";
    echo "<table class='table table-bordered'>";
    echo "<thead class='thead-dark'>
          <tr>
              <th>Last Name</th>
              <th>First Name</th>
              <th>Middle Name</th>
              <th>Student Number</th>
              <th>Course</th>
              <th>Year Level</th>
              <th>Section</th>
              <th>Time In</th>
              <th>Time Out</th>
          </tr>
      </thead>";
    echo "<tbody>";

    // Loop through the records and display them in a table
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<form action='update.php' method='post'>";
      echo "<input type='hidden' name='student_id' value='{$row['id']}'>";

      $columns = ["lastname", "firstname", "middlename", "student_number", "course", "year_level", "section", "time_in", "time_out"];

      foreach ($columns as $column) {
        echo "<td>{$row[$column]}</td>";
      }

      $time_in_button = !$row["time_in"] ? "<button class='btn btn-primary' name='time_in' value='time_in'>Time In</button>" : "<button class='btn btn-secondary' disabled>Time In</button>";
      $time_out_button =  $row["time_out"] ? "<button class='btn btn-secondary' disabled>Time Out</button>" : "<button class='btn btn-primary' name='time_out' value='time_out'>Time Out</button>";

      echo "<td>$time_in_button</td>";
      echo "<td>$time_out_button</td>";

      echo "</form>";
      echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
  } else {
    echo "No attendance records found.";
  }
  ?>


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