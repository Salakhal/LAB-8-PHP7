# 🎓 Lab 8 : Sécurité et Authentification - Mini MVC PHP

## 📝 Présentation
Ce laboratoire porte sur la mise en place d'un système d'authentification complet et la sécurisation d'une application de gestion d'étudiants en utilisant l'architecture **MVC**.

## 🚀 Fonctionnalités implémentées
* **Authentification sécurisée** : Connexion via un compte administrateur stocké en base de données.
* **Hachage des mots de passe** : Utilisation de `password_hash()` (Algorithme BCRYPT).
* **Protection CSRF** : Sécurisation des formulaires contre les attaques de type Cross-Site Request Forgery.
* **Middleware de sécurité** : Blocage de l'accès aux pages de gestion (Étudiants) pour les utilisateurs non authentifiés.
* **Gestion de Session** : Persistance de la connexion et déconnexion sécurisée.
* **Interface dynamique** : Masquage automatique des menus de navigation sur la page de connexion.

## 🛠️ Architecture de Sécurité
L'application utilise plusieurs composants clés :
1.  **Auth.php** : Gère la logique de vérification des identifiants et les sessions.
2.  **Middleware.php** : Intercepte les requêtes pour vérifier les droits d'accès.
3.  **Csrf.php** : Génère et valide les jetons de sécurité pour chaque formulaire POST.
4.  **AdminDao.php** : Communique avec la table `admins` pour l'authentification.

## 📦 Installation

1.  **Base de données** :
    * Importer le schéma SQL.
    * Ajouter un administrateur avec un mot de passe haché :
    ```sql
    INSERT INTO admins (username, password_hash) 
    VALUES ('admin', '$2y$10$s0fzpiNXlDiNlyyqexfsy.OZVFIzYpyogr2CFuXkMurYDmqg6LL.W'); -- Password: Admin1234
    ```

2.  **Configuration** :
    * Modifier les accès DB dans `src/Container/AppFactory.php`.

3.  **Lancement** :
    ```bash
    php -S localhost:8000 -t public
    ```

## 🔒 Routes Protégées
| Route | Méthode | Accès |
| :--- | :--- | :--- |
| `/login` | GET/POST | Public |
| `/etudiants` | GET | Admin uniquement |
| `/etudiants/create` | GET/POST | Admin uniquement |
| `/logout` | POST | Authentifié |

---
---

## 📂 Livrables du Projet
Cette section récapitule les éléments requis pour la validation du **Lab 8**.

### 1. Documentation Technique
Les rapports détaillés sont accessibles via les liens suivants :
* 📄 **[Rapport de Réalisation (Lab 8)](./docs/rapport_lab8.md)** : Analyse technique et choix d'architecture.
* 🧪 **[Plan de Tests de Sécurité](./docs/test_security.md)** : Vérification des vulnérabilités (Auth, Middleware, CSRF).

### 2. Galerie de Preuves (Captures d'écran)
Voici les captures illustrant le fonctionnement et la sécurité de l'application :

| Fonctionnalité | Aperçu Visuel |
| :--- | :--- |
| **Authentification** | ![Login](./screenshots/login.png) |
| **Annuaire & Recherche** | ![Liste](./screenshots/liste_recherche.png) |
| **Création Protégée** | ![Création](./screenshots/creation.png) |
| **Sécurité (403 CSRF)** | ![CSRF Error](./screenshots/csrf_error.png) |

### 3. Arborescence du Projet
Structure simplifiée du code source livré :
```text
.
├── src/
│   ├── Controller/      # Logique de contrôle (Auth, Etudiant)
│   ├── Dao/             # Accès aux données (AdminDao, EtudiantDao)
│   ├── Security/        # Middleware, CSRF, Auth
│   └── Container/       # AppFactory (Injection de dépendances)
├── views/               # Templates PHP (Layout, Login, Etudiant)
├── docs/                # Documentation (Rapports et Tests)
├── public/              # Point d'entrée (index.php, CSS)
└── README.md            # Présentation du projet
