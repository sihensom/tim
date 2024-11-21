<?php
session_start();
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
$message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : '';
unset($_SESSION['message'], $_SESSION['message_type']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <title>Shopi</title>
</head>

<body>
<!-- Notification container -->
<div id="notification" class="notification" style="display: none;">
    <span id="notification-text"></span>
    <span class="close-notice" onclick="closeNotification()">×</span>
</div>

<!-- Container for Forms -->
<div class="container" id="container">
<div class="form-container sign-up">
    <form action="register.php" method="POST">
        <button type="button" class="close-btn" onclick="window.location.href='puki.php'">×</button>
        <h1>Create Account</h1>
        <div class="social-icons">
                <a href="#" class="icon"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-tiktok"></i></a>
             </div>
        <span>or use your email for registration</span>
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="akses" required>
            <option value="">Select Access</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit">Create</button>
    </form>
</div>

    <div class="form-container sign-in">
        <form action="login.php" method="POST">
            <button type="button" class="close-btn" onclick="window.location.href='puki.php'">×</button>
            <h1>Sign In</h1>
            <div class="social-icons">
                <a href="#" class="icon"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-tiktok"></i></a>
            </div>
            <span>or use your username and password</span>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <a href="#">Forgot Your Password?</a>
            <button type="submit">Login</button>
        </form>
    </div>

    <!-- Toggle Buttons -->
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Welcome Back!</h1>
                <p>Enter your personal details to use all of site features</p>
                <button id="login">Sign In</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Hello, Friend!</h1>
                <p>Register with your personal details to use all of site features</p>
                <button id="register">Sign Up</button>
            </div>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('container');
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('login');

    // Toggle forms
    registerBtn?.addEventListener('click', () => container.classList.add("active"));
    loginBtn?.addEventListener('click', () => container.classList.remove("active"));

    // Function to show notification
    function showNotification(message, type) {
        const notification = document.getElementById('notification');
        const notificationText = document.getElementById('notification-text');
        
        notification.className = 'notification ' + type;
        notificationText.textContent = message;
        notification.style.display = 'block';
        
        setTimeout(closeNotification, 3000);
    }

    // Close notification
    function closeNotification() {
        document.getElementById('notification').style.display = 'none';
    }

    // Show notification if PHP message exists
    <?php if (!empty($message)): ?>
    showNotification(<?php echo json_encode($message); ?>, <?php echo json_encode($message_type); ?>);
    <?php endif; ?>


    // Handle form submission and store username in localStorage
    loginForm.addEventListener('submit'), function(e) {
        e.preventDefault(); // Prevent default form submission

        // Get username and password from the form
        const username = document.getElementById('username').value;
        const password = document.querySelector('input[name="password"]').value;

        // Simulate a successful login (in a real case, you would need to validate this with a server)
        if (username && password) {
            // Store the username in localStorage
            localStorage.setItem('username', username);

            // Redirect to the checkout page or dashboard
            window.location.href = 'checkout.php'; // Or any page you want to redirect after login
        } else {
            showNotification('Invalid username or password', 'error');
        }
    }
});
</script>
</body>
</html>
