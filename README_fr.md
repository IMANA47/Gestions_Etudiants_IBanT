Voici **la traduction fidèle en français**, sans modification du contenu ni de la structure :

---

# Système de Gestion des Notes

Une application professionnelle et conviviale de gestion des notes, construite avec PHP et Bootstrap 5. Cette application offre aux administrateurs un contrôle complet sur les dossiers des étudiants, les matières et la gestion des notes.

## Fonctionnalités

### Gestion des Étudiants

* **Ajouter des étudiants** : Saisir les informations des nouveaux étudiants avec des champs détaillés
* **Voir tous les étudiants** : Afficher tous les étudiants actifs dans un tableau professionnel
* **Modifier les données des étudiants** : Mettre à jour les informations à tout moment
* **Supprimer des étudiants** : Retirer des dossiers étudiants (suppression logique)
* **Rechercher des étudiants** : Recherche par nom, email ou numéro d’admission

### Gestion des Matières

* **Ajouter des matières** : Créer de nouvelles matières avec codes et descriptions
* **Voir toutes les matières** : Afficher toutes les matières actives
* **Modifier les données des matières** : Mettre à jour les informations
* **Supprimer des matières** : Retirer des matières du système
* **Rechercher des matières** : Recherche rapide par nom ou code

### Gestion des Notes

* **Ajouter des notes** : Saisir les notes des étudiants pour les matières
* **Voir toutes les notes** : Liste complète avec filtres
* **Modifier les notes** : Mettre à jour les notes et remarques
* **Supprimer des notes** : Retirer des enregistrements de notes
* **Calcul automatique des notes** : Les notes sont calculées automatiquement selon les points obtenus
* **Rapports par classe** : Voir les notes organisées par classe

### Fonctionnalités Supplémentaires

* Tableau de bord administrateur professionnel avec statistiques
* Design responsive pour tous les appareils
* Sécurité avec authentification administrateur
* Gestion des sessions
* Gestion complète des erreurs
* Notifications d’alerte pour les actions utilisateur

## Échelle de Notation

| Note | Intervalle de Points |
| ---- | -------------------- |
| A    | 90-100               |
| B    | 80-89                |
| C    | 70-79                |
| D    | 60-69                |
| F    | < 60                 |

## Installation & Configuration

### Prérequis

* XAMPP (ou tout serveur local avec PHP 7.4+ et MySQL)
* Navigateur web
* Éditeur de texte pour configuration

### Installation Étape par Étape

1. **Extraire les fichiers**

   * Extraire le projet dans `C:\xampp\htdocs\gn\`

2. **Créer la base de données**

   * Ouvrir phpMyAdmin : `http://localhost/phpmyadmin`
   * Créer une nouvelle base nommée `grade_management`
   * Importer le fichier `database.sql` :

     * Cliquer sur la base
     * Aller dans l’onglet Importer
     * Sélectionner et envoyer `database.sql`

3. **Configurer la connexion à la base**

   * Ouvrir `includes/config.php`
   * Mettre à jour les identifiants si nécessaire :

     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $database = "grade_management";
     ```

4. **Démarrer XAMPP**

   * Lancer Apache et MySQL

5. **Accéder à l’application**

   * Ouvrir le navigateur : `http://localhost/gn/login.php`

## Identifiants par défaut

**Nom d’utilisateur** : `admin`
**Mot de passe** : `admin123`

⚠️ **IMPORTANT** : Modifier ces identifiants après la première connexion !

## Structure des Fichiers

