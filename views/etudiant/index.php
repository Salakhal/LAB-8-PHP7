<?php // views/etudiant/index.php ?>
<h2>Annuaire des Étudiants</h2>
<div style="display: flex; justify-content: space-between; align-items: center;">
    <p><strong>Total enregistrés :</strong> <?php echo (int)$total; ?> | <strong>Page actuelle :</strong> <?php echo (int)$page; ?> sur <?php echo (int)$totalPages; ?></p>
    <a role="button" href="/etudiants/create" style="background-color: #0056b3;">+ Ajouter un étudiant</a>
</div>

<?php if (empty($etudiants)): ?>
    <article>Aucune donnée disponible pour le moment dans la base.</article>
<?php else: ?>
    <table class="striped">
        <thead>
            <tr style="background-color: #f3f4f6;">
                <th>Réf.</th>
                <th>Code CNE</th>
                <th>Nom Complet</th>
                <th>Adresse Email</th>
                <th>Département / Filière</th>
                <th>Opérations</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etudiants as $etudiantItem): ?>
            <tr>
                <td><strong>#<?php echo (int)$etudiantItem['id']; ?></strong></td>
                <td><?php echo htmlspecialchars($etudiantItem['cne']); ?></td>
                <td><?php echo htmlspecialchars($etudiantItem['nom'] . ' ' . $etudiantItem['prenom']); ?></td>
                <td><a href="mailto:<?php echo htmlspecialchars($etudiantItem['email']); ?>"><?php echo htmlspecialchars($etudiantItem['email']); ?></a></td>
                <td><span class="badge"><?php echo htmlspecialchars($etudiantItem['filiere_code']); ?></span> - <?php echo htmlspecialchars($etudiantItem['filiere_libelle']); ?></td>
                <td>
                    <a href="/etudiants/<?php echo (int)$etudiantItem['id']; ?>">Consulter</a> | 
                    <a href="/etudiants/<?php echo (int)$etudiantItem['id']; ?>/edit">Modifier</a> | 
                    <form action="/etudiants/<?php echo (int)$etudiantItem['id']; ?>/delete" method="post" style="display:inline" onsubmit="return confirm('Confirmez-vous la suppression définitive ?');">
                        <button type="submit" style="padding: 2px 8px; font-size: 0.8em; background: #dc3545; border: none;">X</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
 
    <?php rtrim('/etudiants?size=' . (int)$size . '&page=', '='); $lienBase = '/etudiants?size=' . (int)$size . '&page='; ?>
    <nav class="pagination" style="margin-top: 20px;">
        <?php if ($page > 1): ?>
            <a href="<?php echo $lienBase . ($page-1); ?>" role="button" class="outline">« Précédent</a>
        <?php endif; ?>
        
        <?php for ($num = 1; $num <= $totalPages; $num++): ?>
            <a href="<?php echo $lienBase . $num; ?>" <?php echo ($num === $page) ? 'style="font-weight:bold; text-decoration:underline;"' : ''; ?>><?php echo $num; ?></a>
        <?php endfor; ?>
        
        <?php if ($page < $totalPages): ?>
            <a href="<?php echo $lienBase . ($page+1); ?>" role="button" class="outline">Suivant »</a>
        <?php endif; ?>
    </nav>
<?php endif; ?>