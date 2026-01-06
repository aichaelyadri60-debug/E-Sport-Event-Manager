<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Joueur</title>
    <link rel="stylesheet" href="./style/editjoueur.css">
</head>
<body>

<?php require_once "views/layout/Layout/SideBar.html"; ?>

<div class="content">

    <h2>✏️ Modifier le joueur</h2>
    <p class="subtitle">Mettre à jour les informations du joueur</p>

    <form 
        action="index.php?controller=joueur&action=update&id=<?= $joueur['personne_id'] ?>" 
        method="post"
        class="form-card"
    >

        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="nom" value="<?= htmlspecialchars($joueur['nom']) ?>" required>
        </div>

        <div class="form-group">
            <label>Pseudo</label>
            <input type="text" name="pseudo" value="<?= htmlspecialchars($joueur['pseudo']) ?>" required>
        </div>
         <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="<?= htmlspecialchars($joueur['email']) ?>" required>
        </div>

        <div class="form-group">
            <label>Rôle</label>
            <input type="text" name="role" value="<?= htmlspecialchars($joueur['role']) ?>" required>
        </div>

        <div class="form-group">
            <label>Nationalité</label>
            <input type="text" name="nationalite" value="<?= htmlspecialchars($joueur['nationalite']) ?>" required>
        </div>

        <div class="form-group">
            <label>Valeur marchande (€)</label>
            <input 
                type="number" 
                name="valeur_marchande" 
                step="0.01"
                value="<?= htmlspecialchars($joueur['valeur_marchande']) ?>" 
                required
            >
        </div>

        <div class="form-actions">
            <a href="index.php?controller=joueur&action=index" class="btn cancel">
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
