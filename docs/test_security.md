#  Tests de Sécurité - Lab 8

Ce document récapitule les tests effectués pour valider la sécurité de l'application.

## 1. Test d'Accès Non Autorisé
* **Action** : Tenter d'accéder à `http://localhost:8000/etudiants` sans être connecté.
* **Résultat attendu** : Redirection automatique vers `/login`.
* **Statut** : ✅ Succès.

## 2. Test d'Authentification (Brute Force / Wrong Password)
* **Action** : Saisir un nom d'utilisateur correct (`admin`) avec un mauvais mot de passe.
* **Résultat attendu** : Message d'erreur "Identifiants invalides" et accès refusé.
* **Statut** : ✅ Succès.

## 3. Test de Protection CSRF
* **Action** : Supprimer le champ `csrf_token` du formulaire de login via l'inspecteur d'élément et soumettre.
* **Résultat attendu** : Blocage de la requête avec le message "Erreur de sécurité (CSRF)".
* **Statut** : ✅ Succès.

## 4. Test de Déconnexion
* **Action** : Cliquer sur le bouton "Déconnexion" et tenter de revenir en arrière avec le navigateur.
* **Résultat attendu** : La session est détruite, l'accès aux pages protégées est impossible.
* **Statut** : ✅ Succès.