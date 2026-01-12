<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un contrat</title>
    <link rel="stylesheet" href="./style/editjoueur.css">
</head>
<body>

<?php require_once "views/layout/Layout/SideBar.html"; ?>

<div class="content">

    <h2>📄 Ajouter un contrat</h2>
    <p class="subtitle">Créer un contrat pour un joueur ou un coach disponible</p>

    <form
        action="index.php?controller=contrat&action=store"
        method="post"
        class="form-card"
    >

        <div class="form-group">
            <label>Personne (joueur / coach)</label>
            <select name="personne_id" id="personne_id" required>
                <option value="">-- Sélectionner une personne disponible --</option>
                <?php foreach ($personnesDisponibles as $p): ?>
                    <option value="<?= $p['id'] ?>">
                        <?= htmlspecialchars($p['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Équipe</label>
            <select name="equipe_id" required>
                <option value="">-- Sélectionner une équipe --</option>
                <?php foreach ($AllEquipes as $equipe): ?>
                    <option value="<?= $equipe->getId() ?>">
                        <?= htmlspecialchars($equipe->getNom()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Salaire mensuel (€)</label>
            <input
                type="number"
                name="salaire"
                step="0.01"
                min="0"
                required
            >
        </div>

        <div class="form-group">
            <label>Clause de rachat (€)</label>
            <input
                type="number"
                name="clause_rachat"
                step="0.01"
                min="0"
                required
            >
        </div><div class="form-group">
            <label>Bonus (€)</label>
            <input
                type="number"
                name="bonus"
                id="bonus"
                step="0.01"
                min="0"
                required
            >
        </div>


        <div class="form-actions">
            <a href="index.php?controller=contrat&action=index" class="btn cancel">
                Annuler
            </a>
            <button type="submit" class="btn save">
                Créer le contrat
            </button>
        </div>

    </form>

</div>

<script>
const personneSelect = document.getElementById("personne_id");
const bonusInput = document.getElementById("bonus");
const bonusGroup = bonusInput.closest('.form-group');

personneSelect.addEventListener('change', async function () {
    const personneId = this.value;

    if (!personneId) return;

    try {
        const response = await fetch(
            `index.php?controller=contrat&action=getTypePersonne&id=${personneId}`
        );
        const data = await response.json();

        if (data.type === 'coach') {
            bonusGroup.style.display = 'none';
            bonusInput.value = 0;
        } else {
            bonusGroup.style.display = 'block';
        }

    } catch (error) {
        console.error(error);
    }
});
</script>

</body>
</html>
