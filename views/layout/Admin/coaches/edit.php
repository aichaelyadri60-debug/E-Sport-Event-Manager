<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Coach</title>
    <link rel="stylesheet" href="./style/editjoueur.css">
</head>
<body>

<?php require_once "views/layout/Layout/SideBar.html"; ?>

<div class="content">

    <h2>✏️ Modifier le coach</h2>
    <p class="subtitle">Mettre à jour les informations du coach</p>

    <form 
        action="index.php?controller=coach&action=update&id=<?= $coach['personne_id'] ?>" 
        method="post"
        class="form-card"
    >

        <div class="form-group">
            <label>Nom</label>
            <input 
                type="text" 
                name="nom" 
                value="<?= htmlspecialchars($coach['nom']) ?>" 
                required
            >
        </div>

        <div class="form-group">
            <label>Email</label>
            <input 
                type="email" 
                name="email" 
                value="<?= htmlspecialchars($coach['email']) ?>" 
                required
            >
        </div>

        <div class="form-group">
            <label>Nationalité</label>
            <input 
                type="text" 
                name="nationalite" 
                value="<?= htmlspecialchars($coach['nationalite']) ?>" 
                required
            >
        </div>

        <div class="form-group">
            <label>Style de coaching</label>
            <input 
                type="text" 
                name="style_coaching" 
                value="<?= htmlspecialchars($coach['style_coaching']) ?>" 
                required
            >
        </div>

        <div class="form-group">
            <label>Années d’expérience</label>
            <input 
                type="number" 
                name="annees_experience" 
                min="0"
                value="<?= htmlspecialchars($coach['annees_experience']) ?>" 
                required
            >
        </div>

        <div class="form-actions">
            <a href="index.php?controller=coach&action=index" class="btn cancel">
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
