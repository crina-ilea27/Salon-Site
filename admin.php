<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Admin</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Playfair+Display:1,300,400,400italic,500,700,700italic,900');

        body{
            font-family: Playfair Display, sans-serif;
            background:url(pics/pexels2.jpg);
            background-attachment: fixed;
            background-size: cover;
        }
        .dpcont{
           height: 100%;
           width: 100%;
           margin-top: 50px;

          }

       .dpcont2 {
           margin-left: 50px;
           margin-right: 50px;
           padding: 50px;
           text-align: center;
           border: 10px dashed rgb(255, 0, 144);
           background: rgba(255, 255, 255, 0.5); 
           box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

       .dpcont2 h1{
          background: url(pics/back.png);
          -webkit-text-stroke: 1px #000000;
          -webkit-background-clip: text;
          background-position: 0 0;
          animation: back 20s linear infinite;
          color: transparent;
          font-size: 50px;
       }

      table {
        border-collapse: collapse;
        width: 100%; 
       }

      td, th {
    border: 1px solid black; 
    padding: 8px; 
    text-align: left; 
    }
    a {
    display: inline-block; 
    padding: 10px 20px; 
    border-radius: 20px; 
    text-decoration: none; 
    color: white; 
    background-color: black; 
    transition: background-color 0.3s ease; 
    }

    a:hover {
    background-color: rgb(245, 81, 152);
    }

    .checkbox {
    cursor: pointer; /* Indicator de cursor pentru a arăta utilizatorului că elementul este clicabil */
    margin-left: 5px; /* Spațiu mic între cerculeț și text */
   }

   .completed {
    text-decoration: line-through; /* Linie tăiată pentru a indica că programarea a fost realizată */
   } 

</style>
</head>
<body>
    <div class="dpcont">
       <div class="dpcont2">
         <h1>Bun venit pe pagina de admin!</h1>
         <h2>Programări existente:</h2>
    <table>
        <thead>
            <tr>
            <th>Nume</th>
            <th>Data</th>
            <th>Ora</th>
            <th>Tip Serviciu</th>
            <th>Pachet</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("connection.php"); 
            session_start();
            // Interoghează baza de date pentru a extrage programările
            $sql = "SELECT nume_utilizator, data_programare, ora_programare, tip_programare, categorie, id FROM programari";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nume_utilizator"] . "</td>"; 
                    echo "<td>" . $row["data_programare"] . "</td>";
                    echo "<td>" . $row["ora_programare"] . "</td>";
                    echo "<td>" . $row["tip_programare"] . "</td>";
                    echo "<td>" . $row["categorie"] . "</td>";
                    echo '<td><a href="admin.php?id=' . $row["id"] . '">Șterge</a></td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nu există programări.</td></tr>";
            }
        
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "DELETE FROM programari WHERE id=$id";
                if ($conn->query($sql) === TRUE) {
                    echo '<script>reloadPageAfterDelete();</script>';
                } else {
                    echo "Eroare la ștergerea programării: " . $conn->error;
                }
            } else {
                //echo "ID-ul programării nu a fost furnizat.";
            }
            
            ?>
        </tbody>
    </table>

    <h2>Utilizatori existenți:</h2>
    <table>
        <thead>
            <tr>
            <th>Nume</th>
            <th>Parola</th>
            <th>Email</th>
            <th>Varsta</th>
            <th>Data nasterii</th>
            <th>Poza profil</th>
            <th>Numar de telefon</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT username, password, email, varsta,data_nasterii,poza_profil, numar_telefon,id FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["username"] . "</td>"; 
                    echo "<td>" . $row["password"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["varsta"] . "</td>";
                    echo "<td>" . $row["data_nasterii"] . "</td>";
                    echo "<td>" . $row["poza_profil"] . "</td>";
                    echo "<td>" . $row["numar_telefon"] . "</td>";
                    echo '<td><a href="admin.php?id=' . $row["id"] . '">Șterge</a></td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nu există utilizatori.</td></tr>";
            }
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "DELETE FROM users WHERE id=$id";
                if ($conn->query($sql) === TRUE) {
                    echo '<script>reloadPageAfterDelete();</script>';
                } else {
                    echo "Eroare la ștergerea utilizatorului: " . $conn->error;
                }
                
            } else {
                //echo "ID-ul utilizatorului nu a fost furnizat.";
            }
           
            ?>
        </tbody>
    </table>
    <h2>Recenzii existente:</h2>
    <table>
        <thead>
            <tr>
            <th>Nume</th>
            <th>Recenzie</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT nume,review,id FROM reviews";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nume"] . "</td>"; 
                    echo "<td>" . $row["review"] . "</td>";
                    echo '<td><a href="admin.php?id=' . $row["id"] . '">Șterge</a></td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nu există utilizatori.</td></tr>";
            }
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "DELETE FROM reviews WHERE id=$id";
                if ($conn->query($sql) === TRUE) {
                    echo '<script>reloadPageAfterDelete();</script>';
                } else {
                    echo "Eroare la ștergerea utilizatorului: " . $conn->error;
                }
                
            } else {
                //echo "ID-ul utilizatorului nu a fost furnizat.";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
    <br>
    <a href="login.php">Deconectare</a>
    <a href="pg.php">Catre site</a>
        </div>
    </div>

    <script>
    function reloadPageAfterDelete() {
        window.location.reload(); 
    }
        </script>
</body>
</html>
