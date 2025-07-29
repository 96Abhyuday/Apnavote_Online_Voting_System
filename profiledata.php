<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user_id'])) {
    echo "User not logged in.";
    exit();
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $voter_id = $_POST['voter_id'];
    $user_id = $_SESSION['user_id'];

    $profileImagePath = '';
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['size'] > 0) {
        $file = $_FILES['profile_image'];
        $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileType, $allowed)) {
            $newName = uniqid('profile_', true) . "." . $fileType;
            $uploadDir = 'images/' . $newName;
            if (move_uploaded_file($file['tmp_name'], $uploadDir)) {
                $profileImagePath = $uploadDir;
            }
        }
    }

    $sql = "UPDATE user SET Name=?, Mail=?, UserId=?, profile_image=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $voter_id, $profileImagePath, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Profile Updated Successfully'); window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Update Failed');</script>";
    }
}
?>