<?php
// Tableau associatif de tableaux associatifs (vu dans le slide 64)
// Clé = nom du serveur, Valeur = tableau avec cpu, ram, status
$serveurs = [
    "api-01"   => ["cpu" => 45, "ram" => 60, "status" => "1"],
    "api-02"   => ["cpu" => 92, "ram" => 78, "status" => "1"],
    "db-prod"  => ["cpu" => 70, "ram" => 95, "status" => "1"],
    "web-01"   => ["cpu" => 30, "ram" => 40, "status" => "1"],
    "web-02"   => ["cpu" => 55, "ram" => 65, "status" => "0"],
    "cache-01" => ["cpu" => 88, "ram" => 92, "status" => "1"]
];

// Variables pour le résumé (déclaration de variables, slide 60)
$totalOnline   = 0;
$sommeScores   = 0;
$meilleurNom   = "";
$meilleurScore = -1;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Monitoring de serveurs</title>
</head>
<body>

<!-- PHP mélangé avec HTML (slides 27 et 58) -->
<table id="table1" border="1">
    <tr>
        <th>Serveur</th><th>CPU%</th><th>RAM%</th><th>Status</th><th>Score</th><th>État</th>
    </tr>
    <?php
    // Boucle foreach clé => valeur (vue dans le slide 69)
    foreach ($serveurs as $nom => $infos) {
        $cpu    = $infos["cpu"];      // accès à une case du tableau (slide 64)
        $ram    = $infos["ram"];
        $status = $infos["status"];

        // Opérateurs arithmétiques (slide 66)
        $score = 100 - ($cpu + $ram) / 2;

        // Condition if/elseif/else (slide 67) avec opérateurs logiques et de comparaison (slide 66)
        if ($cpu > 85 || $ram > 90) {
            $etat = "CRITIQUE";
        } elseif ($score >= 50) {
            $etat = "OK";
        } else {
            $etat = "ATTENTION";
        }

        // Statut en texte + compteur de serveurs online (slides 66-67)
        if ($status == "1") {
            $statusTexte = "online";
            $totalOnline++;           // incrémentation (slide 66)
        } else {
            $statusTexte = "offline";
        }

        // Couleur conditionnelle de la ligne (slide 67) : l'ordre des tests est important
        if ($status == "0") {
            $couleur = "rgb(200,200,200)";   // gris
        } elseif ($etat == "CRITIQUE") {
            $couleur = "rgb(255,180,180)";   // rouge
        } elseif ($score >= 50) {
            $couleur = "rgb(180,255,180)";   // vert
        } else {
            $couleur = "rgb(255,220,150)";   // orange
        }

        // Cumul pour la moyenne et recherche du meilleur score (slides 66-67)
        $sommeScores += $score;
        if ($score > $meilleurScore) {
            $meilleurScore = $score;
            $meilleurNom   = $nom;
        }

        // Affichage de la ligne avec CSS inline (echo et concaténation, slides 60-61)
        echo "<tr class=\"row\" style=\"background-color:" . $couleur . ";\">";
        echo "<td class=\"serveur\">" . $nom . "</td>";
        echo "<td class=\"cpu\">" . $cpu . "</td>";
        echo "<td class=\"ram\">" . $ram . "</td>";
        echo "<td class=\"status\">" . $statusTexte . "</td>";
        echo "<td class=\"score\">" . $score . "</td>";
        echo "<td class=\"etat\">" . $etat . "</td>";
        echo "</tr>";
    }

    // Fonction native count() (vue dans le slide 65)
    $scoreMoyen = $sommeScores / count($serveurs);
    ?>
</table>

<h3>Résumé</h3>
<p>Serveurs online: <span id="total_online_servers"><?php echo $totalOnline; ?></span></p>
<p>Score moyen: <span id="moy_scores"><?php echo $scoreMoyen; ?></span></p>
<p>Meilleur serveur: <span id="best_serv"><?php echo $meilleurNom . " (" . $meilleurScore . ")"; ?></span></p>

</body>
</html>