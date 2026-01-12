<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Équipe</title>
    <link rel="stylesheet" href="./style/editjoueur.css">
</head>
<body>

<?php require_once "views/layout/Layout/SideBar.html"; ?>

<div class="content">

    <h2>✏️ Modifier l’équipe</h2>
    <p class="subtitle">Mettre à jour les informations de l’équipe eSport</p>

    <form 
        action="index.php?controller=equipe&action=update&id=<?= $equipe->getId() ?>" 
        method="post"
        class="form-card"
    >

        <div class="form-group">
            <label>Nom de l’équipe</label>
            <input 
                type="text" 
                name="nom" 
                value="<?= htmlspecialchars($equipe->getNom()) ?>" 
                required
            >
        </div>

        <div class="form-group">
            <label>Manager</label>
            <input 
                type="text" 
                name="manager" 
                value="<?= htmlspecialchars($equipe->getManager()) ?>" 
                required
            >
        </div>

        <div class="form-group">
            <label>Budget (€)</label>
            <input 
                type="number" 
                name="budget" 
                step="0.01"
                value="<?= htmlspecialchars($equipe->getBudget()) ?>" 
                required
            >
        </div>

        <div class="form-actions">
            <a href="index.php?controller=equipe&action=index" class="btn cancel">
                Annuler
            </a>
            <button type="submit" class="btn save">
                Enregistrer
            </button>
        </div>

    </form>

</div>

</body>
</html>
