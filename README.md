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



### 2. Arborescence du Projet
Structure simplifiée du code source livré :
```text
.
PhpProject8/
├── docs/                      # Documentation technique
│   ├── rapport_lab8.md        # Rapport de réalisation détaillé
│   └── test_security.md       # Plan de tests et validation
├── logs/                      # Journaux d'erreurs et d'activités
├── public/                    # Dossier racine web
│   └── index.php              # Point d'entrée de l'application
├── src/                       # Code source (Logique métier)
│   ├── Container/
│   │   └── AppFactory.php     # Configuration et Injection de dépendances
│   ├── Controller/
│   │   ├── AuthController.php # Gestion Login/Logout
│   │   ├── BaseController.php # Contrôleur parent (View/Response)
│   │   └── EtudiantController.php # CRUD Étudiants protégé
│   ├── Core/                  # Noyau du Framework MVC
│   │   ├── Request.php
│   │   ├── Response.php
│   │   ├── Router.php
│   │   └── View.php
│   ├── Dao/                   # Data Access Objects (Requêtes SQL)
│   │   ├── AdminDao.php
│   │   ├── DBConnection.php
│   │   ├── EtudiantDao.php
│   │   ├── FiliereDao.php
│   │   └── Logger.php
│   └── Security/              # Couche de sécurité
│       ├── Auth.php           # Logique de session
│       ├── Csrf.php           # Protection jetons CSRF
│       ├── Middleware.php     # Gardien des accès (requireAdmin)
│       ├── Sanitizer.php      # Nettoyage des inputs
│       └── Validator.php      # Validation des données
├── views/                     # Templates de l'interface
│   ├── auth/
│   │   └── login.php          # Formulaire de connexion
│   ├── etudiant/
│   │   ├── create.php         # Formulaire d'ajout
│   │   ├── edit.php           # Formulaire de modification
│   │   ├── index.php          # Liste des étudiants (Annuaire)
│   │   └── show.php           # Détails d'un étudiant
│   └── layout.php             # Template principal (Header/Footer)
└── README.md                  # Documentation globale du projet

```

### 3. Galerie de Preuves (Captures d'écran)
Voici les captures illustrant le fonctionnement et la sécurité de l'application :

## 1. Authentification (Page Login)

<img width="874" height="408" alt="image" src="https://github.com/user-attachments/assets/3b5a84b8-2d28-4024-80d3-6641d453d129" />

 
## 2. Annuaire & Recherche (Liste des Étudiants)

<img width="896" height="819" alt="image" src="https://github.com/user-attachments/assets/5f8a43ce-d93c-45c3-a596-a0ad0449ddb5" />


## 3. Création Protégée (Formulaire Ajout)

<img width="846" height="779" alt="image" src="https://github.com/user-attachments/assets/a19c1b3d-2b20-4224-943c-884d323da08d" />



## 4. Sécurité (Erreur 403 CSRF)

<img width="816" height="403" alt="image" src="https://github.com/user-attachments/assets/40eebb68-6792-4c6a-8f03-daee85272583" />


## 👤 Auteur

* **École Normale Supérieure de Marrakech**
  
* **Réalisé par :** SALMA LAKHAL
  
* **Filière  :** CLE_INFO_S5
  
* **Année universitaire :** 2025/2026
  
* **Encadré par :** Pr. Mohamed LACHGAR

* **Cours :*** Ingénierie Logicielle Web avec PHP 7 : Architecture Multicouche et Accès aux Données Sécurisé


