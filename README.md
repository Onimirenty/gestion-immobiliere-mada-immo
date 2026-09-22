# MaddaImmo

Back-office, front-office et base de donnée de gestion locative immobilière développé avec **CodeIgniter 3** (PHP) et **PostgreSQL**.

L'application permet à un administrateur de gérer un portefeuille de biens immobiliers, leurs propriétaires et locataires, les contrats de location, ainsi que le suivi financier associé (chiffre d'affaires, gains).



## Sommaire

- [Fonctionnalités](#fonctionnalités)
- [Stack technique](#stack-technique)
- [Arborescence](#arborescence)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Configuration](#configuration)
- [Utilisation](#utilisation)
- [Base de données](#base-de-données)
- [Points de vigilance avant mise en production](#points-de-vigilance-avant-mise-en-production)
- [Licence](#licence)

## Fonctionnalités

- **Authentification** administrateur par session (`Login_C`), avec page de connexion et déconnexion.
- **Gestion des biens** : type de bien, référence, photos associées, propriétaire.
- **Gestion des locations** : création d'un contrat (bien + locataire + date de début + durée), avec formulaire classique et une version en **AJAX** (`Location_C::store_ajax`).
- **Liste et détail des locations**, avec consultation des photos du bien (`ListeLocation_C`, `InformationLocation_C`).
- **Import de données en masse** depuis des fichiers CSV : types de biens, biens et locations, avec insertion transactionnelle (`DataImport_C`).
- **Export PDF** des données via la librairie **FPDF** (`ExportPdf_C`).
- **Statistiques administrateur** : gains et chiffre d'affaires sur une période donnée (`AdminStat_C`).
- **Réinitialisation de la base de données** depuis l'interface (`ResetDatabase_C`).
- **Optimisation d'images** via une librairie maison (`ImageOptimizer`).
- **Métadonnées SEO** par page, stockées en base (`SEO_M`).

## Stack technique

| Composant       | Détail                                              |
|-----------------|------------------------------------------------------|
| Framework       | CodeIgniter 3.x (MVC : contrôleurs `_C`, modèles `_M`, vues `_V`) |
| Langage         | PHP                                                  |
| Base de données | PostgreSQL (driver `postgre`)                        |
| PDF             | FPDF (inclus dans `application/libraries/fpdf`)      |
| Langue de l'app | Français (`$config['language'] = 'french'`)          |

## Arborescence

```
application/
├── config/            # Configuration : base de données, routes, autoload, langue...
├── controllers/
│   ├── Login_C.php            # Authentification admin
│   ├── Location_C.php         # Création / soumission des contrats de location
│   ├── ListeLocation_C.php    # Liste + détail des locations
│   ├── InformationLocation_C.php
│   ├── AdminStat_C.php        # Statistiques (gains, chiffre d'affaires)
│   ├── DataImport_C.php       # Import CSV (types de biens, biens, locations)
│   ├── ExportPdf_C.php        # Export PDF
│   ├── ResetDatabase_C.php    # Réinitialisation de la BDD
│   └── Prime_C.php            # Contrôleur parent : impose une session admin valide
├── models/            # Bien_M, Proprietaire_M, Locataire_M, Location_M, TypeBien_M,
│                       # Photos_M, AdminStat_M, Import_M, ImportProcess_M, Dao_M, SEO_M...
├── views/
│   ├── pages/          # Formulaires, listes, statistiques, import, etc.
│   └── static/         # header / footer
├── libraries/          # fpdf, ImageOptimizer
├── helpers/, hooks/, language/, third_party/
```

## Prérequis

- PHP compatible avec CodeIgniter 3 (7.x recommandé)
- PostgreSQL
- Un serveur web (Apache/Nginx) ou le serveur de développement PHP intégré
- Le framework **CodeIgniter 3.x** complet (dossier `system/` et fichier `index.php`), non fourni dans ce dépôt

## Installation

1. **Cloner le dépôt**
   ```bash
   git clone <url-du-depot>
   cd MaddaImmo
   ```

2. **Ajouter le cœur de CodeIgniter 3** : télécharger [CodeIgniter 3.x](https://github.com/bcit-ci/CodeIgniter) et placer le dossier `system/` ainsi que le fichier `index.php` à la racine du projet, à côté de `application/`.

3. **Créer la base de données PostgreSQL**, par exemple `mada_immo`.

4. **Configurer l'accès à la base** dans `application/config/database.php` :
   ```php
   $db['default'] = array(
       'hostname' => 'localhost',
       'username' => 'votre_utilisateur',
       'password' => 'votre_mot_de_passe',
       'database' => 'mada_immo',
       'dbdriver' => 'postgre',
       ...
   );
   ```

5. **Adapter l'URL de base** dans `application/config/config.php` :
   ```php
   $config['base_url'] = 'http://localhost/MaddaImmo/';
   ```

6. **Créer le schéma de base de données** (tables, vues et fonctions attendues par le code, non fournies dans ce dépôt) — voir la section [Base de données](#base-de-données) pour la liste des objets référencés dans le code.

7. **Lancer le serveur** (exemple avec le serveur intégré PHP, à la racine du projet une fois `system/`et `index.php` en place) :
   ```bash
   php -S localhost:8000
   ```

8. Accéder à l'application et se connecter via la page de login administrateur.

## Configuration

- **Langue** : `application/config/config.php` → `$config['language'] = 'french'`.
- **Librairies auto-chargées** : `database`, `session` (`application/config/autoload.php`).
- **Modèles auto-chargés** : `Dao_M`, `Login_M`, `Miscellaneous_M`, `Normalizer_M`, `SEO_M`.
- **Routes personnalisées** (`application/config/routes.php`) :
  - `default_controller` → `login_C`
  - `gain-administrateur` → `AdminStat_C/gainAdmin`
  - `liste-habitations/details-location-(:any)` → `ListeLocation_C/detailsLocation/$1`

## Utilisation

L'ensemble des contrôleurs métier hérite de `Prime_C`, qui redirige vers la page de connexion si aucune session `LogInfo` n'est active. Il faut donc s'authentifier en tant qu'administrateur (`Login_C`) avant d'accéder aux fonctionnalités de gestion des biens, locations, imports, statistiques, export PDF, etc.

## Base de données

Le code fait référence aux tables, vues et fonctions PostgreSQL suivantes (schéma à créer séparément, non inclus dans ce dépôt) :

- Tables : `biens`, `locataire`, `information_location`, `proprietaire`, `location`, `type_bien`, `photos`, ...
- Vues : `v_liste_biens_proprietaires`, `v_liste_location_details`, `v_information_location`
- Fonctions : `f_get_chiffre_affaire_total`, `f_get_gain_admin`

> Ces noms sont extraits des requêtes présentes dans `application/models/`. Un script SQL de création n'étant pas fourni, il est recommandé de reconstituer le schéma à partir de ces éléments ou de le documenter séparément.


