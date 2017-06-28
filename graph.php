<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Graphiques</title>
    <link rel="stylesheet" href="static/external/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="static/external/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="utils.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a href="homepage.html"><img src="http://www.lozere-tourisme.com/sites/lozere/themes/lozere2/logo.png" alt="logo_lozere" class="img-responsive"/></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Navigation <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="weekly_sites.html"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Sites de le Semaine</a></li>
                                <li><a href="profile.html"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Profil</a></li>
                                <li><a href="register.html"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Inscription</a></li>
                                <li><a href="success.html"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Vos Succès</a></li>
                                <li><a href="boiteImages.html"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Boîtes à Images</a></li>
                                <li><a href="ideas_box.html"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Boîte à Idées</a></li>
                                <li><a href="http://www.lozere-tourisme.com/"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>INTRANET</a></li>
                                <li><a href="graph.html"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Administrateur</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div>
		<?php
		include("./includes/connection.php");

		//détermination des dates limites de réactualisation (mois et année)
		$mois = date("m");
		$outdatedMois = $mois - 1;
		$annee = date("Y");
		$outdatedAnnee = $annee - 1;
		//séparation dans la requête des entreprises actualisées et non actualisées
		$remplies = $bdd->query("SELECT mois, annee, identifiant FROM infos WHERE (mois>'$outdatedMois') AND (annee='$outdatedAnnee')");
		$pasremplies = $bdd->query("SELECT mois, annee, identifiant FROM infos WHERE (mois<='$outdatedMois') AND (annee<='$outdatedAnnee')");
		$allremplies = $remplies->fetchAll();
		$allpasremplies = $pasremplies->fetchAll();
		//compte du nombre total des actualisés et des non actualisés
		$count = 0;
		$count2= 0;
		foreach ($allremplies as $value) {
		    $count++;
		}
		foreach ($allpasremplies as $value) {
		    $count2++;
		}
		//résultat ramené en pourcentage
		$calc = ($count / ($count + $count2))*100;
		$calc2 = ($count2 / (($count + $count2)))*100 ;
		//ouverture du graph
		?>
		<div class="graph">
			<canvas height="400" id="myChart" width="400"></canvas>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js">
			</script>
			<script>
      //transfert du résultat des variables php vers des variables javascript
      var val1 = "<?php echo $calc ?>";
      var val2 = "<?php echo $calc2 ?>";
      var ctx = document.getElementById("myChart").getContext('2d');
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: ["À jour", "Pas à jour"],
              datasets: [{
                  label: '%',
                  //utilisation des variables pour conparer les résultats dans un graphe
                  data: [val1, val2],
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                  ],
                  borderColor: [
                      'rgba(255,99,132,1)',
                      'rgba(75, 192, 192, 1)',
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });
			</script>
		</div>
	</div>
    <h2>Donnees ODT</h2>
    <div class="tableau"></div>
    <ul>
        <?php
       include ("bordereau.php");

    include ("./includes/connection.php");
        $categories = $bdd->query(' SELECT DISTINCT bordereau FROM infos');
        $categories= $categories->fetchAll();

        foreach ($categories as $categorie){
            echo '<li><a href="liens.php?cat=';
            echo $categorie->bordereau;
            echo '">';
            echo $bordereaux[$categorie->bordereau];
            echo '</a></li>';

        }
        ?>
    </ul>
    </main>

    <footer>
        <div class="footer" id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                        <h3>Nos Partenaires</h3>
                        <ul>
                            <li> <a href="#"> Lorem Ipsum </a> </li>
                            <li> <a href="#"> Lorem Ipsum </a> </li>
                            <li> <a href="#"> Lorem Ipsum </a> </li>
                            <li> <a href="#"> Lorem Ipsum </a> </li>
                        </ul>
                    </div>
                    <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                        <h3>Liens Utiles</h3>
                        <ul>
                            <li> <a href="#"> Lorem Ipsum </a> </li>
                            <li> <a href="#"> Lorem Ipsum </a> </li>
                            <li> <a href="#"> Lorem Ipsum </a> </li>
                            <li> <a href="#"> Lorem Ipsum </a> </li>
                        </ul>
                    </div>
                    <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                        <h3>Suivez Nous</h3>
                        <ul>
                            <li> <a href="#"> Lorem Ipsum </a> </li>
                            <li> <a href="#"> Lorem Ipsum </a> </li>
                            <li> <a href="#"> Lorem Ipsum </a> </li>
                            <li> <a href="#"> Lorem Ipsum </a> </li>
                        </ul>
                    </div>
                    <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                        <h3>Crédits</h3>
                        <ul>
                            <li> <a href="#"> Lorem Ipsum </a> </li>
                            <li> <a href="#"> Lorem Ipsum </a> </li>
                            <li> <a href="#"> Lorem Ipsum </a> </li>
                            <li> <a href="#"> Lorem Ipsum </a> </li>
                        </ul>
                    </div>
                    <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">
                        <h3>Newsletter</h3>
                        <ul>
                            <li>
                                <div class="input-append newsletter-box text-center">
                                    <input type="text" class="full text-center" placeholder="Votre Email">
                                    <button class="btn  bg-gray" type="button">Envoyer</button>
                                </div>
                            </li>
                        </ul>
                        <ul class="social">
                            <li> <a href="#"> <i class=" fa fa-facebook">   </i> </a> </li>
                            <li> <a href="#"> <i class="fa fa-twitter">   </i> </a> </li>
                            <li> <a href="#"> <i class="fa fa-google-plus">   </i> </a> </li>
                            <li> <a href="#"> <i class="fa fa-pinterest">   </i> </a> </li>
                            <li> <a href="#"> <i class="fa fa-youtube">   </i> </a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p class="pull-left"> Copyright © Footer 2017. All right reserved. </p>
            </div>
        </div>
    </footer>
</body>
<script src="js/script.js" charset="utf-8"></script>
<script src="static/external/jquery/dist/jquery.js" charset="utf-8"></script>
<script src="static/external/bootstrap/dist/js/bootstrap.min.js" charset="utf-8"></script>

</html>
