<?php
// session_start();
// require_once '../includes/db.php';

$message = "";
$showForm = false;

if (isset($_GET['token'])) {
    $rawToken = $_GET['token'];
    $hashedToken = hash('sha256', $rawToken);

    // Check token validity
    $stmt = $conn->prepare("SELECT pr.id, pr.user_id, pr.expires_at, u.email FROM password_resets pr 
                            JOIN users_new u ON pr.user_id = u.id
                            WHERE pr.token = ? LIMIT 1");
    $stmt->bind_param("s", $hashedToken);
    $stmt->execute();
    $stmt->bind_result($prId, $userId, $expiresAt, $email);

    if ($stmt->fetch()) {
        if (strtotime($expiresAt) > time()) {
            $showForm = true; // token valid
        } else {
            $message = "Token expired!";
        }
    } else {
        $message = "Invalid token!";
    }
    $stmt->close();
}

// Handle reset form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['user_id'];
    $prId = $_POST['pr_id'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password !== $cpassword) {
        $message = "Passwords do not match!";
        $showForm = true;
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Update password
        $stmt = $conn->prepare("UPDATE users_new SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashedPassword, $userId);
        $stmt->execute();
        $stmt->close();

        // Delete used reset token
        $stmt = $conn->prepare("DELETE FROM password_resets WHERE id = ?");
        $stmt->bind_param("i", $prId);
        $stmt->execute();
        $stmt->close();

        $_SESSION['success'] = "Password reset successful! Please login.";
        header("Location: /new_homee/login");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="bg-gray-50 flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6">Reset Password</h2>

            <?php if (!empty($message)) : ?>
                <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <?php if ($showForm): ?>
                <form method="POST" class="space-y-4">
                    <input type="hidden" name="user_id" value="<?= $userId ?>">
                    <input type="hidden" name="pr_id" value="<?= $prId ?>">

                    <div>
                        <label class="block mb-1 font-semibold">New Password</label>
                        <input type="password" name="password" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold">Confirm Password</label>
                        <input type="password" name="cpassword" class="w-full border rounded p-2" required>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                        Reset Password
                    </button>
                </form>
            <?php endif; ?>

            <p class="text-sm text-gray-600 mt-4"><a href="/new_homee/login" class="text-blue-600">Back to Login</a></p>
        </div>
    </section>
</body>

</html>