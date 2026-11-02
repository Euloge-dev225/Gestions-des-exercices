<?php
require 'connexion_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre  = trim($_POST['titre'] ?? '');
    $auteur = trim($_POST['auteur'] ?? '');
    $date   = $_POST['date_creation'] ?? '';

    if ($titre === '' || $auteur === '' || $date === '') {
        die("Tous les champs sont obligatoires. <a href='index.php'>Retour</a>");
    }

    $sql  = "INSERT INTO exercice (titre, auteur, date_creation)
             VALUES (:titre, :auteur, :date_creation)";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':titre'         => $titre,
        ':auteur'        => $auteur,
        ':date_creation' => $date
    ]);
}

header('Location: index.php');
exit;