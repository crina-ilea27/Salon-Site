<?php
 include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Enchanté Luxe Beauty</title>
</head>
<body>

    <!-- Pagina Principală -->
    <div class="main-container">
        <div class="background-image">
            <div class="welcome-message"> 
                <h1>Enchanté Luxe Beauty</h1>
                <a class="bookingButton" id="bookingButton" href="#"  style="--color:#ffffff;">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Programare Online
                </a>
            </div>
        </div>
   
        <!-- Meniu de Navigare -->
        <nav class="main-menu">
            <ul class="navigation">
                <span class="toggleMenu"></span>
                <li><a href="#main-container">Acasa</a></li>
                <li><a href="#servicii">Servicii</a></li>
                <li><a href="#recenzii">Recenzii</a></li>
                <li><a href="#desprenoi">Despre Noi</a></li>
                <li><a href="profile.php">Profil</a></li>
            </ul>
        </nav>
    </div>
    <section id="servicii">
    <!--Servicii-->
    <div class="contentS">
        <a href="epilat.html"><img id="waxing" src="pics/waxing.png" ></a>
        <a href="tratamente.html"><img id="facial" src="pics/facial.png" ></a>
        <a href="tuns.html"><img id="foarfece" src="pics/foarfeca.png" ></a>
        <div class="contentS">
            <div class="service-box">
                <a href="tuns.html"><img id="foarfece2" src="pics/foarfeca.png" ></a>
                <h3>Tunsori cu personalitate</h3>
                <br>
                <p>Noi oferim tunsori spectaculoase pentru gusturile fiecarui client.</p>
            </div>
            <div class="service-box">
                <a href="tuns.html"><img id="foarfece2" src="pics/haircolor.png" ></a>
                <h3>Vopsit</h3>
                <br>
                <p>Ai incredere sa ne lasi sa iti oferim culoarea la care visezi.</p>
            </div>
            <div class="service-box">
                <a href="tuns.html"><img id="foarfece2" src="pics/hairwash22.png" ></a>
                <h3>Spalat pe par</h3><br>
                <p>Noi avem cele mai blânde tehnici si metode de spalat pe cap.</p>
            </div>
            <div class="service-box">
                <a href="tratamente.html"><img id="foarfece2" src="pics/facial.png" ></a>
                <h3>Tratamente de hidratare</h3><br>
                <p>Iti garantam cele mai bune si eficiente metode de hidratare.</p>
            </div>
            <div class="service-box">
                <a href="epilat.html"><img id="foarfece2" src="pics/waxing.png" ></a>
                <h3>Epilare</h3><br>
                <p>Orice fel de epilare iti doresti noi iti oferim cu drag.</p>
            </div>
            <div class="service-box">
                <a href="tratamente.html"><img id="foarfece2" src="pics/blackheads.png" ></a>
                <h3>Extractie cosuri</h3><br>
                <p>Garantam cele mai bune extractii fara piele iritata.</p>
            </div>
        </div>
    </div>

   </section>

      <!--Recenzii-->
      <form id="recenzii" action = "reviews.php" method = "post" class="rev-container" >
         <div class="rev">
            <div class="rev2">
               <h2>Recenzii de la clienți</h2>
                   <!-- Aici vei afișa recenziile din baza de date folosind PHP -->
                  <input type="text" name="reviewtext" placeholder="Lasă-ți recenzia aici"></input>
                  <br>
                  <input type="submit" name="submit" value="Trimite recenzia">
            </div>
            <div class="rev3">
            <?php
               $sql = "SELECT * FROM reviews";
               $stmt = mysqli_stmt_init($conn);
               $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                  if ($prepareStmt) {
                         try{
                             mysqli_stmt_execute($stmt);
                             $res = $stmt->get_result();
                  if($res->num_rows > 0){
                     while ($row = mysqli_fetch_array($res, MYSQLI_NUM)){
                         echo "<label> ($row[0]) a comentat:  $row[1] </label>";
                         echo "<br>";
                         }
                    echo "</div>";
                  }
                           }catch(mysqli_sql_exception)
                            {
                             die(mysqli_error($conn));
                             echo "<div class='alert alert-success'>Nu s-a putut incarca comentariul.</div>";
                            }               
                     }else{
                       die("Something went wrong");
                     }

             ?>
            </div>
         </div>
       </form>
                     <!--Despre noi-->
                         <div id="desprenoi" class="dpcont">
                            <div class="dpcont2">
                                <h1> Despre noi Enchanté Luxe Beauty </h1><br>
                                <p> Bine ați venit la Salonul Enchante Luxe Beauty, o destinație premium pentru îngrijirea și frumusețea dumneavoastră. Fondat în inima orașului nostru, ne mândrim cu o istorie îndelungată și cu servicii de cea mai înaltă calitate. Descoperiți universul nostru de frumusețe și răsfăț, unde fiecare vizită va fi o experiență plină de rafinament și lux. </p>
                                <p>Istoria Noastră</p>
                                <p>Enchante Luxe Beauty a fost fondat în anul 2005 de către esteticienii renumiți Emma și David Thompson. Ideea din spatele salonului a fost să creeze un spațiu elegant și relaxant dedicat frumuseții și stării de bine a clienților noștri. De-a lungul anilor, am devenit un punct de referință în comunitatea noastră, recunoscuți pentru serviciile noastre premium și atenția la detalii.</p>
                                <p>Serviciile Noastre</p>
                                <p>La Enchante Luxe Beauty, oferim o gamă completă de servicii de înfrumusețare pentru a satisface toate nevoile dumneavoastră. De la coafură și machiaj la manichiură și pedichiură, suntem specializați în arta transformării și îmbunătățirii aspectului dumneavoastră. Cu tehnici de ultimă oră și produse de înaltă calitate, fiecare vizită la salonul nostru va fi un moment de relaxare și de reinventare a frumuseții dumneavoastră.</p>
                                <p>Beneficiile Vizitării Noastre</p>
                                <p>Experiență de Lux: Într-o atmosferă sofisticată și elegantă, veți fi tratați ca un client de elită, beneficiind de cele mai bune servicii personalizate.</p>
                                <p>Echipă Talentată: Echipa noastră este formată din esteticieni și stilisti cu experiență vastă și pasiune pentru frumusețe, gata să vă ofere cele mai bune sfaturi și tratamente.</p>
                                <p>Produse Premium: Folosim doar produse de înaltă calitate, recunoscute pentru eficacitatea lor în îngrijirea și înfrumusețarea pielii și părului.</p>
                                <p>Ambianță Relaxantă: Salonul nostru este conceput pentru a vă oferi o pauză de la agitația zilnică. Vă veți simți relaxați și revigorați într-un mediu plin de armonie și bun gust.</p>
                                <p>Oferte Speciale: Avem în permanență promoții și pachete speciale pentru clienții fideli, astfel încât să puteți să vă bucurați de servicii premium la prețuri accesibile.</p>
                                <p>Consultanță Profesională: Oferim consultații personalizate pentru fiecare client, ajutându-vă să descoperiți cele mai bune tratamente și produse pentru nevoile dumneavoastră specifice.</p>
                                <p>Viziunea Noastră</p>
                                <p>La Enchante Luxe Beauty, ne dorim să devenim destinația preferată a tuturor celor care apreciază frumusețea și starea de bine. Ne angajăm să oferim servicii de cea mai înaltă calitate și să ne depășim mereu așteptările clienților noștri. Suntem dedicați să vă ajutăm să vă simțiți încrezători și frumoși în propria piele.</p>
                                <p>Venind la Salonul Enchante Luxe Beauty, veți experimenta arta frumuseții în toată splendoarea sa. Vă invităm să faceți parte din povestea noastră și să vă răsfățați cu servicii de top într-o atmosferă exclusivistă. Programați-vă azi pentru o experiență de neuitat!</p>
                                <p>Pentru orice întrebări sau programări, nu ezitați să ne contactați. Echipa noastră este aici pentru a vă oferi cea mai bună experiență în îngrijirea și frumusețea dumneavoastră. Vă așteptăm cu drag la Enchante Luxe Beauty!</p>
                            </div>
                            <div class="help"></div>
                         </div>
                         
        <!-- Rețele Sociale --> 
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
     <div class="Pwrapper">
          <div class="wrapper">
                 <div class="button">
                    <div class="icon">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <a href="https://www.facebook.com" target="_blank">
                        <span>Facebook</span>
                    </a>
                 </div>
                <div class="button">
                     <div class="icon">
                          <i class="fab fa-twitter"></i>
                     </div>
                     <a href="https://www.twitter.com" target="_blank">
                          <span>Twitter</span>
                    </a>
               </div>
              <div class="button">
                    <div class="icon">
                        <i class="fab fa-instagram"></i>
                   </div>
                        <a href="https://www.instagram.com" target="_blank" >
                        <span>Instagram</span>
                        </a>
               </div>
              <div class="button">
                    <div class="icon">
                       <i class="fab fa-youtube"></i>
                    </div>
                       <a href="https://www.youtube.com" target="_blank">
                       <span>YouTube</span>
                    </a>
              </div>
          </div>
     </div>

    <!-- Fereastra Modală -->
    <div id="optionsModal" class="modal">
        <div class="modal-content options-content">
            <div class="options-buttons">
                <button onclick="navigateToPage('tuns')"> 
                    <img src="pics/haircut.png" alt="Tuns"> 
                    <span>Păr</span>
                </button>
                <button onclick="navigateToPage('epilat')">
                    <img src="pics/wax.png" alt="Epilat">
                    <span>Epilat</span>
                </button>
                <button onclick="navigateToPage('tratamente')">
                    <img src="pics/facialtr.png" alt="Tratamente"> 
                    <span>Tratamente</span>
                </button>
            </div>
        </div>
    </div>
    

    <script src="js.JS"></script>
</body>
</html>
