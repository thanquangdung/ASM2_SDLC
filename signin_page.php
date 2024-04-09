<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Login Form</title>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-300">
  <div class="p-8 max-w-md w-full bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Login</h2>
    <form action="signin_page.php" method='post'>
      <div class="mb-4">
        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
        <input id="email" name="email" type="email" placeholder="Enter your email" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500">
      </div>
      <div class="mb-6">
        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
        <input name="password" id="password" type="password" placeholder="Enter your password" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500">
      </div>
      <button type="submit" name="button_login" class="w-full bg-red-500 mt-5 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-indigo-600">Sign In</button>
      <button type="submit" name="button_regist" class="mt-5 w-full bg-indigo-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-indigo-600">Sign Up</button>
    </form>
  </div>

  <?php
    // Database connection parameters
    $_servername = "localhost";
    $_username = "root";
    $_password = "";
    $_dbname = "btec-student table"; // Changed table name to remove spaces

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['button_login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Create a connection
        $conn = new mysqli($_servername, $_username, $_password, $_dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute query
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
          $row = $result->fetch_assoc();
          $storedHash = $row['password'];

          // Verify the password
          if (password_verify($password, $storedHash)) {
            // Password is correct, login successful
            header("Location: home_page.php");
            exit();
          } else {
            // Password is incorrect, display an error message
            $error = "Invalid email or password";
          }
        } else {
          // Email not found, display an error message
          $error = "Invalid email or password";
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
      } elseif (isset($_POST['button_regist'])) {
        // Button 2 is clicked, redirect to page2.php
        header("Location: signup_page.php");
        exit();
      }
    }
  ?>
</body>
</html>