```
gn/
├── index.php                 # Page d’accueil / Tableau de bord
├── login.php                 # Page de connexion
├── logout.php                # Gestion de déconnexion
├── database.sql              # Schéma et données initiales
│
├── includes/
│   ├── config.php            # Configuration base de données
│   ├── auth.php              # Fonctions d’authentification
│   ├── header.php            # Modèle d’en-tête
│   ├── footer.php            # Modèle de pied de page
│   ├── student_functions.php # Fonctions étudiants
│   ├── subject_functions.php # Fonctions matières
│   └── grade_functions.php   # Fonctions notes
│
├── public/
│   ├── students.php          # Voir étudiants
│   ├── add_student.php       # Ajouter étudiant
│   ├── edit_student.php      # Modifier étudiant
│   ├── delete_student.php    # Supprimer étudiant
│   ├── view_student.php      # Détails étudiant
│   ├── search_student.php    # Recherche étudiants
│   │
│   ├── subjects.php          # Voir matières
│   ├── add_subject.php       # Ajouter matière
│   ├── edit_subject.php      # Modifier matière
│   ├── delete_subject.php    # Supprimer matière
│   ├── search_subject.php    # Recherche matières
│   │
│   ├── grades.php            # Voir notes
│   ├── add_grade.php         # Ajouter note
│   ├── edit_grade.php        # Modifier note
│   ├── delete_grade.php      # Supprimer note
│   └── class_grades.php      # Notes par classe
│
├── assets/
│   ├── css/
│   │   └── style.css         # Styles personnalisés
│   └── js/
│       └── script.js         # Fonctions JavaScript
│
└── uploads/                  # Dossier des fichiers envoyés
```

## Schéma de Base de Données

### Table Admin

Stocke les identifiants administrateur.

### Table Students

* Informations personnelles
* Coordonnées
* Informations du tuteur
* Statut (actif/inactif)

### Table Subjects

* Nom et code de la matière
* Description
* Enseignant
* Crédits horaires

### Table Grades

* Relation étudiant–matière
* Notes et résultats calculés
* Année académique et semestre
* Remarques
* Horodatage automatique

## Guide d’Utilisation

### Ajouter un étudiant

1. Aller dans Students → Add New Student
2. Remplir les champs requis
3. Compléter les informations optionnelles
4. Cliquer sur "Add Student"

### Ajouter une matière

1. Aller dans Subjects → Add New Subject
2. Saisir Nom et Code
3. Ajouter enseignant et crédits
4. Cliquer sur "Add Subject"

### Ajouter une note

1. Aller dans Grades → Add New Grade
2. Sélectionner étudiant et matière
3. Saisir les points (0-100)
4. Indiquer année et semestre
5. Cliquer "Add Grade"
6. La note est calculée automatiquement

### Recherche

* Utiliser la barre de recherche
* Recherche par nom, email ou code
* Résultats en temps réel

### Voir les rapports

* Aller dans Grades → Class Grades Report
* Voir les notes par classe

## Fonctionnalités de Sécurité

* Authentification par session
* Protection contre injection SQL
* Protection XSS
* Suppression logique
* Hachage des mots de passe SHA2(256)

## Compatibilité Navigateurs

* Chrome
* Firefox
* Safari
* Edge
* Navigateurs mobiles

## Problèmes Courants & Solutions

### Problème : Connexion base échouée

* Vérifier MySQL
* Vérifier identifiants
* Vérifier existence de la base

### Problème : Impossible de se connecter

* Vérifier utilisateur admin
* Vérifier import base
* Vider cache navigateur

### Problème : dossier public non chargé

* Vérifier Apache
* Vérifier permissions
* Vérifier structure

## Personnalisation

### Modifier l’échelle de notes

Éditer `calculateGrade()` dans `grade_functions.php`.

### Modifier le thème

Modifier `style.css` :

```css
:root {
    --primary-color: #007bff;
    --secondary-color: #6c757d;
}
```

### Ajouter de nouveaux champs

1. Modifier base
2. Mettre à jour fonctions
3. Mettre à jour formulaires

## Sauvegarde & Restauration

**Sauvegarde :**

```sql
mysqldump -u root -p grade_management > backup.sql
```

**Restauration :**

```sql
mysql -u root -p grade_management < backup.sql
```

## Support & Maintenance

* Sauvegarder régulièrement
* Sécuriser les identifiants
* Surveiller activité
* Mettre à jour PHP
* Tester avant production

## Améliorations Futures

* Suivi de présence
* Import Excel
* Notifications email
* Analyses avancées
* Portail parents
* Application mobile
* Support multi-classes

## Licence

Projet libre d’utilisation et de modification.

## Auteur

**Nsengimana François** Software Developer

Développé comme solution complète de gestion des notes.

## Contact
- Email: [francknsengimana@gmail.com](mailto:francknsengimana@gmail.com)
- LinkedIn: [Linkedin](https://www.linkedin.com/in/françois-nsengimana)

---

**Version** : 1.0
**Dernière mise à jour** : Février 2026
**Statut** : Prêt pour production

---
