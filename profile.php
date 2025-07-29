<?php 
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('⚠ Please login first'); window.location.href='login.php';</script>";
    exit();
} 

// Dummy user data — replace with actual DB query if needed
$user_name = $_SESSION['name'] ?? 'User'; // You can store 'user_name' in session during login

// Default profile image
$profile_image = 'uploads/default_profile.png';

// Check if a profile image exists for the user
if (file_exists("uploads/{$_SESSION['user_id']}.png")) {
    $profile_image = "uploads/{$_SESSION['user_id']}.png";
}

// Handle profile image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_image'])) {
    $upload_dir = 'uploads/';
    $target_file = $upload_dir . $_SESSION['user_id'] . '.png';
    $image_file_type = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));

    // Validate file type
    if (in_array($image_file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file);
        $profile_image = $target_file;
    } else {
        echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile - ApnaVote</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .profile-image-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary px-4 py-3">
    <a class="navbar-brand" href="index.php">
        <img src="images/ApnaVote.jpeg" alt="ApnaVote Logo" height="50">
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
            <li class="nav-item"><a class="nav-link" href="election.php">Elections</a></li>
            <li class="nav-item"><a class="nav-link" href="result.php">Results</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            <li class="nav-item"><a class="nav-link text-warning fw-bold" href="profile.php">Profile</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <div class="card mx-auto shadow p-4" style="max-width: 500px;">
        <h3 class="text-center mb-3">👤 My Profile</h3>
        <!-- Profile Image Section -->
        <div class="profile-image-container">
            <img src="<?= htmlspecialchars($profile_image) ?>" alt="Profile Image" class="profile-image" id="profileImage">
            <form action="profile.php" method="post" enctype="multipart/form-data" id="uploadForm" style="display: none;">
                <input type="file" name="profile_image" id="fileInput" accept="image/*">
            </form>
        </div>
        <!-- Profile Details -->
        <p class="text-center"><strong>Name:</strong> <?= htmlspecialchars($user_name) ?></p>
        <p class="text-center"><strong>Email:</strong> <?= $_SESSION['mail'] ?? 'user@example.com' ?></p>
        <p class="text-center"><strong>User ID:</strong> <?= $_SESSION['user_id'] ?></p>
        <hr>
        <a href="logout.php" class="btn btn-danger w-100">Logout</a>
    </div>
</div>

<script>
    const profileImage = document.getElementById('profileImage');
    const fileInput = document.getElementById('fileInput');

    profileImage.addEventListener('click', () => {
        fileInput.click();
    });

    fileInput.addEventListener('change', () => {
        document.getElementById('uploadForm').submit();
    });
</script>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>