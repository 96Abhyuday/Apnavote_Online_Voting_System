<?php
session_start();
include 'database.php';

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['mail']);
    $voter_id = trim($_POST['Id']);
    $password = trim($_POST['pass']);

    // Check if email or voter ID already exists
    $check_sql = "SELECT * FROM user WHERE Mail = ? OR UserId = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $email, $voter_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('❌ Email or Voter ID already registered!'); window.location.href='register.php';</script>";
        exit();
    }

    // Prepare statement to insert
    $sql = "INSERT INTO `user` (Name, Mail, UserId, Password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssis", $name, $email, $voter_id, $password);
        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;

            $_SESSION['user_id'] = $user_id;
            $_SESSION['name'] = $name;
            $_SESSION['mail'] = $email;
            $_SESSION['user_voterid'] = $voter_id;

            echo "<script>alert('✅ Registration Successful!'); window.location.href='profile.php';</script>";
        } else {
            $error = $stmt->error;
            echo "<script>alert('❌ Registration Failed! $error'); window.location.href='register.php';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('❌ SQL Prepare Failed: " . $conn->error . "'); window.location.href='register.php';</script>";
    }

    $conn->close();
}
?>
