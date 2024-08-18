<?php
require ('./php/config.php');
if(!empty($_SESSION["id"])){
  header("Location: login.html");
}
if(isset($_POST["submit"])){
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirm = $_POST["confirm"];
  $duplicate = mysqli_query($conn, "SELECT * FROM logo WHERE username = '$username' OR email = '$email'");
  if(mysqli_num_rows($duplicate) > 0){
    echo "<script> alert('Username or Email Has Already Taken'); </script>";
    echo "<script>window.location = 'sigin.html'</script>";

  }
  else{
    if($password == $confirm){
      $query = "INSERT INTO logo VALUES('','$username','$email','$password')";
      mysqli_query($conn, $query);
      echo "<script> alert('Registration Successful'); </script>";
      echo "<script>window.location = 'login.html'</script>";
    }
    else{
      echo "<script> alert('Password Does Not Match'); </script>";
      echo "<script>window.location = 'signin.html'</script>";
    }
  }
}
?>