<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Équipe</title>

    <link rel="stylesheet" href="./style/editjoueur.css">
</head>
<body>

<?php require_once "views/layout/Layout/SideBar.html"; ?>

<div class="content">

    <h2>🏆 Ajouter une équipe</h2>
    <p class="subtitle">Créer une nouvelle équipe eSport</p>

    <form 
        action="index.php?controller=equipe&action=store"
        method="post"
        class="form-card"
    >

        <div class="form-group">
            <label>Nom de l’équipe</label>
            <input 
                type="text" 
                name="nom" 
                placeholder="Ex : Team Phoenix"
                required
            >
        </div>

        <div class="form-group">
            <label>Manager</label>
            <input 
                type="text" 
                name="manager" 
                placeholder="Nom du manager"
                required
            >
        </div>

        <div class="form-group">
            <label>Budget (€)</label>
            <input 
                type="number" 
                name="budget" 
                step="0.01"
                min="0"
                placeholder="Ex : 150000.00"
                required
            >
        </div>

        <div class="form-actions">
            <a href="index.php?controller=equipe&action=index" class="btn cancel">
                Annuler
            </a>
            <button type="submit" class="btn save">
                Enregistrer l’équipe
            </button>
        </div>

    </form>

</div>

</body>
</html>
