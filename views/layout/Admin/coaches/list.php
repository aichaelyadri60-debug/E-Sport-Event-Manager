<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – Coachs</title>

    <link rel="stylesheet" href="./style/listjoueur.css">
</head>
<body>

<?php require_once "views/layout/Layout/SideBar.html"; ?>

<section class="page-header">

    <div class="header-title">
        <h2>Gestion des Coachs</h2>
        <p class="subtitle">Liste et administration des coachs eSport</p>
    </div>

    <div class="header-actions">

        <form method="get" class="search-form">
            <input type="hidden" name="controller" value="coach">
            <input type="hidden" name="action" value="index">

            <input 
                type="text" 
                class="search"
                placeholder="Rechercher par nom ou style..."
            >
            <button type="submit">🔍</button>
        </form>

        <a href="index.php?controller=Personne&action=show" class="btn btn-primary">
            + Ajouter un coach
        </a>
    </div>

</section>

<div class="card">

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>nationalite</th>
                <th>Style coaching</th>
                <th>Expérience (années)</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php if (!empty($coachs)): ?>
            <?php foreach ($coachs as $coach): ?>
                <tr>
                    <td><?= htmlspecialchars($coach['nom']) ?></td>
                    <td><?= htmlspecialchars($coach['nationalite']) ?></td>
                    <td><?= htmlspecialchars($coach['style_coaching']) ?></td>
                    <td><?= htmlspecialchars($coach['annees_experience']) ?></td>

                    <td class="actions">
                        <a class="btn-action view"
                           href="index.php?controller=coach&action=show&id=<?= $coach['personne_id'] ?>">
                            Voir
                        </a>

                        <a class="btn-action edit"
                           href="index.php?controller=coach&action=edit&id=<?= $coach['personne_id'] ?>">
                            Éditer
                        </a>

                        <a class="btn-action delete"
                           href="index.php?controller=coach&action=delete&id=<?= $coach['personne_id'] ?>"
                           onclick="return confirm('Voulez-vous supprimer ce coach ?')">
                            Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="empty">
                    Aucun coach trouvé
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
            const style = row.children[3].textContent.toLowerCase();

            row.style.display =
                nom.includes(value) || style.includes(value)
                    ? ''
                    : 'none';
        });
    });
</script>

</body>
</html>
