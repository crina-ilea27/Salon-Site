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
    <title>Tuns</title>
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
     </style>
</head>
<body>

<header>
    <h1>&Pachete tuns&</h1>
</header>
<div class="container">
 <div class="treatment-container">
    <div class="treatment" onclick="openModal('Stil Elegance', 'Obține un aspect elegant și rafinat cu acest pachet de tuns care include toate produsele esențiale pentru un stil impecabil.')">
        Stil Elegance
    </div>
    <div class="treatment" onclick="openModal('Barbierul Profesionist', 'Experimentează luxul unui tuns de calitate superioară cu acest pachet complet, conceput pentru a îndeplini cerințele chiar și ale celor mai pretențioși clienți.')">
        Barbierul Profi
    </div>
    <div class="treatment" onclick="openModal('Look Urban', 'Descoperă ținuta perfectă pentru viața de zi cu zi cu acest pachet de tuns care te va ajuta să obții un look urban și trendy.')">
        Look Urban
    </div>
    <div class="treatment" onclick="openModal('Bărbații Moderni', 'Pentru bărbații care doresc să fie mereu în pas cu moda, acest pachet de tuns este alegerea ideală, oferind un aspect proaspăt și contemporan.')">
        Bărbații Moderni
    </div>
    <div class="treatment" onclick="openModal('Tuns Clasic', 'Trăiește experiența unui tuns clasic și atemporal cu acest pachet care îți va oferi un aspect sofisticat și bine îngrijit.')">
        Tuns Clasic
    </div>
    <div class="treatment" onclick="openModal('Revigorare și Stil', 'Revitalizează-ți look-ul și obține un stil impecabil cu acest pachet de tuns care îți va oferi energie și încredere în fiecare zi.')">
        Revigorare 
    </div>
    <div class="treatment" onclick="openModal('Tuns Sportiv', 'Pentru cei activi și plini de energie, acest pachet de tuns oferă un look sportiv și dinamic, perfect pentru un stil de viață activ.')">
        Tuns Sportiv
    </div>
    <div class="treatment" onclick="openModal('Tendințe și Răsfăț', 'Fii mereu în trend și răsfață-te cu acest pachet de tuns care îți va aduce cele mai noi tendințe în materie de coafuri și stiluri de tuns.')">
        Tendințe 
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
