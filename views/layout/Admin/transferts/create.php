<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau transfert</title>
    <link rel="stylesheet" href="./style/transfert-create.css">
</head>
<body>

<?php require_once "views/layout/Layout/SideBar.html"; ?>

<div class="transfer-container">

    <form class="transfer-card" method="post"
          action="index.php?controller=transfert&action=store">

        <h2>Créer un transfert</h2>

        <input type="hidden" name="reference"
               value="TR-<?= strtoupper(uniqid()) ?>">

        <label>Personne</label>
<select name="personne_id" id="personneSelect" required>
    <option value="">-- choisir --</option>
    <?php foreach ($personnes as $p): ?>
        <option value="<?= $p['id'] ?>">
            <?= htmlspecialchars($p['nom']) ?>
        </option>
    <?php endforeach; ?>
    
</select>

<label>Équipe de départ</label>
<select name="equipe_depart" id="equipeDepartSelect" required>
    <option value="">-- choisir --</option>
</select>


        <label>Équipe d’arrivée</label>
        <select name="equipe_arrivee" required>
            <option value="">-- choisir --</option>
            <?php foreach ($equipes as $e): ?>
                <option value="<?= $e->getId() ?>">
                    <?= htmlspecialchars($e->getNom()) ?>
                </option>
            <?php endforeach; ?>
        </select>
       <div class="form-group">
        <label>Montant du transfert (€)</label>
        <input type="number" name="montant" id="montant">
    </div>


        <label>Statut</label>
        <select name="statut" required>
            <option value="en_attente">En attente</option>
            <option value="valide">Validé</option>
            <option value="refuse">Refusé</option>
        </select>

        <div class="actions">
            <button type="submit" class="btn primary">Créer</button>
            <a href="index.php?controller=transfert&action=index"
               class="btn secondary">Annuler</a>
        </div>

    </form>

<script>
document.getElementById('personneSelect').addEventListener('change', function () {
    const personneId = this.value;
    const equipeSelect = document.getElementById('equipeDepartSelect');
    const montantInput = document.getElementById('montant');
    const montantGroup = document.querySelector('.form-group');

    montantGroup.style.display = 'block';
    montantInput.value = '';
    montantInput.required = true;

    equipeSelect.innerHTML = '<option value="">-- choisir --</option>';
    equipeSelect.disabled = false;

    if (!personneId) return;

    fetch(`index.php?controller=transfert&action=getEquipeByPersonne&id=${personneId}`)
        .then(res => res.json())
        .then(data => {

            if (data.error) {
                alert(data.error);
                return;
            }

            const option = document.createElement('option');
            option.value = data.equipe.id;
            option.textContent = data.equipe.nom;
            option.selected = true;

            equipeSelect.appendChild(option);
            equipeSelect.disabled = true;

            if (data.type === 'coach') {
                montantInput.value = 0;
                montantInput.required = false;
                montantGroup.style.display = 'none';
            } else {
                montantInput.value = data.montant;
                montantInput.required = true;
                montantGroup.style.display = 'block';
            }
        })
        .catch(err => {
            console.error('Erreur fetch:', err);
            montantGroup.style.display = 'block';
        });
});

</script>


</div>

</body>
</html>
