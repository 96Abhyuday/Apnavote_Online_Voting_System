<?php
session_start();
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userInput = $_POST['userid'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE (Mail = ? OR UserId = ?) AND Password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $userInput, $userInput, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // ✅ Correct session data using UserId
        $_SESSION['user_id'] = $row['UserId'];         // Unique voter ID
        $_SESSION['name'] = $row['Name'];              // User name
        $_SESSION['mail'] = $row['Mail'];              // Email
        $_SESSION['user_voterid'] = $row['UserId'];    // Redundant but optional

        echo "<script>alert('✅ Login Successful'); window.location.href='vote.php';</script>";
    } else {
        echo "<script>alert('❌ User ID or Password is incorrect'); window.location.href='login.php';</script>";
    }
}
?>
