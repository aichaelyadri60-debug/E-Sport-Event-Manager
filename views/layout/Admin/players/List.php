<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – Joueurs</title>

    <link rel="stylesheet" href="./style/listjoueur.css">
</head>
<body>

<?php require_once "views/layout/Layout/SideBar.html"; ?>

<section class="page-header">

    <div class="header-title">
        <h2>Gestion des Joueurs</h2>
        <p class="subtitle">Liste et administration des joueurs eSport</p>
    </div>

    <div class="header-actions">

        <form method="get" class="search-form">
            <input type="hidden" name="controller" value="joueur">
            <input type="hidden" name="action" value="index">

            <input 
                type="text" 
                name="search" 
                class="search"
                placeholder="Rechercher par nom ou pseudo..."
                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
            >
            <button type="submit">🔍</button>
        </form>

        <a href="index.php?controller=Personne&action=show" class="btn btn-primary">
            + Ajouter un joueur
        </a>
    </div>

</section>

<div class="card">

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Pseudo</th>
                <th>Rôle</th>
                <th>Nationalité</th>
                <th>Valeur (€)</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php if (!empty($joueurs)): ?>
            <?php foreach ($joueurs as $joueur): ?>
                <tr>
                    <td><?= htmlspecialchars($joueur['nom']) ?></td>
                    <td><?= htmlspecialchars($joueur['pseudo']) ?></td>
                    <td><?= htmlspecialchars($joueur['role']) ?></td>
                    <td><?= htmlspecialchars($joueur['nationalite']) ?></td>
                    <td><?= number_format($joueur['valeur_marchande'], 0, ',', ' ') ?> €</td>

                    <td class="actions">
                        <a class="btn-action view"
                           href="index.php?controller=joueur&action=show&id=<?= $joueur['personne_id'] ?>">
                            Voir
                        </a>

                        <a class="btn-action edit"
                           href="index.php?controller=joueur&action=edit&id=<?=  $joueur['personne_id'] ?>">
                            Éditer
                        </a>

                        <a class="btn-action delete"
                           href="index.php?controller=joueur&action=delete&id=<?= $joueur['personne_id'] ?>"
                           onclick="return confirm('Voulez-vous supprimer ce joueur ?')">
                            Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="empty">
                    Aucun joueur trouve
                </td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>

</div>
<script>
    const searchInput = document.querySelector('.search');
    const rows = document.querySelectorAll('.table tbody tr');

    searchInput.addEventListener('input', function () {
        const searchValue = this.value.toLowerCase();

        rows.forEach(row => {
            const nom = row.children[0].textContent.toLowerCase();
            const pseudo = row.children[1].textContent.toLowerCase();

            if (nom.includes(searchValue) || pseudo.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>
