<?php
$mesg = "";
require_once('./database.php');

if(isset($_POST["submit"])){
  $email = $_POST['email'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $phone = $_POST['phone'];
  $gender = $_POST['gender'];
  $dob = $_POST['dob'];
  $pass = $_POST['pass'];


  // check if an account with this email already exists
  $email = '14sarthi@gmail.com';
  $phone = '+918687452468';
  $check_email = mysqli_query($dbc,"SELECT * FROM users WHERE email='" . $email . "' LIMIT 1");
  $check_phone = mysqli_query($dbc,"SELECT * FROM users WHERE phone='" . $phone . "' LIMIT 1");
  $count_email  = mysqli_num_rows($check_email);
  $count_phone  = mysqli_num_rows($check_phone);
  if($count_email || $count_phone) {
    $mesg = "An account with similar email or phone already exists.";
  }
  else {
    $sql = "INSERT INTO users (email, first_name, last_name, phone, gender, dob, pass)
    VALUES ('$email', '$first_name', '$last_name', '$phone', '$gender', '$dob', '$pass')";
    if ($dbc->query($sql) === TRUE) {
      header("Location: signin.php");
    } else {
      echo "Error: " . $sql . "<br>" . $dbc->error;
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="./src/main.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
  <title>Lucknow University Recruitment Portal - Registration</title>
</head>

<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-light border-bottom">
    <a href="./index.php" class="navbar-brand">
      <!-- Desktop Logo-->
      <img class="d-none d-md-block" src="./assets/logo.png" alt="Logo" width="300" />

      <!-- Mobile Logo -->
      <img class="d-sm-block d-md-none" src="./assets/LU_Logo.png" alt="Lucknow University Logo" width="100" />
    </a>

    <div class="inline-flex">
      <a href="./register.php" class="btn btn-primary">Register</a>
      <a href="./signin.php" class="btn btn-info">Sign In</a>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="content pb-3">
      <!-- Heading -->
      <h4 class="text-center mt-3">Registration</h4>

      <div class="d-flex justify-content-center">
        <form method="post" action="register.php" class="card registration-form mt-3 p-3">
          <div class="form-group">
            <p><?php echo $mesg ?></p>
            <label>Email Address *</label>
            <input name="email" type="email" class="form-control" placeholder="Enter email" required />
            <small class="form-text text-muted">
              Please note all the communication related to your application
              will be sent to this email id.
            </small>
          </div>

          <div class="form-group">
            <label>Confirm Email Address *</label>
            <input type="email" class="form-control" placeholder="Confirm email" required />
          </div>

          <div class="form-group">
            <label>Password</label>
            <input name="pass" type="password" class="form-control" placeholder="Password" required />
          </div>

          <div class="form-group">
            <label>Confirm Password *</label>
            <input type="password" class="form-control" placeholder="Password" required />
          </div>

          <div class="form-group">
            <label>Candidate Name</label>
            <div class="form-row">
              <div class="col">
                <input name="first_name" type="text" class="form-control" placeholder="First name" required />
              </div>
              <div class="col">
                <input name="last_name" type="text" class="form-control" placeholder="Last name" required />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Date Of Birth *</label>
            <input name="dob" class="form-control" type="date" required />
          </div>

          <div class="form-group">
            <label>Gender *</label>
            <select name="gender" class="form-control" required>
              <option>Select Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>

          <div class="form-group">
            <label>Mobile No. *</label>
            <input name="phone" class="form-control" type="text" placeholder="Mobile No." required />
          </div>

          <div class="form-group">
            <label>Confirm Mobile No. *</label>
            <input class="form-control" type="text" placeholder="Mobile No." required />
          </div>

          <button type="submit" class="btn btn-primary" name='submit'>Register</button>

          <div class="text-center mt-3">
            Already Registered? <a href="./signin.php">Back to Login</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <footer class="text-center pt-4 pb-4">
    © 2020 Lucknow University
  </footer>
</body>

</html>