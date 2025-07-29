<?php
session_start();
include 'database.php';

if (!isset($_POST['candidate_id']) || !isset($_SESSION['user_id'])) {
    echo "<script>alert('Invalid access!'); window.location.href='index.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];
$candidate_id = $_POST['candidate_id'];

// Check if already voted
$checkVote = $conn->prepare("SELECT * FROM votes WHERE user_id = ?");
$checkVote->bind_param("i", $user_id);
$checkVote->execute();
$result = $checkVote->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('You have already voted!'); window.location.href='index.php';</script>";
    exit();
}

// Insert vote
$stmt = $conn->prepare("INSERT INTO votes (user_id, candidate_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id, $candidate_id);

if ($stmt->execute()) {
    // ✅ SET session variable for green button and alert
    $_SESSION['vote_success'] = true;
    header("Location: index.php");
    exit();
} else {
    echo "<script>alert('Error submitting vote!'); window.location.href='vote.php';</script>";
}
?>
