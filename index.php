<?php
$conn = mysqli_connect("localhost", "root", "", "school_db");
if (!$conn) {
    die("Database Connection Failed!");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name  = $_POST['student_name'];
    $score = $_POST['student_score'];
  if (!empty($name) && is_numeric($score)) {
      mysqli_query(
            $conn,
            "INSERT INTO student (name, score)
             VALUES ('$name', $score)"
        );
 header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
</head>
<body class="bg-light">
<?php include 'nav.php'; ?>
<div class="container">
<h2 class="mb-4" style="color: #6f5e51;">
    Admin Dashboard
</h2>
<div class="row">
<div class="col-md-4 mb-4">
<div class="card shadow-sm p-4 border-0">
<h4 class="card-title text-success mb-4">
    </h4>
<form method="POST" action="index.php">
  <div class="mb-3">
<label class="form-label fw-bold" style="color: #6F5E51">Student Name:</label>
 <input type="text" name="student_name" class="form-control" required>
    </div>

 <div class="mb-4">
<label class="form-label fw-bold" style="color: #6F5E51">Score:</label>
 <input type="number" name="student_score" class="form-control" required>
  </div>
<button type="submit"
        class="btn w-100 btn-lg"
        style="background-color: #57483D ;border-color: #57483D; color: white;">
    Save To Database
</button>
</form>
</div>
</div>
     <div class="col-md-8">
<div class="card shadow-sm p-4 border-0">
 <h4 class="card-title mb-4" style="color: #C8A97E;">
    Full Student Records
</h4>
   <div class="table-responsive">
<table class="table table-hover table-striped align-middle text-center">
<thead style="background-color: #3D2919; color: white;">
<tr>
<th>ID</th>
<th>Name</th>
<th>Score</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php

$result = mysqli_query(
$conn, "SELECT * FROM student");
while ($row = mysqli_fetch_assoc($result)):
$isPass = $row['score'] >= 50;

?>

<tr>
 <td>
    <?= $row['id'] ?>
    </td>

<td class="fw-bold">
    <?= htmlspecialchars($row['name']) ?>
    </td>

<td>
    <?= $row['score'] ?>
    </td>

 <td>
<span class="badge px-3 py-2"
      style="background-color: <?= $isPass ? '#4F6B55' : '#A65D5D' ?>;">
    <?= $isPass ? 'Pass' : 'Fail' ?>
</span>
</td>

    <td>
 <a href="#" class="btn btn-sm" style="background-color: #6F5E51; border-color: #6F5E51; color: white;">
    Edit
</a>
<a href="#" class="btn btn-sm" style="background-color: #A65D5D; border-color: #A65D5D; color: white;">
    Delete
</a>
    </td>

</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</body>

</html>