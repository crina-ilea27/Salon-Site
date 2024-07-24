<?php
include('connection.php');
session_start();

if (isset($_POST['submit'])) {
    $name = $_POST['user'];
    $pass = $_POST['pass'];

    // Evită injecția SQL utilizând instrucțiuni pregătite
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";  
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $name, $pass);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        // Verifică corectitudinea parolei
        if ($pass === $user["password"]) {
            $_SESSION["user"] = $name;
            $_SESSION["pass"] = $pass;
            // Setează sesiunea pentru admin dacă este cazul
            $_SESSION["is_admin"] = ($user["is_admin"] == 1) ? true : false;
            if ($_SESSION["is_admin"]) {
                header("Location: admin.php");
            } else {
                header("Location: pg.php");
            }
            exit;
        } else {
            echo "<div class='alert alert-danger'>Parola introdusă greșit.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Numele de utilizator nu există.</div>";
    }

    if($count == 1) {  
        // Autentificare cu succes, setează sesiunea
        $_SESSION['user'] = $name;
      
        // Adaugă recenzia în baza de date
        if (isset($_POST['reviewtext'])) {
            $comentariu = $_POST['reviewtext'];
            
            $sql_review = "INSERT INTO reviews (nume, review) VALUES ('$username', '$comentariu')";
            if(mysqli_query($conn, $sql_review)) {
                echo "Recenzia a fost adăugată cu succes!";
            } else {
                echo "Eroare la adăugarea recenziei: " . mysqli_error($conn);
            }
        }

        // Redirectează către pg.php
       // header("Location: pg.php");
        exit;
    } else {  
        echo '<script>
                  window.location.href = "login.php";
                  alert("Autentificare eșuată. Nume de utilizator sau parolă invalidă!")
              </script>';
    }     
}
?>
