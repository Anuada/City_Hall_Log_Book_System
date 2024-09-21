<?php
session_start();
require_once "../util/DbHelper.php";
$db = new DbHelper();
$title = "City Hall";
$load = false;
ob_start();
include "../shared/navbar_page.php";
$navbar = ob_get_clean();
?>

<?php ob_start() ?>

<?php $styles = ob_get_clean() ?>
<style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-image: url('../assets/image/cebucityhall.jpg');  
      background-size: cover;  
      background-position: center;  
      font-family: sans-serif;  
      
    }
    .background-image {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('../assets/image/cebucityhall.jpg');
      background-size: cover;
      background-position: center;
      filter: blur(3px);   
      z-index: -1;  
    }
   
    .form-container {
      background-color: rgba(255, 255, 255, 0.8); 
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
      width: 400px;
    }

    .form-container form {
      display: flex;
      flex-direction: column;
    }

    .form-container .button {
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 20px;
    }

    .form-container .button:hover {
      background-color: #0056b3;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      margin-bottom: 5px;
      display: block;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    a {
      color: #007bff;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
    
  </style>
<?php ob_start() ?>
<div class="background-image"></div> 

<div class="form-container">
  <form>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <p><a href="forgot_password.php">Forgot Password?</a></p>
    
  </form>
</div>


<?php $content = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>