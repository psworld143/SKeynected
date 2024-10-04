<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <link rel="stylesheet" href="style.css">
</head>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: Arial, sans-serif;
  }

  .container {
    display: flex;
    height: 100vh;
  }

  .left {
    flex: 1;
    background-color: #0086FF;
    color: white;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .logo {
    font-size: 24px;
    font-weight: bold;
  }

  .left h1 {
    font-size: 36px;
  }

  .left h1 span {
    font-weight: bold;
  }

  .left p {
    margin-top: 20px;
    font-size: 16px;
    line-height: 1.6;
  }

  .login-as {
    margin-top: 50px;
  }

  .login-as h3 {
    font-size: 18px;
    margin-bottom: 20px;
  }

  .profile {
    display: flex;
    gap: 20px;
  }

  .user-card {
    background-color: #ffffff;
    color: black;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    width: 150px;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
  }

  .user-card img {
    width: 50px;
    border-radius: 50%;
    margin-bottom: 10px;
  }

  .user-card p {
    font-size: 16px;
    font-weight: bold;
  }

  .user-card span {
    font-size: 14px;
    color: grey;
  }

  .right {
    flex: 1;
    background-color: white;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    box-shadow: -5px 0px 10px rgba(0, 0, 0, 0.1);
  }

  .right h2 {
    font-size: 20px;
    margin-bottom: 5px;
  }

  .right h2 span {
    color: #0086FF;
  }

  .right h1 {
    font-size: 36px;
    margin-bottom: 20px;
  }

  .social-login {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
  }

  .social-login button {
    padding: 10px 20px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
  }

  .google {
    background-color: #f1f1f1;
    border: 1px solid #ddd;
  }

  .facebook {
    background-color: #4267B2;
    color: white;
  }

  .apple {
    background-color: #000000;
    color: white;
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
  }

  .forgot {
    text-align: right;
  }

  .forgot a {
    text-decoration: none;
    color: #0086FF;
    font-size: 14px;
  }

  .sign-in-btn {
    background-color: #0086FF;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
  }

  .sign-in-btn:hover {
    background-color: #0073e6;
  }

  .right p {
    margin-top: 20px;
    font-size: 14px;
  }

  .right p a {
    text-decoration: none;
    color: #0086FF;
  }
</style>

<body>
  <div class="container">
    <div class="left">
      <div class="logo">
        <img src="assets/images/SK-logo.png" alt="" >
      </div>
      <!-- <div class="login-as">
        <h3>Login as</h3>
        <div class="profile">
          <div class="user-card">
            <img src="https://via.placeholder.com/50" alt="User Image">
            <p>John Peter</p>
            <span>Active 1 day ago</span>
          </div>
          <div class="user-card">
            <img src="https://via.placeholder.com/50" alt="User Image">
            <p>Alina Shmen</p>
            <span>Active 4 days ago</span>
          </div>
        </div>
      </div> -->
    </div>
    <div class="right">
      <h2>Welcome to <span>SKeynected</span></h2>
      <h1>Sign in</h1>
      <form method="POST" action="auth.php">
        <input type="text" placeholder="Username or email address" name="username" required>
        <input type="password" placeholder="Password" name="password" required>
        <div class="forgot">
          <a href="#">Forgot Password?</a>
        </div>
        <button type="submit" class="sign-in-btn">Sign in</button>
      </form>
      <p>No Account? <a href="#">Sign up</a></p>
    </div>
  </div>
</body>

</html>