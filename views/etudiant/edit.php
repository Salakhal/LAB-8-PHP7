

<h2> Modification du profil étudiant #<?php echo (int)$e['id']; ?></h2>

<form method="post" action="/etudiants/<?php echo (int)$e['id']; ?>/update">
    
    <label>Code CNE
        <input name="cne" value="<?php echo htmlspecialchars($e['cne'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
    </label>
    <?php /* Affichage de l'erreur si le CNE saisi est invalide */ ?>
    <?php if (!empty($erreursValidation['cne'])): ?>
        <small class="error" style="color: #dc3545; font-weight: bold;">
            <?php echo htmlspecialchars($erreursValidation['cne'], ENT_QUOTES, 'UTF-8'); ?>
        </small>
    <?php endif; ?>

    <label>Nom de famille
        <input name="nom" value="<?php echo htmlspecialchars($e['nom'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
    </label>
    <?php if (!empty($erreursValidation['nom'])): ?>
        <small class="error" style="color: #dc3545; font-weight: bold;">
            <?php echo htmlspecialchars($erreursValidation['nom'], ENT_QUOTES, 'UTF-8'); ?>
        </small>
    <?php endif; ?>

    <label>Prénom
        <input name="prenom" value="<?php echo htmlspecialchars($e['prenom'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
    </label>
    <?php if (!empty($erreursValidation['prenom'])): ?>
        <small class="error" style="color: #dc3545; font-weight: bold;">
            <?php echo htmlspecialchars($erreursValidation['prenom'], ENT_QUOTES, 'UTF-8'); ?>
        </small>
    <?php endif; ?>

    <label>Adresse Email
        <input type="email" name="email" value="<?php echo htmlspecialchars($e['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
    </label>
    <?php if (!empty($erreursValidation['email'])): ?>
        <small class="error" style="color: #dc3545; font-weight: bold;">
            <?php echo htmlspecialchars($erreursValidation['email'], ENT_QUOTES, 'UTF-8'); ?>
        </small>
    <?php endif; ?>

    <label>Département / Filière
        <select name="filiere_id" required>
            <?php 
            /* * On boucle sur toutes les filières. 
             * Si l'ID de la filière correspond à la filière actuelle de l'étudiant ($e['filiere_id']),
             * on ajoute l'attribut 'selected' pour qu'elle soit sélectionnée par défaut dans la liste.
             */
            foreach ($filieres as $filiereOption): 
            ?>
                <option value="<?php echo (int)$filiereOption['id']; ?>" 
                    <?php echo (isset($e['filiere_id']) && (int)$e['filiere_id'] === (int)$filiereOption['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($filiereOption['code'] . ' — ' . $filiereOption['libelle'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <?php if (!empty($erreursValidation['filiere_id'])): ?>
        <small class="error" style="color: #dc3545; font-weight: bold;">
            <?php echo htmlspecialchars($erreursValidation['filiere_id'], ENT_QUOTES, 'UTF-8'); ?>
        </small>
    <?php endif; ?>

    <div style="margin-top: 1.5rem;">
        <button type="submit" style="background-color: #0056b3; border-color: #0056b3;">Mettre à jour les informations</button>
        <a role="button" class="secondary outline" href="/etudiants/<?php echo (int)$e['id']; ?>">Annuler les modifications</a>
    </div>

</form>