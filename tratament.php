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
    <title>Tratamente Faciale</title>
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
    <h1>&Tratamente Faciale&</h1>
</header>
<div class="container">
 <div class="treatment-container">
    <div class="treatment" onclick="openModal('Purificare Intensivă', 'Curățare profundă și extracție eficientă a impurităților, pentru un ten clar și radiant')">
        Tratament 1
    </div>
    <div class="treatment" onclick="openModal('Revitalizare Totală', 'Hidratare intensă și îngrijire delicată pentru o piele proaspătă și rejuvenată.')">
        Tratament 2
    </div>
    <div class="treatment" onclick="openModal('Tratament Anti-Acnee', 'Eliminare eficientă a acneei și a punctelor negre, pentru un ten fără imperfecțiuni.')">
        Tratament 3
    </div>
    <div class="treatment" onclick="openModal('Refacere și Restaurare', 'Proceduri regenerative cu laser și peelinguri chimice pentru o piele revitalizată și fermă.')">
        Tratament 4
    </div>
    <div class="treatment" onclick="openModal('Luminozitate și Strălucire', 'Exfoliere blândă și tratamente hidratante pentru o piele luminoasă și sănătoasă.')">
        Tratament 5
    </div>
    <div class="treatment" onclick="openModal('Revigorare Cu Vitamine', 'Tratamente bogate în vitamine și antioxidanți pentru o piele revitalizată și sănătoasă.')">
        Tratament 6
    </div>
    <div class="treatment" onclick="openModal('Reîmprospătare și Tonifiere', 'Tonifiere a pielii și rejuvenare cu ajutorul unor tratamente revitalizante și regeneratoare.')">
        Tratament 7
    </div>
    <div class="treatment" onclick="openModal('Îngrijire Anti-Îmbătrânire', 'Proceduri anti-îmbătrânire și tratamente cu efect de lifting pentru o piele fermă și tânără.')">
        Tratament 8
    </div>
 </div>
</div>

    <div id="myModal" class="modal">
         <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle"></h2>
            <p id="modalDescription"></p>
   </div>
</body>
</html>
