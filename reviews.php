<?php
include("connection.php");
 if (isset($_POST['submit']))
 {
    session_start();
    $name = $_SESSION["user"];
     $comentariu = $_POST['reviewtext'];
     $sql = "INSERT INTO reviews (nume,review)
     VALUES (?,?)";
      $stmt = mysqli_stmt_init($conn);
      $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
      if ($prepareStmt) {
        try{
            mysqli_stmt_bind_param($stmt,"ss",$name, $comentariu);
           mysqli_stmt_execute($stmt);
        }catch(mysqli_sql_exception)
        {
           die(mysqli_error($conn));
           echo "<div class='alert alert-success'>Nu s-a putut incarca.</div>";
        }
        
           
       }else{
           die("Something went wrong");
       }
     
 }header("Location: pg.php");
?>
