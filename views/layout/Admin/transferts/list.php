<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – Transferts</title>

    <link rel="stylesheet" href="./style/listjoueur.css">
</head>
<body>

<?php require_once "views/layout/Layout/SideBar.html"; ?>

<section class="page-header">

    <div class="header-title">
        <h2>Gestion des Transferts</h2>
        <p class="subtitle">Historique et validation des transferts</p>
    </div>

    <div class="header-actions">
        <a href="index.php?controller=transfert&action=create" class="btn btn-primary">
            + Nouveau transfert
        </a>
    </div>

</section>

<div class="card">

    <table class="table">
        <thead>
            <tr>
                <th>Référence</th>
                <th>Personne</th>
                <th>Équipe départ</th>
                <th>Équipe arrivée</th>
                <th>Montant (€)</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php if (!empty($transferts)): ?>
            <?php foreach ($transferts as $t): ?>
                <tr>
                    <td><?= htmlspecialchars($t['reference']) ?></td>

                    <td><?= htmlspecialchars($t['nom_personne']) ?></td>

                    <td><?= htmlspecialchars($t['equipe_depart_nom']) ?></td>

                    <td><?= htmlspecialchars($t['equipe_arrivee_nom']) ?></td>

                    <td><?= number_format($t['montant'], 0, ',', ' ') ?> €</td>

                    <td>
                        <span class="badge badge-<?= $t['statut'] ?>">
                            <?= ucfirst($t['statut']) ?>
                        </span>
                    </td>

                    <td class="actions">
                        <?php if ($t['statut'] === 'en_attente'): ?>
                            <a class="btn-action validate"
                               href="index.php?controller=transfert&action=valider&id=<?= $t['id'] ?>"
                               onclick="return confirm('Valider ce transfert ?')">
                                Valider
                            </a>

                            <a class="btn-action delete"
                               href="index.php?controller=transfert&action=refuser&id=<?= $t['id'] ?>"
                               onclick="return confirm('Refuser ce transfert ?')">
                                Refuser
                            </a>
                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="empty">
                    Aucun transfert trouvé
                </td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>

</div>

</body>
</html>
