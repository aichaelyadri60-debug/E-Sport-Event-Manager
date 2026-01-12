<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – Contrats</title>

    <link rel="stylesheet" href="./style/listjoueur.css">
</head>
<body>

<?php require_once "views/layout/Layout/SideBar.html"; ?>

<section class="page-header">

    <div class="header-title">
        <h2>Gestion des Contrats</h2>
        <p class="subtitle">Contrats actifs des joueurs et coachs</p>
    </div>

    <div class="header-actions">
        <a href="index.php?controller=contrat&action=show" class="btn btn-primary">
            + Créer un contrat
        </a>
    </div>

</section>

<div class="card">

    <table class="table">
        <thead>
            <tr>
                <th>Nom de personne</th>
                <th>Type</th>
                <th>Équipe</th>
                <th>Salaire (€)</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Actions</th>
            </tr>
        </thead>

       <tbody>

<?php if (!empty($Contrats)): ?>
    <?php foreach ($Contrats as $contrat): ?>
        <tr>
            <td><?= htmlspecialchars($contrat['nom_personne']) ?></td>

            <td><?= ucfirst(htmlspecialchars($contrat['type_personne'])) ?></td>

            <td><?= htmlspecialchars($contrat['nom_equipe']) ?></td>

            <td><?= number_format($contrat['salaire'], 0, ',', ' ') ?> €</td>

            <td><?= htmlspecialchars($contrat['date_debut']) ?></td>

            <td>
                <?= $contrat['date_fin'] ? htmlspecialchars($contrat['date_fin']) : '—' ?>
            </td>

            <td class="actions">

                    <a class="btn-action edit"
                       href="index.php?controller=contrat&action=details&id=<?= $contrat['id'] ?>">
                        voir
                    </a>


                <a class="btn-action delete"
                   href="index.php?controller=contrat&action=delete&id=<?= $contrat['id'] ?>"
                   onclick="return confirm('Supprimer ce contrat ?')">
                    Supprimer
                </a>

            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="7" class="empty">
            Aucun contrat trouvé
        </td>
    </tr>
<?php endif; ?>

</tbody>

    </table>

</div>

</body>
</html>
