<?php

require_once 'connexion_db.php';

$statement = $pdo->query("SELECT * FROM exercice ORDER BY id");
$exercices = $statement->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des exercices</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <fieldset>
    <legend>Ajouter un exercice</legend>
    <form action="ajout_exe.php" method="post">
        <label for="titre">Titre de l'exercice</label>
        <input type="text" id="titre" name="titre" maxlength="70" required>

        <label for="auteur">Auteur de l'exercice</label>
        <input type="text" id="auteur" name="auteur" maxlength="30" required>

        <label for="date_creation">Date creation</label>
        <input type="date" id="date_creation" name="date_creation" required>

        <button type="submit">Envoyer</button>
    </form>
    </fieldset>

    <?php if (empty($exercices)): ?>
        <section class="empty-state" role="status">
            <h2>Aucun exercice pour le moment</h2>
            <p>Votre liste est vide. Utilisez le formulaire ci-dessus pour ajouter votre premier exercice.</p>
        </section>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>id</th><th>titre</th><th>auteur</th>
                    <th>date_creation</th><th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($exercices as $ex): ?>
                <tr>
                    <td><?= $ex['id'] ?></td>
                    <td><?= htmlspecialchars($ex['titre']) ?></td>
                    <td><?= htmlspecialchars($ex['auteur']) ?></td>
                    <td><?= $ex['date_creation'] ?></td>
                    <td><a href="modif_exe.php?id=<?= $ex['id'] ?>">Modifier</a></td>
                    <td><a href="supp_exe.php?id=<?= $ex['id'] ?>"
                        class="btn-supprimer">Supprimer</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

  <script src="script.js"></script>

</body>