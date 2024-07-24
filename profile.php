<?php
 include("connection.php")
?>
<?php
session_start();
$name = $_SESSION["user"];

$user_query = "SELECT varsta, data_nasterii, numar_telefon, poza_profil FROM users WHERE username='$name'";
$result = $conn->query($user_query);

    if ($result->num_rows > 0) {
       $user_data = $result->fetch_assoc();
    } else {
        echo "Nu s-au găsit date pentru utilizatorul curent.";
    } 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
    $varsta = $_POST["varsta"];
    $data_nasterii = $_POST["data_nasterii"];
    $telefon = $_POST["telefon"];
    $poza_profil = $_FILES["poza_profil"]; 
    $parola_noua = $_POST["parola_noua"];

    if ($poza_profil["error"] == UPLOAD_ERR_OK) {
        // Obține informații despre fișier
        $nume_fisier = $poza_profil["name"];
        $folder_destinatie = "uploads/";

        // Mută fișierul la destinația dorită
        if (move_uploaded_file($poza_profil["tmp_name"], $folder_destinatie . $nume_fisier)) {
            /*echo "Fișierul a fost încărcat cu succes.";*/
            $cale_poza = $folder_destinatie . $nume_fisier;
        } else {
            echo "Eroare la încărcarea fișierului.";
        }
    }


    $sql = "UPDATE users
            SET varsta='$varsta', data_nasterii='$data_nasterii', 
                numar_telefon='$telefon' ";

    if (!empty($cale_poza)) {
         $sql .= ", poza_profil='$cale_poza'";
    }

    if (!empty($parola_noua)) {
        $sql .= ", password='$parola_noua'";
    }

    $sql .= " WHERE username='$name'";

    if ($conn->query($sql) === TRUE) {
       /* echo "Profilul a fost actualizat cu succes!"; */
    } else {
        echo "Eroare la actualizare profil: " . $conn->error;
    }
    
$conn->close();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilizator</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Playfair+Display:1,300,400,400italic,500,700,700italic,900');
        *{
            font-family: 'Playfair Display', sans-serif;
        }
        body {
            margin: 80px;
            padding: 20px;
            background:url(pics/pexels2.jpg);
            background-attachment: fixed;
            background-size: cover;
           /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);*/
            
        }
        .container {
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            border: 10px dashed rgb(255, 0, 144);
            background: rgba(255, 255, 255, 0.5); 
        }
        h2 {
            text-align: center;
            background: url(pics/back.png);
            color: black;
            font-size: 28px;
        }
        
        form {
            margin-top: 20px;
        }
        input[type="text"], input[type="number"], input[type="password"] {
            width: auto;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #eb2a8a;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            width: auto;
        }
        .Avatar {
            position: absolute;
            top: 27%;
            left: 778px;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background-size: cover;
            overflow: hidden;
}
        .Avatar img {
           width: 90px; 
            height: auto; 
            object-fit: cover;
}
   /* BARA NAV */
.main-menu {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    padding: 15px;
    box-sizing: border-box;
    display: flex;
    align-items: center;
    justify-content: center;
}

.navigation {
  position: relative;
  width: 60px;
  height: 60px;
  border-radius: 60px;
  background: #ffffff;
  transition: 0.5s;
  box-shadow: 0 10px 15px rgba(34, 0, 255, 0.05);
  display: flex;
  align-items: center;
  justify-content: space-evenly;
  transition-delay: 0.5s;
}

.navigation.active {
  width: 730px;
}

.navigation.active li {
  transition-delay: 0.75s;
  transform: scale(1);
}

.navigation.active .toggleMenu {
  background: #000000;
  transition-delay: 0s;
  width: 30px;
  height: 30px;
  transform: translateY(60px);
}

.navigation.active .toggleMenu:before {
  background: rgba(255, 255, 255, 0.5);
  transform: translateY(0px) rotate(45deg) scale(0.6);
  transition-delay: 0s;
}

.navigation.active .toggleMenu:after {
  background: rgba(255, 255, 255, 0.5);
  transform: translateY(0px) rotate(-45deg) scale(0.6);
  transition-delay: 0s;
}

.navigation li {
  list-style: none;
  transition: 0.5s;
  transform: scale(0);
}

.navigation li a {
  text-decoration: none;
  color: #333;
  text-transform: uppercase;
  letter-spacing: 0.12em;
  padding: 5px 15px;
  border-radius: 20px;
  transition: 0.5s;
}

.navigation li a:hover {
  background: #000000;
  color: #fff;
}

.navigation .toggleMenu {
  position: absolute;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  transition: 0.5s;
  cursor: pointer;
  transition-delay: 0.5s;
  display: flex;
  align-items: center;
  justify-content: center;
}

.navigation .toggleMenu:before {
  content: '';
  position: absolute;
  width: 30px;
  height: 3px;
  border-radius: 3px;
  background: #333;
  transform: translateY(-5px);
  transition: 0.5s;
  transition-delay: 0.5s;
}

.navigation .toggleMenu:after {
  content: '';
  position: absolute;
  width: 30px;
  height: 3px;
  border-radius: 3px;
  background: #333;
  transform: translateY(5px);
  transition: 0.5s;
  transition-delay: 0.5s;
}
 
    </style>

</head>
<body>
        <nav class="main-menu">
            <ul class="navigation">
                <span class="toggleMenu"></span>
                <li><a href="pg.php">Acasa</a></li>
                <li><a href="pg.php">Servicii</a></li>
                <li><a href="pg.php">Recenzii</a></li>
                <li><a href="pg.php">Despre Noi</a></li>
                <li><a href="profil.html">Profil</a></li>
                <li> <a href="logout.php">Deconectare</a></li>
            </ul>
        </nav><br>
       <div class="container">
        <h2>Profil Utilizator</h2>
        <div class="Avatar" id="avatar">
                <?php
                if (isset($user_data['poza_profil']) && !empty($user_data['poza_profil'])) {
                    echo '<img src="' . $user_data['poza_profil'] . '" alt="Poza de profil">';
                }
                ?>
            </div>
        <form action="profile.php" method="post" enctype="multipart/form-data">
            <div class="Avatar" id="avatar">
            <?php
                // Afișăm poza de profil în div-ul avatar dacă există o cale către poză
                if (isset($cale_poza) && !empty($cale_poza)) {
                    echo '<img src="' . $cale_poza . '" alt="Poza de profil">';
                }
                ?>
            </div>
            <label>Poza de profil</label>
            <input type="file" name="poza_profil" accept="image/*" placeholder="Încărcați o poză de profil"><br><br>
            <input type="number" name="varsta" placeholder="Vârstă" value="<?php echo $user_data['varsta']; ?>" required>
            <input type="date" name="data_nasterii" placeholder="Data nașterii" value="<?php echo $user_data['data_nasterii']; ?>" required><br><br>
            <input type="tel" name="telefon" placeholder="Număr de telefon" value="<?php echo $user_data['numar_telefon']; ?>" required><br><br>
            <input type="password" name="parola_noua" placeholder="Parolă nouă"><br>
            <input type="submit" value="Salvează">
        </form>
    </div>
    <script>
        document.querySelector('.toggleMenu').addEventListener('click', () => {
        document.querySelector('.navigation').classList.toggle('active')
})
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var avatarPreview = document.getElementById('avatar');
            avatarPreview.innerHTML = '<img src="' + e.target.result + '" alt="Avatar">';
        };

        reader.readAsDataURL(input.files[0]);
    }
}

    </script> 
</body>
</html>

