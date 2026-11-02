<?php
require 'connexion_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id     = (int) ($_POST['id'] ?? 0);
    $titre  = trim($_POST['titre'] ?? '');
    $auteur = trim($_POST['auteur'] ?? '');
    $date   = $_POST['date_creation'] ?? '';

    if ($id > 0 && $titre !== '' && $auteur !== '' && $date !== '') {
        $stmt = $pdo->prepare(
            "UPDATE exercice
             SET titre = :titre, auteur = :auteur, date_creation = :date_creation
             WHERE id = :id"
        );
        $stmt->execute([
            ':titre'         => $titre,
            ':auteur'        => $auteur,
            ':date_creation' => $date,
            ':id'            => $id
        ]);
    }
    header('Location: index.php');
    exit;
}


$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM exercice WHERE id = :id");
$stmt->execute([':id' => $id]);
$ex = $stmt->fetch();

if (!$ex) {
    die("Exercice introuvable. <a href='index.php'>Retour</a>");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier un exercice</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <fieldset>
    <legend>Modifier un exercice</legend>
    <form action="modif_exe.php" method="post">
      <input type="hidden" name="id" value="<?= $ex['id'] ?>">

      <label>Titre de l'exercice</label>
      <input type="text" name="titre" maxlength="70" required
             value="<?= htmlspecialchars($ex['titre']) ?>">

      <label>Auteur de l'exercice</label>
      <input type="text" name="auteur" maxlength="30" required
             value="<?= htmlspecialchars($ex['auteur']) ?>">

      <label>Date creation</label>
      <input type="date" name="date_creation" required
             value="<?= $ex['date_creation'] ?>">

      <button type="submit">Modifier</button>
    </form>
  </fieldset>
</body>
</html>