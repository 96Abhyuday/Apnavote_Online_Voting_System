<?php
include 'database.php';

// Get candidates and their vote counts
$sql = "SELECT c.name, c.party, c.image_path, COUNT(v.id) as vote_count
        FROM candidates c
        LEFT JOIN votes v ON c.id = v.candidate_id
        GROUP BY c.id
        ORDER BY vote_count DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Results - ApnaVote</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
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
        <li class="nav-item"><a class="nav-link active" href="#">Results</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
      </ul>
    </div>
</nav>
<main>
<div class="container mt-5">
  <h1 class="text-center fw-bold mb-5 text-light">🗳️ Election Results</h1>
  <div class="row g-4">
    <?php while($row = $result->fetch_assoc()): ?>
        <div class="">
          <div class="candidate-card text-center p-3">
            <img src="<?= $row['image_path']; ?>" class="candidate-img mb-3" alt="Candidate">
            <h5 class="fw-bold"><?= $row['name']; ?></h5>
            <p>Party: <?= $row['party']; ?></p>
            <span class="badge bg-success fs-5">Votes: <?= $row['vote_count']; ?></span>
          </div>
        </div>
    <?php endwhile; ?>
  </div>
</div>
    </main>
<footer class="footer bg-secondary text-white py-3 bottom" style="margin-top:40px;">
  <p>© 2025 ApnaVote | All Rights Reserved</p>
</footer>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
