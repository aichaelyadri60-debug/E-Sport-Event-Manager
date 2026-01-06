<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Joueur / Coach</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>



<body class="bg-sky-50 min-h-screen flex items-center justify-center">
<?php require_once "views/layout/Layout/SideBar.html"; ?>
<div class="bg-white w-full max-w-md p-6 rounded-xl shadow-lg">

    <h2 class="text-2xl font-bold text-center text-slate-700 mb-6">
        Ajouter une personne
    </h2>

    <form method="post" action="index.php?controller=Personne&action=store" class="space-y-4">

        <div>
            <label class="block font-semibold text-slate-600">Nom</label>
            <input type="text" name="nom" required
                   class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-400">
        </div>

        <div>
            <label class="block font-semibold text-slate-600">Email</label>
            <input type="email" name="email" required
                   class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-400">
        </div>

        <div>
            <label class="block font-semibold text-slate-600">Nationalité</label>
            <input type="text" name="nationalite" required
                   class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-400">
        </div>
        <div>
            <label class="block font-semibold text-slate-600">Type</label>
            <select name="type" id="typeSelect" required
                    class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-400">
                <option value="">-- Choisir --</option>
                <option value="joueur">Joueur</option>
                <option value="coach">Coach</option>
            </select>
        </div>

        <div id="joueurFields" class="hidden space-y-3">
            <h4 class="font-semibold text-sky-600">Informations Joueur</h4>

            <input type="text" name="pseudo" placeholder="Pseudo"
                   class="w-full px-3 py-2 border rounded-lg">

            <input type="text" name="role" placeholder="Rôle"
                   class="w-full px-3 py-2 border rounded-lg">

            <input type="number" step="0.01" name="valeur_marchande"
                   placeholder="Valeur marchande"
                   class="w-full px-3 py-2 border rounded-lg">
        </div>

        <div id="coachFields" class="hidden space-y-3">
            <h4 class="font-semibold text-sky-600">Informations Coach</h4>

            <input type="text" name="style_coaching"
                   placeholder="Style coaching"
                   class="w-full px-3 py-2 border rounded-lg">

            <input type="number" name="annees_experience"
                   placeholder="Années d’expérience"
                   class="w-full px-3 py-2 border rounded-lg">
        </div>

        <button type="submit"
                class="w-full mt-4 bg-sky-500 text-white font-bold py-2 rounded-lg hover:bg-sky-600 transition">
            Enregistrer
        </button>
    </form>
</div>

<script>
    const typeSelect = document.getElementById('typeSelect');
    const joueurFields = document.getElementById('joueurFields');
    const coachFields = document.getElementById('coachFields');

    typeSelect.addEventListener('change', () => {
        joueurFields.classList.add('hidden');
        coachFields.classList.add('hidden');

        if (typeSelect.value === 'joueur') {
            joueurFields.classList.remove('hidden');
        }
        if (typeSelect.value === 'coach') {
            coachFields.classList.remove('hidden');
        }
    });
</script>

</body>
</html>
