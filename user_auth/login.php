<?php
// index.php → Login Page
// session_start();
require_once "includes/db.php";

$message = "";

// If already logged in → redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location:/new_homee/home");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $message = "Both fields are required!";
    } else {
        // index.php (login)
        $stmt = $conn->prepare("SELECT id, name, email, password FROM users_new WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $name, $email, $hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                // Set session
                $_SESSION['user_id'] = $id;
                $_SESSION['name']    = $name;
                $_SESSION['email']   = $email;

                // update last login
                $update = $conn->prepare("UPDATE users_new SET last_login_at = NOW() WHERE id = ?");
                $update->bind_param("i", $id);
                $update->execute();
                $update->close();

                header("Location:/new_homee/home");
                exit();
            } else {
                $message = "Invalid password!";
            }
        } else {
            $message = "No account found with this email!";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-10">

        <div class="bg-white shadow-lg rounded-lg flex w-4/5 max-w-4xl">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <?= htmlspecialchars($_SESSION['success']) ?>
                </div>
                <?php unset($_SESSION['success']); // remove after showing 
                ?>
            <?php endif; ?>
            <!-- Left Side (Form) -->
            <div class="w-1/2 p-8">
                <h2 class="text-2xl font-bold mb-6">Login</h2>

                <?php if (!empty($message)) : ?>
                    <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                        <?= htmlspecialchars($message) ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($_SESSION['success'])) : ?>
                    <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                        <?= htmlspecialchars($_SESSION['success']) ?>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <form method="POST" class="space-y-4">
                    <div>
                        <label class="block mb-1 font-semibold">Email</label>
                        <input type="email" name="email" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold">Password</label>
                        <input type="password" name="password" class="w-full border rounded p-2" required>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="/new_homee/forgot_pass" class="text-blue-600 text-sm">Forgot Password?</a>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                        Login
                    </button>
                </form>

                <p class="text-sm text-gray-600 mt-4">
                    Don’t have an account? <a href="/new_homee/register" class="text-blue-600">Register</a>
                </p>
                <p class="text-sm text-gray-600 mt-4">
                    <a href="/new_homee/home" class="text-blue-600">Go back to Home</a>
                </p>
            </div>

            <!-- Right Side (Quote + Image) -->
            <div class="w-1/2 bg-blue-600 text-white flex flex-col justify-center items-center p-8 rounded-r-lg">
                <h2 class="text-2xl font-bold mb-4">“Welcome back!”</h2>
                <p class="text-sm">Login and continue your journey.</p>
                <img src="https://source.unsplash.com/400x300/?technology,login" alt="Login" class="mt-6 rounded-lg shadow-md">
            </div>
        </div>
    </section>
</body>

</html>