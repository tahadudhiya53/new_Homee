<?php
// register.php
// session_start();
include 'includes/db.php';
// require_once "db.php";


$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $phone    = trim($_POST['phone']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Basic validation
    if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($cpassword)) {
        $message = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format!";
    } elseif ($password !== $cpassword) {
        $message = "Passwords do not match!";
    } else {
        // Check if email exists
        $stmt = $conn->prepare("SELECT id FROM users_new WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "Email already registered!";
        } else {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
            // register.php
            $stmt = $conn->prepare("SELECT id FROM users_new WHERE email = ?");
            $stmt = $conn->prepare("INSERT INTO users_new (name, email, phone, password) VALUES (?, ?, ?, ?)");

            $stmt->bind_param("ssss", $name, $email, $phone, $hashedPassword);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Registration successful! Please login.";
                header("Location: login.php");
                exit();
            } else {
                $message = "Something went wrong. Try again!";
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-10">
        <div class="bg-white shadow-lg rounded-lg flex w-4/5 max-w-4xl">
            <!-- Left Side (Quote + Image) -->
            <div class="w-1/2 bg-blue-600 text-white flex flex-col justify-center items-center p-8 rounded-l-lg">
                <h2 class="text-2xl font-bold mb-4">“Your journey starts today!”</h2>
                <p class="text-sm">Sign up and step into your dashboard.</p>
                <img src="https://source.unsplash.com/400x300/?motivation,success" alt="Motivation" class="mt-6 rounded-lg shadow-md">
            </div>

            <!-- Right Side (Form) -->
            <div class="w-1/2 p-8">
                <h2 class="text-2xl font-bold mb-6">Create Account</h2>

                <?php if (!empty($message)) : ?>
                    <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                        <?= htmlspecialchars($message) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" class="space-y-4">
                    <div>
                        <label class="block mb-1 font-semibold">Full Name</label>
                        <input type="text" name="name" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold">Email</label>
                        <input type="email" name="email" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold">Phone Number</label>
                        <input type="text" name="phone" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold">Password</label>
                        <input type="password" name="password" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold">Confirm Password</label>
                        <input type="password" name="cpassword" class="w-full border rounded p-2" required>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                        Register
                    </button>
                </form>

                <p class="text-sm text-gray-600 mt-4">
                    Already have an account? <a href="/new_homee/login" class="text-blue-600">Login</a>
                </p>
                <p class="text-sm text-gray-600 mt-4">
                    <a href="/new_homee/home" class="text-blue-600">Go back to Home</a>
                </p>
            </div>
        </div>
    </section>
</body>

</html>