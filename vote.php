<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('⚠️ Please login to vote'); window.location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM candidates";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vote Now - ApnaVote</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary px-4 py-3">
  <a class="navbar-brand" href="index.php">
    <img src="images/ApnaVote.jpeg" alt="ApnaVote Logo" height="50">
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
      <li class="nav-item"><a class="nav-link" href="election.php">Elections</a></li>
      <li class="nav-item"><a class="nav-link" href="result.php">Results</a></li>
      <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
    </ul>
  </div>
</nav>

<section class="vote-section">
  <div class="container">
    <h1 class="text-center fw-bold mb-5 text-light">Cast Your Vote</h1>
    <form action="submit_vote.php" method="POST">
      <div class="row g-4">
        <?php while($row = $result->fetch_assoc()): ?>
        <div class="col-md-4">
          <div class="candidate-card text-center p-3">
            <img src="<?= $row['image_path']; ?>" class="candidate-img mb-3" alt="Candidate">
            <h5 class="fw-bold"><?= $row['name']; ?></h5>
            <p>Party: <?= $row['party']; ?></p>
            <button type="submit" name="candidate_id" value="<?= $row['id']; ?>" class="btn btn-primary w-100">Vote</button>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
    </form>
  </div>
</section>

<footer class="footer bg-secondary text-white py-3 ">
  <p>© 2025 ApnaVote | All Rights Reserved</p>
</footer>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>