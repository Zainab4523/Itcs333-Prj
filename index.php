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
            height: 100vh; 
          }
        :root {
          --pico-border-radius: 2rem;
          --pico-typography-spacing-vertical: 1.5rem;
          --pico-form-element-spacing-vertical: 1rem;
          --pico-form-element-spacing-horizontal: 1.25rem;
        }
        h1 {
          --pico-font-family: Pacifico, cursive;
          --pico-font-weight: 400;
          --pico-typography-spacing-vertical: 0.5rem;
        }

</style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the IT College Room Booking System</h1>
        <p>Your one-stop solution for managing room bookings at IT College.<br>
         Easily register, log in, and manage your bookings with our user-friendly interface.</p>
        
        <button class="secondary"><a href="register.php" class="btn">Register</a></button>
        <button class="contrast"><a href="login.php" class="btn">Login</a></button>
        
        <section class="features">
            <h2>Features</h2>
            <ul>
                <li>Easy Room Browsing</li>
                <li>Instant Booking Confirmation</li>
                <li>User Profile Management</li>
                <li>Admin Dashboard for Room Management</li>
                <li>Feedback and Comment System</li>
            </ul>
        </section>
    </div>
</body>
</html>