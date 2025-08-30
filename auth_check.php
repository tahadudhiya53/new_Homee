<?php
// auth_check.php
// session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('Please login first to access this page!');
        window.location.href = '/new_homee/login';
    </script>";
    exit();
}
?>
