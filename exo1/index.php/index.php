<?php
// Déclaration de variable et tableau associatif (vus dans les slides 60 et 64)
// Clé = nom de l'étudiant, Valeur = sa moyenne
$etudiantsNote = [
    "JOHN"   => 9,
    "BOB"    => 15.5,
    "RAYANE" => 7,
    "ROSIE"  => 13
];

// Déclaration d'une fonction avec paramètre et return (vu dans le slide 71)
// Utilise l'opérateur de comparaison >= (vu dans le slide 66)
function estAdmissible($note) {
    return $note >= 10;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Etudiants-Note</title>
</head>
<body>

<!-- Code PHP mélangé avec du HTML (vu dans les slides 27 et 58) -->
<table id="table1" border="1">
    <tr>
        <th>Etudiant</th>
        <th>Note</th>
    </tr>
    <?php
    // Ici on utilise une boucle foreach clé => valeur (vue dans le slide 69)
    foreach ($etudiantsNote as $nom => $note) {

        // Appel de la fonction estAdmissible (slide 71) dans une condition if/else (slide 67)
        if (estAdmissible($note)) {
            $couleur = "rgb(136,248,136)";  // vert
        } else {
            $couleur = "rgb(251,173,173)";  // rouge
        }

        // Affichage avec echo et concaténation avec le point (slides 60-61)
        echo "<tr class=\"row\">";
        echo "<td class=\"etud\">" . $nom . "</td>";
        echo "<td class=\"note\" style=\"background-color:" . $couleur . ";\">" . $note . "</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>