# Bookineo API
API pour gérer les livres, les utilisateurs et les locations.

## Prérequis
- PHP 8.2
- Symfony 6
- Doctrine ORM
- MySQL
- Composer

## Installation
1. Cloner le dépôt  git clone https://github.com/Artacalan/bookineo-api.git ou par SSH

2. Installer les dépendances  composer install

3. Configurer la base de données dans `.env.dev`
   DATABASE_URL="mysql://user:password@127.0.0.1:3306/bookineo"

4. Créer la base de données
   Télécharger l'export SQL `bookineo.sql` et l'importer dans MySQL

5. Lancer le serveur
   symfony server:start -d

6. Stopper le serveur
   symfony server:stop

## Utilisation
Passage du profile utilisateur à admin:
Se rendre dans la base de données, table `users`, et modifier la valeur du champ `role` de `0` à `1`.
