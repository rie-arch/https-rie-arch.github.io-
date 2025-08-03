<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login Form</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');
  * {
    box-sizing: border-box;
  }
  body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: 'Montserrat', sans-serif;
    background: radial-gradient(circle at bottom left, #ac324d 0%, #1b1c3a 70%), 
                radial-gradient(circle at top right, #6d82e2 0%, #150026 70%);
    overflow: hidden;
  }
  body {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .login-container {
    width: 350px;
    padding: 2.7rem 2.5rem 3.5rem 2.5rem;
    border-radius: 50px;
    background: rgba(120, 108, 151, 0.4);
    backdrop-filter: saturate(180%) blur(15px);
    box-shadow:
      inset 0 0 100px 20px rgba(255, 255, 255, 0.08),
      inset 0 1px 1px rgba(255, 255, 255, 0.055),
      0 15px 25px rgba(139, 91, 147, 0.35);
    display: flex;
    flex-direction: column;
    align-items: center;
    color: white;
  }

  .user-icon-wrapper {
    width: 105px;
    height: 105px;
    background: rgba(255, 255, 255, 0.07);
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 2rem;
  }
  .user-icon-wrapper svg {
    fill: #9a8bb6;
    width: 65px;
    height: 65px;
  }

  form {
    width: 100%;
  }
  .input-group {
    position: relative;
    margin-bottom: 1.7rem;
  }
  .input-icon {
    position: absolute;
    top: 10px;
    left: 0;
    width: 26px;
    height: 26px;
    fill: #beb9d2;
  }
  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 10px 10px 10px 35px;
    background: transparent;
    border: none;
    border-bottom: 1.25px solid #ddd9f1;
    color: #ddd9f1;
    font-size: 1rem;
    letter-spacing: 0.05em;
    outline-offset: 2px;
    outline-color: rgb(255 255 255 / 0.15);
    transition: border-color 0.3s ease;
  }
  input::placeholder {
    color: #d1cde2cc;
    font-weight: 400;
  }
  input:focus {
    border-color: #9a8bb6;
  }

  .bottom-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2.5rem;
    font-size: 0.85rem;
    color: #cabfd3b8;
    user-select: none;
  }
  .checkbox-group {
    display: flex;
    align-items: center;
    gap: 0.3rem;
  }
  .checkbox-group input[type="checkbox"] {
    width: 16px;
    height: 16px;
    cursor: pointer;
    accent-color: #462374;
  }
  .checkbox-group label {
    user-select: none;
    cursor: pointer;
  }
  .forgot-password {
    font-style: italic;
    cursor: pointer;
    color: #9a8bb6;
    text-decoration: none;
    transition: color 0.3s ease;
  }
  .forgot-password:hover,
  .forgot-password:focus {
    color: #c6b4e1;
    outline: none;
  }

  button.login-btn {
    width: 100%;
    padding: 14px 0;
    border-radius: 20px;
    border: none;
    font-weight: 700;
    font-size: 1.1rem;
    letter-spacing: 0.12em;
    color: white;
    background: linear-gradient(135deg, #581866 0%, #5455ff 100%);
    cursor: pointer;
    transition: background 0.4s ease;
    user-select: none;
  }
  button.login-btn:hover,
  button.login-btn:focus {
    background: linear-gradient(135deg, #7a1eb9 0%, #a19bff 100%);
    outline: none;
  }
  button.login-btn:active {
    background: linear-gradient(135deg, #3f0f48 0%, #2c2dbc 100%);
  }

  @media (max-width: 400px) {
    .login-container {
      width: 90vw;
      padding: 2.2rem 2rem 2.5rem 2rem;
      border-radius: 30px;
    }
  }
</style>
</head>
<body>
<div class="login-container" role="main" aria-label="Login Form Container">
  <div class="user-icon-wrapper" aria-hidden="true" tabindex="-1">
    <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
      <path d="M32 34c7.732 0 14-6.268 14-14S39.732 6 32 6 18 12.268 18 20s6.268 14 14 14zM46 39c0-6-12-6-14-6s-14 0-14 6v5c0 2.15 1.834 5 14 5s14-2.85 14-5v-5z"/>
    </svg>
  </div>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off" aria-label="Login form">
    <div class="input-group">
      <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
      </svg>
      <input type="text" name="username" placeholder="Username" required aria-required="true" aria-label="Username" />
    </div>
    <div class="input-group">
      <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M17 8h-1V6a4 4 0 0 0-8 0v2H7a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2zm-5 6a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" />
      </svg>
      <input type="password" name="password" placeholder="Password" required aria-required="true" aria-label="Password" />
    </div>
    <div class="bottom-row">
      <div class="checkbox-group">
        <input type="checkbox" id="remember" name="remember" />
        <label for="remember">Remember me</label>
      </div>
      <a href="#" class="forgot-password">Forgot Password?</a>
    </div>
    <button type="submit" class="login-btn" aria-label="Login button">LOGIN</button>
  </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']) ? true : false;

    if (empty($username)) {
        echo '<script>alert("Please enter your username.");</script>';
    } elseif (empty($password)) {
        echo '<script>alert("Please enter your password.");</script>';
    } else {
        // Dummy authentication
        if ($username === "user" && $password === "password123") {
            echo '<script>
                alert("Login successful! Remember me: ' . ($remember ? "Yes" : "No") . '");
                window.location.href = "index.php";
            </script>';
        } else {
            echo '<script>alert("Invalid username or password.");</script>';
        }
    }
}

?>
</body>
</html>
