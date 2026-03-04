<?php 
/**
 * Vue : views/etudiant/show.php
 * Objectif : Afficher les détails complets d'un étudiant spécifique.
 * * @var array $e Contient toutes les informations de l'étudiant récupérées depuis la base de données.
 */
?>

<h2>Fiche Détaillée - Étudiant N°<?php echo (int)$e['id']; ?></h2>

<div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #e9ecef; margin-bottom: 20px;">
    <ul style="list-style-type: none; padding-left: 0; margin: 0;">
        <li style="margin-bottom: 12px; font-size: 1.1em;">
            <strong>Code CNE :</strong> <?php echo htmlspecialchars($e['cne'], ENT_QUOTES, 'UTF-8'); ?>
        </li>
        <li style="margin-bottom: 12px; font-size: 1.1em;">
            <strong>Nom de famille :</strong> <?php echo htmlspecialchars($e['nom'], ENT_QUOTES, 'UTF-8'); ?>
        </li>
        <li style="margin-bottom: 12px; font-size: 1.1em;">
            <strong>Prénom :</strong> <?php echo htmlspecialchars($e['prenom'], ENT_QUOTES, 'UTF-8'); ?>
        </li>
        <li style="margin-bottom: 12px; font-size: 1.1em;">
            <strong>Adresse électronique :</strong> 
            <a href="mailto:<?php echo htmlspecialchars($e['email'], ENT_QUOTES, 'UTF-8'); ?>" style="color: #0056b3;">
                <?php echo htmlspecialchars($e['email'], ENT_QUOTES, 'UTF-8'); ?>
            </a>
        </li>
        <li style="margin-bottom: 12px; font-size: 1.1em;">
            <strong>Département / Filière :</strong> 
            <span style="background-color: #e2e3e5; padding: 4px 10px; border-radius: 4px; font-weight: bold;">
                <?php echo htmlspecialchars($e['filiere_code'] . ' — ' . $e['filiere_libelle'], ENT_QUOTES, 'UTF-8'); ?>
            </span>
        </li>
    </ul>
</div>

<div style="display: flex; gap: 15px; align-items: center;">
    
    <a role="button" href="/etudiants/<?php echo (int)$e['id']; ?>/edit" style="background-color: #ffc107; color: #000; border: none;">Modifier le profil</a>
    
    <a role="button" class="secondary outline" href="/etudiants"> Revenir à l'annuaire</a>

    <form action="/etudiants/<?php echo (int)$e['id']; ?>/delete" method="post" style="margin: 0;" onsubmit="return confirm('Attention ! Êtes-vous certain de vouloir retirer définitivement cet étudiant du système ?');">
        <button type="submit" style="background-color: #dc3545; border: none;">Supprimer</button>
    </form>

</div>