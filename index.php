<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pico-main/css/pico.min.css">
    <title>Home - IT College Room Booking System</title>
    <style>
        body {
               display: flex;
              flex-direction: column;
              justify-content: center;
              align-items: center;
              height: auto;
              --pico-font-family: Pacifico, cursive;
          }

          :root {
          --pico-border-radius: 2rem;
          --pico-typography-spacing-vertical: 1.5rem;
          --pico-form-element-spacing-vertical: 1rem;
          --pico-form-element-spacing-horizontal: 1.25rem;
          }

          h1 {

          --pico-font-weight: 400;
          --pico-typography-spacing-vertical: 0.5rem;
          text-align: center;
          }
          
        nav {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        nav a {
            padding: 12px 12px;
            border-radius: 8px;
            color: white;
        }
        .secondary {
            background-color: #3498db;
        }
        .contrast {
            background-color: #0E2358;
        }
        nav a:hover {
            transform: scale(1.05);
        }
        main {
            text-align: center;
            margin: 0 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px white ;
        }
        .features {
            display: flex;
            justify-content: space-around;
            margin: 20px;
            flex-wrap: wrap;
          
        }
        .feature {
            background-color: #D0D2FA;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            text-align: center;
        }
        .feature h3 {
            margin: 0;
            color: black;
        }
        .feature p
        {
          color: black;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Welcome to the IT College Room Booking System</h1>
    <p>Your gateway to reserving rooms efficiently!</p>
    <nav>
        <a href="register.php" class="secondary">Register</a>
        <a href="login.php" class="contrast">Login</a>
        <a href="admin_panel.php" class="contrast">Login as Admin</a>
    </nav>
    <main>
        <p>Your one-stop solution for managing room bookings at IT College.<br>
         Easily register, log in, and manage your bookings with our user-friendly interface.</p>
      </main>
         <h2>Features</h2>
        <section class="features">
        
            
            <div class="feature">
        <h3>Easy Booking</h3>
        <p>Quickly reserve rooms with a few clicks.</p>
    </div>
    <div class="feature">
        <h3>Real-Time Availability</h3>
        <p>Check room availability instantly.</p>
    </div>
    <div class="feature">
        <h3>User-Friendly Interface</h3>
        <p>Designed for an intuitive user experience.</p>
    </div>
    
        </section>
    </main>
    <footer>
    <p>Contact us: booking@itcollege.uob.edu,bh</p>
        <p>&copy; 2024 IT College Room Booking System</p>
    </footer>
</body>
</html>