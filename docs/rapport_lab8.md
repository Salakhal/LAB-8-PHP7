# 📝 Rapport de Réalisation Détaillé - Lab 8
**Sujet :** Sécurisation d'une Application de Gestion d'Étudiants (Architecture MVC)
**Date :** Mars 2026

---

## 1. Introduction et Objectifs
L'objectif principal de ce laboratoire était de transformer une application de gestion CRUD basique en une plateforme sécurisée multi-utilisateur. Nous avons mis l'accent sur la protection des données et le contrôle d'accès.

Les piliers de cette réalisation sont :
* **L'Authentification** : Reconnaître l'utilisateur (Admin).
* **L'Autorisation** : Restreindre l'accès aux fonctionnalités sensibles.
* **L'Intégrité** : Protéger les échanges contre les manipulations malveillantes (CSRF).

---

## 2. Architecture Technique de Sécurité

### A. Gestion de la Base de Données
Nous avons créé une table `admins` pour stocker les identifiants. Contrairement aux méthodes obsolètes, les mots de passe ne sont jamais stockés en clair.
* **Mécanisme** : Utilisation de l'algorithme **BCRYPT** via `password_hash()`.
* **Avantage** : Même en cas de fuite de la base de données, les mots de passe restent indéchiffrables.



### B. Le Composant Middleware (Le Gardien)
Le `Middleware.php` agit comme une barrière entre la requête de l'utilisateur et le contrôleur. 
* **Fonctionnement** : Avant d'exécuter une action dans `EtudiantController`, le système vérifie si une session active existe.
* **Blocage** : Si l'utilisateur n'est pas authentifié, il est automatiquement redirigé vers la page de login via la méthode `requireAdmin()`.

### C. Protection contre les attaques CSRF
Pour chaque session, un jeton unique (`csrf_token`) est généré.
* **Injection** : Le jeton est inséré dans chaque formulaire POST en tant que champ caché (`hidden`).
* **Validation** : À la réception, l'application compare le jeton soumis avec celui stocké en session. Si les deux ne correspondent pas, la requête est rejetée.

---

## 3. Détails de l'Implémentation (Développement)

### 📂 Dossier `src/Security`
1.  **Auth.php** : Contient la logique de démarrage de session, de vérification des credentials et de déconnexion.
2.  **Csrf.php** : Gère la génération et la vérification des tokens de sécurité.
3.  **Middleware.php** : Centralise les règles d'accès aux routes protégées.

### 📂 Dossier `src/Controller`
* **AuthController.php** : Gère l'affichage du formulaire de connexion, le traitement du login et la destruction de la session (Logout).
* **EtudiantController.php** : Désormais protégé par l'appel au Middleware dans son constructeur.

---

## 4. Amélioration de l'Interface Utilisateur (UI/UX)
Pour offrir une expérience professionnelle, nous avons implémenté un **affichage conditionnel** dans le `layout.php` :
1.  **Masquage du Menu** : La barre de navigation est totalement invisible sur la page de connexion pour éviter les distractions et renforcer l'aspect sécurisé.
2.  **Menu Dynamique** : Le lien "Liste" et le bouton "Déconnexion" n'apparaissent que si l'administrateur est connecté.

---

## 5. Tests et Validation
Plusieurs scénarios ont été testés pour valider la robustesse du système :
* **Accès direct** : Tentative d'accès à `/etudiants` via l'URL ➔ **Succès** (Redirection vers login).
* **Identifiants erronés** : Saisie d'un mauvais mot de passe ➔ **Succès** (Message d'erreur affiché).
* **Expiration de session** : Après déconnexion, le bouton "Précédent" du navigateur ne permet plus de modifier les données ➔ **Succès**.

---

## 6. Conclusion
Ce Lab 8 a permis de comprendre l'importance de la sécurité dans le cycle de développement. L'application ne se contente plus de gérer des données, elle les protège. L'utilisation d'un design pattern MVC a facilité l'intégration de ces couches de sécurité sans perturber la logique métier initiale.