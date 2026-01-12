<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du contrat</title>
    <link rel="stylesheet" href="./style/contrat-show.css">
</head>
<body>

<?php require_once "views/layout/Layout/SideBar.html"; ?>

<div class="contract-container">

    <div class="contract-card">

        <div class="contract-header">
            <h2>Détails du contrat</h2>

            <span class="badge <?= $contrat['date_fin'] ? 'ended' : 'active' ?>">
                <?= $contrat['date_fin'] ? 'Terminé' : 'Actif' ?>
            </span>
        </div>

        <div class="section">
            <h3>👤 Personne</h3>
            <p><strong>Nom :</strong> <?= htmlspecialchars($contrat['nom_personne']) ?></p>
            <p><strong>Type :</strong> <?= ucfirst($contrat['type_personne']) ?></p>
            <p><strong>Équipe :</strong> <?= htmlspecialchars($contrat['nom_equipe']) ?></p>
        </div>

        <div class="section">
            <h3>📄 Contrat</h3>
            <p><strong>Salaire :</strong> <?= number_format($contrat['salaire'], 0, ',', ' ') ?> €</p>
            <p><strong>Clause de rachat :</strong> <?= number_format($contrat['clause_rachat'], 0, ',', ' ') ?> €</p>
            <p><strong>Date début :</strong> <?= $contrat['date_debut'] ?></p>
            <p><strong>Date fin :</strong> <?= $contrat['date_fin'] ?? 'En cours' ?></p>
        </div>

        <div class="contract-actions">
            <?php if ($contrat['date_fin'] === null): ?>
                <a class="btn danger"
                   href="index.php?controller=transfert&action=transfert&id=<?= $contrat['contrat_id'] ?>">
                    transfert
                </a>
            <?php endif; ?>

            <a class="btn secondary"
               href="index.php?controller=contrat&action=index">
                Retour
            </a>
        </div>

    </div>

</div>

</body>
</html>
