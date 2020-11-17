<?php
// Create connection
$dbOk = false;
@ $conn = new mysqli('localhost', 'root', '', 'websyslab9');
if ($conn->connect_error) {
    echo '<div class="messages">Could not connect to the database. Error: ';
    echo $conn->connect_errno . ' - ' . $conn->connect_error . '</div>';
} else {
    $dbOk = true;
}

$sqlCourses = "SELECT * FROM `courses`";
$sqlStudents = "SELECT * FROM `students`";
$sqlGrades= "SELECT * FROM `grades`";
$allStudents= $conn->query($sqlStudents);
$allCourses = $conn->query($sqlCourses);
$allGrades = $conn->query($sqlGrades);
$sqlAddress= "SELECT street FROM `students`";

// Add address files(street, city, state, zip) to the students table.
if (isset($_POST['add_address'])) {
    $address = $_POST['add_address'];
    if ($address){
        $sql_street="ALTER TABLE students ADD COLUMN street varchar(100)";
        $conn->query($sql_street);
        $sql_city="ALTER TABLE students ADD COLUMN city varchar(100)";
        $conn->query($sql_city);
        $sql_state="ALTER TABLE students ADD COLUMN state varchar(100)";
        $conn->query($sql_state);
        $sql_zip="ALTER TABLE students ADD COLUMN zip int(5)";
        $conn->query($sql_zip);
    }
}

// Add section and year field to the courses table.
if (isset($_POST['add_section_year'])) {
    $section_year = $_POST['add_section_year'];
    if ($section_year){
        $sql_section="ALTER TABLE courses ADD COLUMN section int(2)";
        $conn->query($sql_section);
        $sql_year="ALTER TABLE courses ADD COLUMN year int(4)";
        $conn->query($sql_year);
    }
}

// sorting students by column button
if((isset($_POST['sortStudents']) ? $_POST['sortStudents'] : NULL)){
    $sortStudents = (isset($_POST['sortStudents']) ? $_POST['sortStudents'] : NULL);
    $sqlStudents = 'SELECT * FROM `students`';
    if($sortStudents != NULL) {
        $sqlStudents .= ' ORDER BY ' . $sortStudents;
    }
}

// Create a grades table containing id, crn, RIN, and grade.
if (isset($_POST['grade_table'])) {
    $grade_table = $_POST['grade_table'];
    if ($grade_table){
        $sql_grade="CREATE TABLE grades( 
                      id int(10) AUTO_INCREMENT, 
                      crn int, 
                      RIN int, 
                      grade int(3) NOT NULL, 
                      PRIMARY KEY(id), 
                      FOREIGN KEY(crn) REFERENCES courses(crn), 
                      FOREIGN KEY(RIN) REFERENCES students(RIN)
                      )";
        $conn->query($sql_grade);
    }
}

// adding Courses
if (isset($_POST['addCourses'])) {
    if ($dbOk) {
        $crn = $_POST['crn'];
        $prefix = $_POST['prefix'];
        $number = $_POST['number'];
        $title = $_POST['title'];
        $qry = "SELECT section FROM courses";
        $check = $conn->query($qry);
        if($check==TRUE){
            $section = $_POST['section'];
            $year = $_POST['year'];
            $Query_AddCourses = "INSERT INTO `courses` (`crn`, `prefix`, `number` , `title`, `section`, `year`) VALUES ('".$crn."', '".$prefix."', '".$number."', '".$title."','".$section."', '".$year."')";
        }
        else{
            $Query_AddCourses = "INSERT INTO `courses` (`crn`, `prefix`, `number` , `title`) VALUES ('".$crn."', '".$prefix."', '".$number."', '".$title."')";
        }
        $conn->query($Query_AddCourses);
    }
}


