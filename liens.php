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
        <link rel="stylesheet" href="./css/basics.css" media="screen" title="no title" charset="utf-8">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
        <script src="utils.js"></script>
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
                                    <li><a href="graph.php"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Administrateur</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <h2>Donnees ODT</h2>


                <div id="container" style="width: 75%;">
                    <canvas id="canvas"></canvas>
                </div>
                <?php
                include("./includes/connection.php");
                include("bordereau.php");
            //    NOTE; CI DESSSSOUS INJECTION SQL A CORRIGER AVEC UN 'prepare'
                $remplies = $bdd->query('SELECT COUNT(*) as total, mois FROM infos WHERE bordereau="'.$_GET["cat"].'"  AND annee=2017
            GROUP by mois');

                $allremplies = $remplies->fetchAll();
                ?>

                <script>
                    var mois = ["1", "2", "3", "4", "5", "6"];
                    var color = Chart.helpers.color;
                    var barChartData = {
                        labels: ["January", "February", "March", "April", "May", "June"],
                        datasets: [{
                            label: '<?php echo $bordereaux[$_GET["cat"]];?>',
                            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                            borderColor: window.chartColors.red,
                            borderWidth: 1,
                            data: [<?php

                                foreach ($allremplies as $value) {
                                    echo $value->total.",";
            //                        echo $value->total.",\n";

            //                        echo $value->total.",";
                                }
                                ?>]
                        }]
                    };
                    window.onload = function() {
                        var ctx = document.getElementById("canvas").getContext("2d");
                        window.myBar = new Chart(ctx, {
                            type: 'bar',
                            data: barChartData,
                            options: {
                                responsive: true,
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'TAUX DE REACTUALISATION DES FICHES'
                                }
                            }
                        });

                    };



                    //json_encode($tab);
                </script>
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
