<?php
// Include database connection
include 'database.php';

// Fetch election details
$sql = "SELECT title, scheduled_date, state, registration_deadline FROM elections";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Upcoming Elections - ApnaVote</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <!-- Navbar -->
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
        <li class="nav-item"><a class="nav-link active" href="#">Elections</a></li>
        <li class="nav-item"><a class="nav-link" href="result.php">Results</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
      </ul>
    </div>
  </nav>

  <!-- Main Content -->
  <main>
    <!-- Election Info Section -->
    <section class="container my-5">
      <h2 class="text-center mb-4 fw-bold">Upcoming Elections</h2>
      <div class="row g-4">
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-6 col-lg-4">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                  <p class="card-text">
                    Scheduled: <?= htmlspecialchars(date('d M Y', strtotime($row['scheduled_date']))) ?><br>
                    State: <?= htmlspecialchars($row['state']) ?><br>
                    Voter Registration Deadline: <?= htmlspecialchars(date('d M Y', strtotime($row['registration_deadline']))) ?>
                  </p>
                  <a href="vote.php" class="btn btn-primary">View Details</a>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="text-center">No upcoming elections found.</p>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-secondary text-white text-center py-3">
    <p>© 2025 ApnaVote | Empowering Digital Democracy</p>
  </footer>

  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>