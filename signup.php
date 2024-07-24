<?php
 include("connection.php");
?>
<!DOCTYPE html>
 <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="stylelogin.css">
       <title>Enchanté Sign up</title>
  </head>
 <body>
    <div class="ring">
        <i style="--clr:#e572b9;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#e572b9;"></i>
        <div class="login">
          <h2>Sign Up</h2>
          <form name="form" action="signup.php" onsubmit="return isvalid()" method="POST">
                   <div class="inputBx">
                     <input type="text" placeholder="Username" name="create-username">
                   </div>
                   <div class="inputBx">
                     <input type="text" placeholder="Email" name="email">
                   </div>
                   <div class="inputBx">
                     <input id="passwordInput" type="password" name="create-password" placeholder="Create Password">
                     <input id="passwordInput" type="password" name="confirm-password" placeholder="Confirm Password">
                   </div><br>
                   <div class="inputBx">
                      <input id="signin" type="submit" value="Create account" name= "submit">
                   </div> 
          </form>
<?php
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $name = filter_input(INPUT_POST, "create-username", FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, "create-password", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $conf = filter_input(INPUT_POST, "confirm-password", FILTER_SANITIZE_SPECIAL_CHARS);

           $errors = array();
           if (strlen($pass)<8) {
            array_push($errors,"Parola trebuie sa contina cel putin 8 caractere.");
           }
           if ($pass!==$conf) {
            array_push($errors,"Parolele nu corespund.");
           }
          
           require_once "connection.php";
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO users (username, password, email) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
             try{
                 mysqli_stmt_bind_param($stmt,"sss",$name, $pass, $email);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Te-ai inregistrat cu succes.</div>";
                echo '<button onclick="window.location.href=\'login.php\'" style="cursor: pointer; color: black;">&#8592; Login</button>';
              }catch(mysqli_sql_exception)
             {
                echo "<div class='alert alert-success'>Numele este deja folosit.</div>";
             }
             
                
            }else{
                die("Something went wrong");
            }
           }
        }       
?>
     </div>
  </div>
      <script src="jslogin.js"></script>
 </body>
</html>