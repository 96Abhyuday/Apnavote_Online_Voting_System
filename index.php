<?php
session_start();
include 'database.php'; // Ensure this sets up $conn

$voted = false;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM votes WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $voted = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ApnaVote - Online Voting System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <script>
    function showLogin() {
        window.location.href = "login.php";
    }

    function showRegister() {
        window.location.href = "register.php";
    }

    function showProfile() {
        window.location.href = "profile.php";
    }

    function logout() {
        window.location.href = "logout.php";
    }

    function voteSuccess() {
        alert("✅ You have already voted successfully!");
    }
    </script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary px-4 py-3">
        <a class="navbar-brand" href="#">
            <img src="images/ApnaVote.jpeg" alt="ApnaVote Logo" height="50" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="election.php">Elections</a></li>
                <li class="nav-item"><a class="nav-link" href="result.php">Results</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>

            <div class="lor">
                <?php if (isset($_SESSION['user_id'])): ?>
                <button class="btn btn-light ms-3" onclick="showProfile()">Profile</button>
                <button class="btn btn-outline-light ms-2" onclick="logout()">Logout</button>
                <?php else: ?>
                <button class="btn btn-light ms-3" onclick="showLogin()">Login</button>
                <button class="btn btn-outline-light ms-2" onclick="showRegister()">Register</button>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <!-- Hero Section -->
    <section class="text-center py-5 bg-light">
        <h2 class="fw-bold">Your Vote, Your Voice!</h2>
        <p class="lead">Participate in the digital democracy with ApnaVote.</p>

        <?php if (isset($_SESSION['user_id'])): ?>
        <?php if ($voted): ?>
        <p class="text-success fw-bold mt-3">✅ You have already voted successfully!</p>
        <button class="btn btn-success me-2" onclick="voteSuccess()">Voted</button>
        <?php else: ?>
        <button class="btn btn-warning me-2" onclick="window.location.href='vote.php'">Vote Now</button>
        <?php endif; ?>
        <?php else: ?>
        <button class="btn btn-primary me-2" onclick="showLogin()">Login to Vote</button>
        <button class="btn btn-outline-primary" onclick="showRegister()">Register</button>
        <?php endif; ?>
    </section>


    <!-- Features -->
    <section class="container my-5">
        <div class="row text-center">
            <div class="col-md-4">
                <img src="images/security-icon.png" alt="Security" class="mb-3" width="80">
                <h4>Secure Voting</h4>
                <p>We use blockchain technology to ensure a transparent and secure election process.</p>
            </div>
            <div class="col-md-4">
                <img src="images/convenience-icon.webp" alt="Convenience" class="mb-3" width="80">
                <h4>Easy & Convenient</h4>
                <p>Vote from anywhere with our user-friendly online voting system.</p>
            </div>
            <div class="col-md-4">
                <img src="images/result-icon.png" alt="Instant Results" class="mb-3" width="80">
                <h4>Instant Results</h4>
                <p>Get real-time election results as soon as voting ends.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="bg-light py-5 text-center">
        <h3 class="mb-4">What Our Users Say</h3>
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="margin-top:5px;">
                    <div class="card p-4">
                        <marquee>
                            <p>"ApnaVote made voting so easy and secure. Highly recommend!"</p>
                            <h5>- Ramesh Kumar</h5>
                        </marquee>
                    </div>
                </div>
                <div class="col-md-6" style="margin-top:5px;">
                    <div class="card p-4">
                        <marquee>
                            <p>"No long queues, no hassle. Just login and vote! Amazing experience."</p>
                            <h5>- Priya Sharma</h5>
                        </marquee>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-secondary text-white text-center py-3">
        <p>© 2025 ApnaVote | All Rights Reserved</p>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>