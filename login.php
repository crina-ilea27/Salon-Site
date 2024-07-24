<?php
 include("connection.php")
?>

<!DOCTYPE html>
 <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="stylelogin.css">
       <title>Enchanté Login</title>
  </head>
 <body>
    <div class="ring">
        <i style="--clr:#e572b9;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#e572b9;"></i>
        <div class="login">
          <h2>Login</h2>
          <form name="form" action="login2.php" onsubmit="return isvalid()" method="POST">
                   <div class="inputBx">
                     <input type="text" placeholder="Username" name="user">
                   </div><br>
                   <div class="inputBx">
                     <input id="passwordInput" type="password" name="pass" placeholder="Password">
                   </div><br>
                   <div class="inputBx">
                      <input id="signin" type="submit" value="Sign in" name= "submit">
                   </div>
                   <div class="links">
                      <a href="uitatparola.php">Forgot Password</a>
                      <a href="signup.php">Sign up</a>
                  </div> 
          </form>
          <button id="showPasswordBtn" onclick="togglePasswordVisibility()">
                          Show Password ☼ 
                       </button>
          <?php
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $name = filter_input(INPUT_POST, "user", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_SPECIAL_CHARS);
            
            $sql = "select password from users where username = '$name' ";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if ($pass === $user["pass"]) {
                    session_start();
                    $_SESSION["user"] = $name;
                    $_SESSION["pass"] = $pass;
                    if ($_SESSION["is_admin"] == 1) {
                        header("Location: admin.php"); 
                        exit;
                    } else {
                        header("Location: pg.php"); 
                        exit;
                    }
                   
                }else{
                    echo "<div class='alert alert-danger'>Parola introdusa gresit.</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Numele de utilizator nu exista.</div>";
            }
        }
?>
     </div>
  </div>
      <script src="jslogin.js"></script>
 </body>
</html>