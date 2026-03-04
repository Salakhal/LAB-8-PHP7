<?php // views/etudiant/create.php /** @var array $filieres, array $erreursValidation, array $old */ ?>
<h2>Inscription d'un nouvel étudiant</h2>

<form method="post" action="/etudiants/store">
    <label>Code CNE
        <input name="cne" value="<?php echo htmlspecialchars($old['cne'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required placeholder="Ex: AB123456">
    </label>
    <?php if (!empty($erreursValidation['cne'])): ?>
        <small class="error" style="color: #dc3545; font-weight: bold;"><?php echo htmlspecialchars($erreursValidation['cne'], ENT_QUOTES, 'UTF-8'); ?></small>
    <?php endif; ?>

    <label>Nom de famille
        <input name="nom" value="<?php echo htmlspecialchars($old['nom'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
    </label>
    <?php if (!empty($erreursValidation['nom'])): ?>
        <small class="error" style="color: #dc3545; font-weight: bold;"><?php echo htmlspecialchars($erreursValidation['nom'], ENT_QUOTES, 'UTF-8'); ?></small>
    <?php endif; ?>

    <label>Prénom
        <input name="prenom" value="<?php echo htmlspecialchars($old['prenom'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
    </label>
    <?php if (!empty($erreursValidation['prenom'])): ?>
        <small class="error" style="color: #dc3545; font-weight: bold;"><?php echo htmlspecialchars($erreursValidation['prenom'], ENT_QUOTES, 'UTF-8'); ?></small>
    <?php endif; ?>

    <label>Adresse Email
        <input type="email" name="email" value="<?php echo htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required placeholder="exemple@domaine.com">
    </label>
    <?php if (!empty($erreursValidation['email'])): ?>
        <small class="error" style="color: #dc3545; font-weight: bold;"><?php echo htmlspecialchars($erreursValidation['email'], ENT_QUOTES, 'UTF-8'); ?></small>
    <?php endif; ?>

    <label>Département / Filière
        <select name="filiere_id" required>
            <option value="">-- Sélectionnez une filière --</option>
            <?php foreach ($filieres as $filiereOption): ?>
                <option value="<?php echo (int)$filiereOption['id']; ?>" <?php echo (isset($old['filiere_id']) && (int)$old['filiere_id'] === (int)$filiereOption['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($filiereOption['code'] . ' — ' . $filiereOption['libelle'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <?php if (!empty($erreursValidation['filiere_id'])): ?>
        <small class="error" style="color: #dc3545; font-weight: bold;"><?php echo htmlspecialchars($erreursValidation['filiere_id'], ENT_QUOTES, 'UTF-8'); ?></small>
    <?php endif; ?>

    <div style="margin-top: 1.5rem;">
        <button type="submit" style="background-color: #28a745; border-color: #28a745;">Enregistrer l'étudiant</button>
        <a role="button" class="secondary outline" href="/etudiants">Retour à la liste</a>
    </div>
</form>