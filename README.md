# TomTroc - Échange de livres en ligne

Ce projet a été réalisé dans le cadre du parcours **Développeur Full stack** d'OpenClassrooms (Projet 4). Il s'agit d'une application PHP développée en architecture **MVC (Modèle-Vue-Contrôleur)** sans framework, permettant aux utilisateurs d'échanger leurs livres d'occasion.

## 📋 Prérequis

* **PHP** : 8.1 ou supérieur
* **MySQL** : 5.7 ou supérieur
* **Serveur Web** : Apache ou Nginx

## 🚀 Installation

### 1. Mise en place du projet
Clonez le dépôt à la racine de votre serveur web :

```bash
git clone [https://github.com/nsurget/p4-oc-tomtroc.git](https://github.com/nsurget/p4-oc-tomtroc.git)
```

### 2. Base de données
Un fichier d'export SQL est disponible à la racine du projet (ex: `p4-nsurget-tomtroc.sql`).

1.  Créez une base de données nommée `p4-nsurget-tomtroc` (ou adaptez le nom dans le fichier de config).
2.  Importez le fichier `.sql` situé à la racine du projet dans cette base de données.

### 3. Configuration
Rendez-vous dans le dossier `config/` et créez un fichier nommé `config.php`.
Copiez-y le contenu suivant et adaptez les constantes `DB_` selon votre configuration locale :

```php
<?php
    
    // Start the session as it might be needed depending on the used routes. 
    session_start();

    // Configuration constants, DB connection data, and paths.

    define('TEMPLATE_VIEW_PATH', './src/views/templates/'); // Path to view templates.
    define('TEMPLATE_PART_PATH', './src/views/templates/partials/'); // Path to view partials.
    define('MAIN_VIEW_PATH', TEMPLATE_VIEW_PATH . 'main.php'); // Path to the main layout.

    // DB CONFIGURATION
    // Adapt the port (e.g., 3306) and credentials to your environment.
    define('DB_HOST', 'your_localhost');
    define('DB_NAME', 'p4-nsurget-tomtroc');
    define('DB_USER', 'your_user');
    define('DB_PASS', 'your_password');
```

---

## 🔑 Compte de Démonstration

Pour tester les fonctionnalités "connectées" de l'application sans créer de nouveau compte, vous pouvez utiliser les identifiants suivants :

* **Identifiant** : `nsurget`
* **Mot de passe** : `password`

---

## ⚙️ Fonctionnalités et Routes

L'application gère les actions suivantes via le paramètre d'URL `?action=` :

### Accès Public
* **Accueil** (`/` ou `index.php?action=showBooks`) : Présentation et derniers livres ajoutés.
* **Catalogue** (`index.php?action=showBooks`) : Liste de tous les livres disponibles avec barre de recherche.
* **Détail d'un livre** (`index.php?action=showBook`) : Fiche technique d'un livre spécifique.
* **Profil Public** (`index.php?action=userProfil&id=X`) : Voir la bibliothèque d'un autre utilisateur.
* **Authentification** :
    * Connexion (`index.php?action=login`)
    * Inscription (`index.php?action=register`)

### Espace Membre (Connecté)
* **Mon Profil** (`index.php?action=userProfil`) : Gestion du compte personnel.
* **Modifier Profil** (`index.php?action=userEdit`) : Modification des infos personnelles.
* **Modifier Photo** (`index.php?action=userEditPicture`) : Mise à jour de l'avatar.
* **Messagerie** :
    * Voir les conversations (`index.php?action=showDiscussion`)
    * Envoyer un message (`index.php?action=sendMessage`)
* **Gestion des livres** :
    * Ajouter un livre (`index.php?action=addBook`)
    * Modifier un livre (`index.php?action=editBook`)
    * Sauvegarder (`index.php?action=saveBook`)
* **Déconnexion** (`index.php?action=logout`)

---

## 🛠️ Structure du projet

L'architecture respecte le modèle MVC :
* `config/` : Fichiers de configuration et autoload.
* `src/Controllers/` : Orchestrent la logique entre les modèles et les vues.
* `src/Models/` : Gestion des données et requêtes SQL.
* `src/Views/` : Fichiers d'affichage HTML.
* `index.php` : Point d'entrée unique (Routeur).