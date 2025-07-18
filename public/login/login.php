<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];

    $correct_password_hash = "123";

    if ($password == $correct_password_hash) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = 'Dev';
        // Fix: Corrected header syntax
        header('Location: /LemonOS/public/home/index.php');
        exit();
    } else {
        $error_message = "Incorrect password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>macOS Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell;
        }

        body {
            height: 100vh;
            background: url('https://images.unsplash.com/photo-1750099255888-91d5386e833c?q=80&w=2370&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') center/cover no-repeat fixed;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(3px);
            z-index: 0;
        }

        .login-container, .time, .date {
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .time {
            font-size: 6rem;
            font-weight: 400;
            margin-bottom: 5px;

        }

        .date {
            font-size: 1.5rem;
            margin-bottom: 40px;
        }

        .login-container {
            text-align: center;
        }

        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 60px;
            background: #c1c1c1;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar img {
            width: 60px;
            opacity: 0.8;
        }

        .username {
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        input[type="password"] {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            color: white;
            font-size: 1rem;
            backdrop-filter: blur(5px);
            width: 200px;
            margin-bottom: 10px;
        }

        input[type="password"]::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .hint {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 10px;
        }

        .error {
            color: #ff3b30;
            font-size: 0.9rem;
            margin-top: 8px;
        }
    </style>
</head>
<body>
<div id="clock" class="time"></div>
<div id="date" class="date"></div>

<div class="login-container">
    <div class="avatar">
        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MTIiIGhlaWdodD0i
NTEyIiB2aWV3Qm94PSIwIDAgNTEyIDUxMiI+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTI1NiAyNTZjNTIuOCAwIDk2LTQzLjIgOTYtOTZ2LTE2YzAtNTIuOC00My4yLTk2LTk2LTk2cy05NiA0My4yLTk2IDk2djE2YzAgNTIuOCA0My4yIDk2IDk2IDk2em0xNDQgMzJoLTg0Yy0xMS4yIDAtMTkuMiAzLjItMjUuNiA2LjRDMzE0LjQgMzA0IDI4OCAzMTIgMjU2IDMxMnMtNTguNC04LTgyLjQtMTcuNmMtNi40LTMuMi0xNC40LTYuNC0yNS42LTYuNEg2NGMtMzUuMiAwLTY0IDI4LjgtNjQgNjR2MzJjMCAxNy42IDE0LjQgMzIgMzIgMzJoNDQ4YzE3LjYgMCAzMi0xNC40IDMyLTMydi0zMmMwLTM1LjItMjguOC02NC02NC02NHoiLz48L3N2Zz4="
             alt="User">
    </div>
    <div class="username">LemonOsWEB</div>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="password" name="password" placeholder="Enter Password" required>
        <?php if (isset($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <div class="hint">Press Return to unlock</div>
    </form>
</div>

<script>
    function updateTime() {
        const now = new Date();
        const timeDiv = document.getElementById('clock');
        const dateDiv = document.getElementById('date');

        timeDiv.textContent = now.toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        });

        dateDiv.textContent = now.toLocaleDateString('en-US', {
            weekday: 'long',
            month: 'long',
            day: 'numeric'
        });
    }

    updateTime();
    setInterval(updateTime, 1000);
</script>
</body>
</html>