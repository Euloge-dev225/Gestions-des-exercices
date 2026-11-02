<?php
require 'connexion_db.php';

$id = (int) ($_GET['id'] ?? 0);

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM exercice WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: index.php');
exit;