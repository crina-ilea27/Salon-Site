<?php
 include("connection.php")
?>
<!DOCTYPE html>
 <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="stylelogin.css">
       <title>Enchanté New Password</title>
  </head>
 <body>
    <div class="ring">
        <i style="--clr:#e572b9;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#e572b9;"></i>
        <div class="login">
          <h2>New Pass</h2>
          <form name="form" action="sentparola.php" onsubmit="return isvalid()" method="POST">
            <div class="inputBx">
                <input type="text" placeholder="Email" name="email">
              </div><br>
            <div class="inputBx">
               <input id="signin" type="submit" value="Send email" name= "submit">
            </div>
            <?php
            
            ?>

   </form>
     </div>
  </div>
      <script src="jslogin.js"></script>
 </body>
</html>