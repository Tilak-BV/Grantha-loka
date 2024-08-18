<?php
require ('./php/config.php');
if(!empty($_SESSION["id"])){
  header("Location: signin.html");
}
if(isset($_POST["submit"])){
  $username = $_POST["username"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT * FROM logo WHERE username = '$username' OR email = '$password'");
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result) > 0){
    if($password == $row['password']){
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      echo "<script> alert('Login Successful'); </script>";
      echo "<script>window.location = 'collections.html'</script>";
    }
    else{
      echo "<script> alert('Wrong Password'); </script>";
      echo "<script>window.location = 'login.html'</script>";
    }
  }
  else{
    echo "<script> alert('User Not Registered'); </script>";
    echo "<script>window.location = 'signin.html'</script>";
  }
}
?>