// adding Students
if (isset($_POST['addStudents'])) {
    if ($dbOk){
        $RIN = $_POST['RIN'];
        $RCSID = $_POST['rcsid'];
        $first_name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $alias = $_POST['alias'];
        $phone = $_POST['phone'];
        $qry = "SELECT street FROM students";
        $check = $conn->query($qry);
        if($check==True){
            $street = $_POST['street'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];
            $Query_AddStudents = "INSERT INTO `students` (RIN, RCSID, first_name, last_name, alias, phone, street, city, state, zip) VALUES ('".$RIN."', '".$RCSID."', '".$first_name."', '".$last_name."', '".$alias."', '".$phone."','".$street."','".$city."','".$state."','".$zip."')";
        }
        else{
            $Query_AddStudents = "INSERT INTO `students` (RIN, RCSID, first_name, last_name, alias, phone) VALUES ('".$RIN."', '".$RCSID."', '".$first_name."', '".$last_name."', '".$alias."', '".$phone."')";
        }
        $conn->query($Query_AddStudents);
    }

}

// adding grades
if (isset($_POST['addGrade'])) {
    if ($dbOk) {
        $crn = $_POST['crn'];
        $rin = $_POST['RIN'];
        $grade = $_POST['grade'];
        $sqlAddGrade = "INSERT INTO `grades` (`crn`, `RIN`, `grade`) VALUES ('".$crn."', '".$rin."', '".$grade."')";
        $conn->query($sqlAddGrade);
    }
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<title>Gradebook - Lab 9</title>
	<link rel="stylesheet" href="index.css">
</head>
<body>
<header>
	<h1>Gradebook</h1>
</header>
<div class="studentsTable">
	<h4>Current Students</h4>
	<div class="students">
      <?php
      if($dbOk){
          echo "<table>
                <tr>
                <th>RIN</th>
                <th>RCS</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Alias</th>
                <th>Phone</th>";
          $qry = "SELECT street FROM students";
          $check = $conn->query($qry);
          if($check==TRUE){
              echo "<th>Address</th>";
          }
          echo "</tr>";

          $result = $conn->query($sqlStudents);
          $numRecords = $result->num_rows;
          for ($i=0; $i < $numRecords; $i++) {
              $record = $result->fetch_assoc();
              echo '<tr>';
              echo '<th class="RIN">'.$record['RIN'].'</th>';
              echo '<th class="RCS">'.$record['RCSID'].'</th>';
              echo '<th class="fname">'.$record['first_name'].'</th>';
              echo '<th class="lname">'.$record['last_name'].'</th>';
              echo '<th class="alias">'.$record['alias'].'</th>';
              echo '<th class="phone">'.$record['phone'].'</th>';
              //$check = "SHOW COLUMNS FROM `students` LIKE 'street'";
              //$exists = ($conn->query($check))?TRUE:FALSE;
              if($check==TRUE){
                  echo '<th class="address">'.$record["street"] . " " . $record["city"]  . " " . $record["state"] . " " . $record["zip"] . '</th>';
              }
              echo "</tr>";
          }
          echo "</table>";
          $result->free();
      }
      else {
          echo "No data";
      }
      ?>

		<!-- Insert students -->
		<form class="addStudents" action="index.php" method="post">
			<h4>Add Student:</h4>
			<div class="input_block">
				<span class="input_type">RIN: <br /></span><input type="int" name="RIN" value="">
				<span class="input_type"><br />RCSID: <br /></span><input type="text" name="rcsid" value="">
				<span class="input_type"><br />First Name: <br /></span><input type="text" name="fname" value="">
				<span class="input_type"><br />Last Name: <br /></span><input type="text" name="lname" value="">
				<span class="input_type"><br />Alias: <br /></span><input type="text" name="alias" value="">
				<span class="input_type"><br />Phone: <br /></span><input type="int" name="phone" value=""><br /><br />
          <?php
          $qry = "SELECT street FROM students";
          $check = $conn->query($qry);
          if($check==TRUE){
              echo '<span class="input_type">Street: <br /></span><input type="text" name="street" value="">';
              echo '<span class="input_type"><br />City: <br /></span><input type="text" name="city" value="">';
              echo '<span class="input_type"><br />State: <br /></span><input type="text" name="state" value="">';
              echo '<span class="input_type"><br />Zip: <br /></span><input type="int" name="zip" value=""><br /><br />';
          }
          ?>
				<input type="submit" name="addStudents" value="Add">
			</div>
		</form>

		<!-- button for grades above 90 -->
		<form class="buttons" action="index.php" method="post">
			<input type="submit" name="add_address" value="Add address fields">
		</form>
		<form class="buttons" action="index.php" method="post">
			<input type="submit" name="higher" value="Grade higher than 90">
		</form>
      <?php
      // List all students RIN, name, and address if their grade in any course was higher than a 90
      if (isset($_POST['higher']))  {
          if($dbOk){
              $sql_higher="SELECT students.RIN, students.first_name, students.last_name, students.street, students.city, students.state, students.zip FROM `students`, `grades` WHERE grades.grade > 90 and students.RIN = grades.RIN";
              if ($conn->query($sql_higher)->num_rows > 0) {
                  echo "<table>
                                            <tr>
                                            <th>RIN</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>";
                  $qry = "SELECT street FROM students";
                  $check = $conn->query($qry);
                  if($check==TRUE){
                      echo "<th>Address</th>";
                  }
                  echo "</tr>";
                  $result = $conn->query($sql_higher);
                  $numRecords = $result->num_rows;
                  for ($i=0; $i < $numRecords; $i++) {
                      $record = $result->fetch_assoc();
                      echo '<tr>';
                      echo '<th class="RIN">'.$record['RIN'].'</th>';
                      echo '<th class="fname">'.$record['first_name'].'</th>';
                      echo '<th class="lname">'.$record['last_name'].'</th>';
                      if($$check==TRUE){
                          echo '<th class="address">'.$record["street"] . $record["city"]  . " " . $record["state"] . " " . $record["zip"] . '</th>';
                      }
                      echo "</tr>";
                  }
                  echo "</table>";
                  $result->free();
              }
              else {
                  echo "No Data";
              }


          }
      }
      ?>

		<form class="sorting">
			<span class="sort_word">Sort By: </span><select name="sortStudents">
				<option value="rin">RIN</option>
				<option value="RCSID">RCSID</option>
				<option value="first_name">First Name</option>
				<option value="last_name">Last Name</option>
			</select>
			<button type="submit" formaction="?" formmethod="post">Submit</button>
		</form>
	</div>
</div>
<div class="coursesTable">
	<h4>Current Courses</h4>
	<div class="courses">
      <?php
      if($dbOk){
          echo "<table>
                          <tr>
                          <th>CRN</th>
                          <th>Prefix</th>
                          <th>Number</th>
                          <th>Title</th>";
          $qry = "SELECT section FROM courses";
          $check = $conn->query($qry);
          if($check==TRUE){
              echo "<th>Section</th>
                    <th>Year</th>";
          }
          echo "</tr>";
          $result = $conn->query($sqlCourses);
          $numRecords = $result->num_rows;
          for ($i=0; $i < $numRecords; $i++) {
              $record = $result->fetch_assoc();
              echo '<tr>';
              echo '<th class="CRN">'.$record['crn'].'</th>';
              echo '<th class="prefix">'.$record['prefix'].'</th>';
              echo '<th class="number">'.$record['number'].'</th>';
              echo '<th class="title">'.$record['title'].'</th>';
              if($check==TRUE){
                  echo '<th class="section">'.$record['section'] .'</th>';
                  echo '<th class="year">'.$record['year'] .'</th>';
              }
              echo "</tr>";
          }
          echo "</table>";
          $result->free();
      }

      else {
          echo "No data";
      }
      ?>

		<form class="buttons" action="index.php" method="post">
			<input type="submit" name="add_section_year" value="Add section and year">
		</form>
		<form class="buttons" action="index.php" method="post">
			<input type="submit" name="grade_table" value="Create Grades Table">
		</form>
		<!-- button for counting number of students (above table) -->
		<form class="buttons" action="index.php" method="post">
			<input type="submit" name="avg" value="Average Grade for each Course">
		</form>

      <?php
      // average grade table
      $avgGrade = NULL;
      if (isset($_POST['avg'])) {
          $avgGrade = $_POST['avg'];
          if ($avgGrade) {
              $sqlAvg = "SELECT grades.crn, AVG(grades.grade) AS averageGrade FROM grades
                        GROUP BY grades.crn";
              $avgGrade = $conn->query($sqlAvg);
          }
          if ($avgGrade->num_rows > 0) {
              echo "<table>
                            <tr>
                            <th>CRN</th>
                            <th>GRADES</th>";
              echo "</tr>";
              $numRecords = $avgGrade->num_rows;
              for ($i=0; $i < $numRecords; $i++) {
                  $record = $avgGrade->fetch_assoc();
                  echo '<tr>';
                  echo '<th class="CRN">'.$record['crn'].'</th>';
                  echo '<th class="grade">'.$record['averageGrade'].'</th>';
                  echo "</tr>";
              }
              echo "</table>";
          }
          else {
              echo "No Data";
          }
      }
      ?>

		<form class="buttons" action="index.php" method="post">
			<input type="submit" name="numStudents" value="Number of Students in each course">
		</form>

      <?php
      // number of students in each course
      $numStudents = NULL;
      if (isset($_POST['numStudents'])) {
          $numStudents = $_POST['numStudents'];
          if ($numStudents) {
              $sqlNumStudents = "SELECT grades.crn, COUNT(grades.grade) AS num FROM `grades` 
                        GROUP BY grades.crn";
              $numStudents = $conn->query($sqlNumStudents);
          }
          if ($numStudents->num_rows > 0) {
              echo "<table>
                            <tr>
                            <th>CRN</th>
                            <th>Num of Students</th>";
              echo "</tr>";
              $numRecords = $numStudents->num_rows;
              for ($i=0; $i < $numRecords; $i++) {
                  $record = $numStudents->fetch_assoc();
                  echo '<tr>';
                  echo '<th class="CRN">'.$record['crn'].'</th>';
                  echo '<th class="num">'.$record['num'].'</th>';
                  echo "</tr>";
              }
              echo "</table>";
          }
          else {
              echo "No Data";
          }
      }
      ?>
		<!-- Insert courses -->
		<form class="addCourses" action="index.php" method="post">
			<h4>Add Course:</h4>
			<div class="input_block">
				<span class="input_type">CRN: <br /></span><input type="int" name="crn" value="">
				<span class="input_type"><br />Prefix: <br /></span><input type="text" name="prefix" value="">
				<span class="input_type"><br />Number: <br /></span><input type="int" name="number" value="">
				<span class="input_type"><br />Title: <br /></span><input type="text" name="title" value=""><br /><br />
          <?php
          $qry = "SELECT section FROM courses";
          $check = $conn->query($qry);
          if($check==TRUE){
              echo '<span class="input_type">Section: <br /></span><input type="int" name="section" value="">';
              echo '<span class="input_type"><br />Year: <br /></span><input type="int" name="year" value=""><br /><br />';
          }
          ?>
				<input type="submit" name="addCourses" value="Add">
			</div>
		</form>
	</div>
</div>
<div class="gradesTable">
	<h4>Current Grades</h4>
	<div class="grades">
      <?php
      if($allGrades!=FALSE){
          echo "<table>
                    <tr>
                    <th>id</th>
                    <th>CRN</th>
                    <th>RIN</th>
                    <th>Grade</th>
                    </tr>";
          $result = $conn->query($sqlGrades);
          $numRecords = $result->num_rows;
          for ($i=0; $i < $numRecords; $i++) {
              $record = $result->fetch_assoc();
              echo '<tr>';
              echo '<th class="id">'.$record['id'].'</th>';
              echo '<th class="CRN">'.$record['crn'].'</th>';
              echo '<th class="RIN">'.$record['RIN'].'</th>';
              echo '<th class="Grade">'.$record['grade'].'</th>';
              echo "</tr>";
          }
          echo "</table>";
          $result->free();
      }
      ?>

		<!-- Add Grades -->
		<form class="addGrade" action="index.php" method="post">
			<h4>Add Grade:</h4>
			<div class="input_block">
				<p id="signedwords">Note: You could only add the grades for existed students and courses</p>
				<span class="input_type"><br />CRN: <br /></span><input type="int" name="crn" value="">
				<span class="input_type"><br />RIN: <br /></span><input type="int" name="RIN" value="">
				<span class="input_type"><br />Grade: <br /></span><input type="int" name="grade" value=""><br /><br />
				<input type="submit" name="addGrade" value="Add">
			</div>
		</form>

	</div>
</div>
<?php
$conn->close();
?>
</body>
</html>