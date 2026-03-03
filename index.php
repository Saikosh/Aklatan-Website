<?php
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DLSU-D Virtual Aklatan</title>
    
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

  <div class="page-wrapper">
    <header class="navbar">
      <div class="logo-section">
        <img src="newlogo.png" alt="DLSU-D Logo" class="logo">
      </div>
      <nav class="nav-links">
        <a href="#" class="nav-button">About</a>
        <a href="#" class="nav-button" onclick="toggleUserLogin()">User Login</a>
        <a href="#" class="nav-button" onclick="toggleAdminLogin()">Admin Login</a>
      </nav>
    </header>

    <section class="hero-container">
      <img src="logo.png" alt="DLSU-D Logo" class="logo">
      <div class="hero-content">
        <h2 class="welcome-text">Welcome to</h2>
        <h1 class="main-title">The Virtual Aklatang Emilio Aguinaldo</h1>
      </div>
    </section>

    <section class="slider-container">
      <button class="arrow prev">&#10094;</button>
      <div class="slider-item memo-card">Memos or Announcments</div>
      <div class="slider-item image-card"><img src="lib1.jpg" alt="Library"></div>
      <div class="slider-item image-card"><img src="lib2.jpg" alt="Study area"></div>
      <button class="arrow next">&#10095;</button>
    </section>
  </div>

  <div class="login-panel" id="loginDrawer">
    
    <button class="close-btn" onclick="toggleUserLogin()">&#10095;</button>

    <div class="login-content">
      <div class="user-icon">
        <img src="user-group-icon.png" alt="User Icon" width="50">
      </div>
      
      <h2 class="login-title">User Login</h2>
      <p>Please log in to your account</p>

      <form class="auth-form">
        <label>Username</label>
        <input type="text" class="input-field">

        <label>Password</label>
        <input type="password" class="input-field">

        <button type="submit" class="signup-btn">Sign In</button>
      </form>

      <a href="#" class="forgot-link">Forgot your password?</a>
      <p></p>
      <a href="#" class="forgot-link">Create Account</a>
    </div>
  </div>

  <div class="login-panel admin-theme" id="adminDrawer">
  
    <button class="close-btn" onclick="toggleAdminLogin()">&#10095;</button>

    <div class="login-content">
      <div class="user-icon">
        <img src="admin-settings-icon.png" alt="Admin Icon" width="50">
      </div>
      
      <h2 class="login-title">Admin Login</h2>
      <p>Please log in to your account</p>

      <form class="auth-form">
        <label>Username</label>
        <input type="text" class="input-field">

        <label>Password</label>
        <input type="password" class="input-field">

        <button type="submit" class="signup-btn">Sign Up</button>
      </form>

      <a href="#" class="forgot-link">Forgot your password?</a>
    </div>
  </div>

  <script>
    // Function for the User Panel
    function toggleUserLogin() {
      const loginDrawer = document.getElementById('loginDrawer');
      const adminDrawer = document.getElementById('adminDrawer');

      // Show/Hide User Panel
      loginDrawer.classList.toggle('active');

      // Automatically close Admin Panel if it's open
      adminDrawer.classList.remove('active');
    }

    // Function for the Admin Panel
    function toggleAdminLogin() {
      const adminDrawer = document.getElementById('adminDrawer');
      const loginDrawer = document.getElementById('loginDrawer');

      // Show/Hide Admin Panel
      adminDrawer.classList.toggle('active');

      // Automatically close User Panel if it's open
      loginDrawer.classList.remove('active');
    }
  </script>

</body>
</html>