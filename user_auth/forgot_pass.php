<?php
// session_start();
require_once 'includes/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $message = "Email is required!";
    } else {
        // Check if email exists
        $stmt = $conn->prepare("SELECT id FROM users_new WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($userId);

        if ($stmt->fetch()) {
            $stmt->close();

            // Generate reset token
            $rawToken = bin2hex(random_bytes(32));
            $hashedToken = hash('sha256', $rawToken);
            $expires = date("Y-m-d H:i:s", time() + 3600); // 1 hour

            // Delete old tokens for this user
            $conn->query("DELETE FROM password_resets WHERE user_id = $userId");

            // Store token
            $stmt2 = $conn->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)");
            $stmt2->bind_param("iss", $userId, $hashedToken, $expires);
            $stmt2->execute();
            $stmt2->close();

            // Normally, you'd email the link. For now, show link directly:
            $resetLink = "http://localhost/new_Homee/reset/$rawToken";
            $message = "Password reset link: <a href='$resetLink' class='text-blue-600'>$resetLink</a>";
        } else {
            $message = "No account found with this email!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-10">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6">Forgot Password</h2>

            <?php if (!empty($message)) : ?>
                <div class="bg-yellow-100 text-yellow-700 p-2 rounded mb-4">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-4">
                <div>
                    <label class="block mb-1 font-semibold">Enter your email</label>
                    <input type="email" name="email" class="w-full border rounded p-2" required>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                    Send Reset Link
                </button>
            </form>
            <p class="text-sm text-gray-600 mt-4"><a href="/new_homee/login" class="text-blue-600">Back to Login</a></p>
        </div>
    </section>
</body>

</html>