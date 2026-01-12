<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – Équipes</title>

    <link rel="stylesheet" href="./style/listjoueur.css">
</head>
<body>

<?php require_once "views/layout/Layout/SideBar.html"; ?>

<section class="page-header">

    <div class="header-title">
        <h2>Gestion des Équipes</h2>
        <p class="subtitle">Liste et administration des équipes eSport</p>
    </div>

    <div class="header-actions">
        <form class="search-form">
            <input 
                type="text" 
                class="search"
                placeholder="Rechercher par nom ou manager..."
            >
            <button type="button">🔍</button>
        </form>

        <a href="index.php?controller=equipe&action=show" class="btn btn-primary">
            + Ajouter une équipe
        </a>
    </div>

</section>

<div class="card">

    <table class="table">
        <thead>
            <tr>
                <th>Nom de l’équipe</th>
                <th>Manager</th>
                <th>Budget (€)</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php if (!empty($equipes)): ?>
            <?php foreach ($equipes as $equipe): ?>
                <tr>
                    <td><?= htmlspecialchars($equipe->getNom()) ?></td>
                    <td><?= htmlspecialchars($equipe->getManager()) ?></td>
                    <td><?= number_format($equipe->getBudget(), 2, ',', ' ') ?> €</td>

                    <td class="actions">
                        <a class="btn-action view"
                           href="index.php?controller=equipe&action=show&id=<?= $equipe->getId() ?>">
                            Voir
                        </a>

                        <a class="btn-action edit"
                           href="index.php?controller=equipe&action=edit&id=<?= $equipe->getId() ?>">
                            Éditer
                        </a>

                        <a class="btn-action delete"
                           href="index.php?controller=equipe&action=delete&id=<?= $equipe->getId() ?>"
                           onclick="return confirm('Voulez-vous supprimer cette équipe ?')">
                            Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="empty">
                    Aucune équipe trouvée
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
        const value = this.value.toLowerCase();

        rows.forEach(row => {
            const nom = row.children[0].textContent.toLowerCase();
            const manager = row.children[1].textContent.toLowerCase();

            row.style.display =
                nom.includes(value) || manager.includes(value)
                    ? ''
                    : 'none';
        });
    });
</script>

</body>
</html>
