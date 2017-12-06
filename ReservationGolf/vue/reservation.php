<!DOCTYPE HTML>
<HTML>

<head>
    <meta charset="utf-8"/>

    <link rel="stylesheet" href="../lib/bootstrap/css/style.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <title>RESERVATION GOLF</title>

    <style>

        table {
            margin-top: 10px;
        }

        #connexion {
            visibility: visible;
        }

        th {
            background-color: #9acfea;
            color: #0D47A1;
            text-shadow: 2px 2px 2px white;
        }

        .res {
            width: 200px;
            text-align: center;
        }

        .btn-info{
            margin-top:10px;
        }



    </style>

</head>

<body>

<?php
session_start();

$page = 0;
if (isset($_GET['pseudo'])) {
    $_SESSION['pseudo'] = $_GET['pseudo'];
    $pseudo = $_SESSION['pseudo'];
}
if (isset($_GET['con'])) {
    $c = $_GET['con'];
}
if (isset($_GET['page'])) {
    $page = intval($_GET['page']);

}
?>


<div class="barre"></div>
<div id="conteneur_header">
    <div class="row">
        <div class="col-md-3"><img src="../logo_suaps.png" alt="logo1"/></div>
        <div class="col-md-7" id="titre_principal">

            <h2>
                RESERVATION GOLF DE LA WANTZENAU
            </h2>
        </div>
        <div class="col-md-2"><img src="../logo_droite.png" alt="logo2"/>
        </div>
    </div>
</div>
<div class="barre"></div>


<div id="barre_connexion">
    <div class="row">
        <div id="connexion" class="col-md-6">

            <form method="POST" action="../trt/trt_connexion.php">

                <label for="pseudo">Pseudo : </label>
                <input type="text" id="pseudo" name="pseudo"/>

                <label for="mot_de_passe">Mot de passe : </label>
                <input type="password" id="mot_de_passe" name="mot_de_passe"/>

                <input type="submit" id="btn_connexion" value="se connecter"/>
            </form>
        </div>

    </div>


</div>


<div id="conteneur">
    <div class="row">

        <div class="col-md-2 menu_gauche">
            <div class="menu_titre">
                <?php if(isset($pseudo)) echo $pseudo; ?>
            </div>
        </div>
        <div class="col-md-10 contenu">
            <div id="reservation">
                <input type=button id="btn-avant" class="btn btn-info" name="avant" value="avant"
                       onclick="deplacer_calendrier(0)">
                <input type=button id="btn-suivant" class="btn btn-info" name="apres" value="après"
                       onclick="deplacer_calendrier(<?php echo $page ?>)">
                <?php

                require '../metier/Calendrier.php';

                $cal = new Calendrier('04-12-2017', 3650);

                $sem1 = $cal->charger_semaine_du_tableau(1 + $page);
                $sem2 = $cal->charger_semaine_du_tableau(2 + $page);
                echo "<table class='table table-responsive table-bordered table-stripped' id='tableau_reservation'>";
                echo "<thead>";
                echo "<tr><th>Date</th><th class='res'>Réservation n°1</th><th class='res'>Réservation n°2</th><th class='res'>Réservation n°3</th><th class='res'>Réservation n°4</th></tr>";
                echo "</thead>";
                foreach ($sem1 as $s) {
                    echo "<tbody>";
                    echo "<tr>";
                    echo "<td>$s</td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "</tr>";
                }
                echo "<tr><td style='background-color: #1b6d85'></td><td style='background-color: #1b6d85'></td><td style='background-color: #1b6d85'></td>";
                echo "<td style='background-color: #1b6d85'></td><td style='background-color: #1b6d85'></td></tr>";

                foreach ($sem2 as $s) {
                    echo "<tbody>";
                    echo "<tr>";
                    echo "<td>$s</td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                ?>
            </div>

        </div>
    </div>
</div>


<script>
    var get_con = -1;
    get_con = <?php echo $c ?>;

    if (get_con === 0) {
        document.getElementById('connexion').style.visibility = "hidden";
    } else if (get_con === 1) {
        alert("Mot de passe incorrect");
    } else if (get_con === 2) {
        alert("Utilisateur incorrect");
    }

    var btnsuivant = document.getElementById("btn-suivant");
    btnsuivant.addEventListener("click", function () {
        <?php $page++; ?>
    });
</script>
<script type="text/javascript" src="js/script.js"
<script type="text/javascript" src="../lib/bootstrap/js/jquery.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</HTML>
