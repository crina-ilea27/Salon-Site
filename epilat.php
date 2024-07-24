<?php
session_start();
include("connection.php"); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume_utilizator = $_SESSION['user'];
    $data_programare = $_POST['selectedDate'];
    $ora_programare = $_POST['selectedTime'];
    $tip_programare = $_POST['appointmentType'];
    $categorie = $_POST['pageTitle'];
    $categorie = html_entity_decode($categorie);


    if ($nume_utilizator && $data_programare && $ora_programare && $categorie && $tip_programare) {
        // Creăm și executăm interogarea SQL pentru inserarea programării în baza de date
        $sql = "INSERT INTO programari (nume_utilizator, data_programare,ora_programare, tip_programare, categorie) 
                VALUES ('$nume_utilizator', '$data_programare', '$ora_programare', '$tip_programare', '$categorie')";

        if ($conn->query($sql) === TRUE) {
           // echo "Programarea a fost adăugată cu succes!";
        } else {
            echo "Eroare la adăugarea programării: " . $conn->error;
        }
    } else {
        echo "Nu s-au trimis toate datele necesare pentru programare.";
    }
}

$conn->close(); // Închideți conexiunea la baza de date
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Epilat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>

    <style>
       @import url('https://fonts.googleapis.com/css?family=Playfair+Display:1,300,400,400italic,500,700,700italic,900');
       body {
             font-family: Playfair Display, sans-serif;
             margin: 0;
             padding: 0;
             background:url(pics/pexels2.jpg);
             background-attachment: fixed;
             background-size: cover;
         }
 
         header {
            /*border: 10px dashed rgb(255, 0, 144);*/
            background: rgba(255, 255, 255, 0.5); 
             box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
             font-size: 18px;
             text-align: center;
             padding: 1em;
             border-bottom: 8px solid white;
             
         }
         header h1{
             background: url(pics/back.png);
             -webkit-text-stroke: 1px #000000;
             -webkit-background-clip: text;
             background-position: 0 0;
             animation: back 20s linear infinite;
             color: transparent;
             font-size: 45px;
         }
         @keyframes back{
          100%{
            background-position: 2000px 0;
              }
}
         .container{
             padding-left: 68px;
             padding-bottom: 100px;
         }
         .treatment-container {
             display: grid;
             flex-wrap: wrap;
             grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
             justify-content: space-between;
             padding-top: 20px;
         }
 
         .treatment {
             width: 150px;
             height: 90px; 
             line-height: 90px;
             text-align: center;
             margin: 10px;
             cursor: pointer;
            /* width: 45%;*/
             background: white;
             color: rgb(0, 0, 0);
             margin: 20px 30px;
             font-weight: lighter;
             font-size: larger;
         }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            max-width: 600px;
            margin: auto;
            text-align: center;
        }

        .close-btn {
            color: #333;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
        }
        .modal-content button{
            margin: 0 auto;
            color: #fff;
            background-color: black;
            font-family: Poppins, sans-serif;
            border-radius: 30px;
            cursor: pointer;
        }
        html::-webkit-scrollbar{
           width: .6rem;
        }
        html::-webkit-scrollbar-track{
        background-color:#ffffff ;
        }
        html::-webkit-scrollbar-thumb{
           background-color: #ffc6d9;
        }
        #datepickerContainer {
          display: none;
       }
    </style>
</head>
<body>

<header>
    <h1>&Pachete epilat&</h1>
</header>
<div class="container">
 <div class="treatment-container">
    <div class="treatment" onclick="openModal('Piele Fină', 'Epilare delicată pentru o piele netedă și catifelată.')">
        Piele Fină
    </div>
    <div class="treatment" onclick="openModal('Eleganță Delicată', 'Epilare cu simplitate și rafinament pentru un aspect elegant.')">
        Eleganță Delicată
    </div>
    <div class="treatment" onclick="openModal('Strălucire Instantanee', 'Obține o piele strălucitoare și catifelată cu epilare precisă.')">
        Strălucire Instantanee
    </div>
    <div class="treatment" onclick="openModal('Senzual și Fin', 'Experimentează senzația de catifelare și confort cu epilare delicată.')">
        Senzual și Fin
    </div>
    <div class="treatment" onclick="openModal('Piele Catifelată', 'Epilare blândă pentru o piele mătăsoasă și netedă.')">
        Piele Catifelată
    </div>
    <div class="treatment" onclick="openModal('Esență Elegantă', 'Epilare precisă pentru un look elegant și rafinat.')">
        Esență Elegantă
    </div>
    <div class="treatment" onclick="openModal('Definitiv', 'Bucură-te de o piele strălucitoare și proaspătă cu epilare definitivă.')">
        Definitiv
    </div>
    <div class="treatment" onclick="openModal('Piele Netedă', 'Obține o piele netedă și delicată cu o epilare eficientă și rapidă.')">
        Piele Netedă
    </div>
 </div>
</div>

    <div id="myModal" class="modal">
         <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle"></h2>
            <p id="modalDescription"></p>
       </div>
   </div>
</body>
</html>
