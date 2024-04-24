# Pokeshop

Pokeshop est un site fictif dédié à la vente de cartes Pokémon.

## Installation
### Prérequis
- XAMPP (https://www.apachefriends.org/fr/download.html)
- Composer (https://getcomposer.org/download/)

### Étapes d'installation
1. Cloner le projet dans le répertoire `htdocs` de XAMPP :
   ```bash
   git clone https://github.com/melvinhqb/pokeshop.git
   cd pokeshop
   ```
2. Installer les dépendances
   ```bash
   composer install
   ```
3. Dupliquer le fichier `.env.example` et renommer la copie en `.env`, puis configurer la variable `ADMIN_EMAIL` avec votre mail personel.
4. Ouvrir XAMMP en mode administrateur et démarrer les serveurs Apache et MySQL.
5. Ouvrir dans votre navigateur `localhost/phpmyadmin`, importer le fichier `database.sql` situé dans le dossier `config` pour créer la base de données et insérer les données de test.

## Utilisation
Pour voir le site en action, voici un [lien vers une démonstration sur YouTube](https://www.youtube.com/watch?v=YSZ1WMWkZts).

## Architecture Modèle - Vue - Contrôleur (MVC)

Lors du développement de Pokeshop, nous avons adopté l'architecture Modèle-Vue-Contrôleur (MVC) pour structurer notre application. Cette architecture nous aide à séparer les préoccupations, améliorant ainsi la maintenance et l'évolution du code.

Voici une description des trois composants principaux de cette architecture :

- **Modèles :** Gèrent les données et la logique métier de l'application.
- **Vues :** Responsables de la présentation des données aux utilisateurs.
- **Contrôleurs :** Coordonnent les interactions entre les modèles et les vues.

## Fonctionnalités
Voici un tableau qui présente les fonctionnalités disponibles selon les différents rôles :

| Fonctionnalités                             | Guest       | Client      | Admin      |
|---------------------------------------------|-------------|-------------|------------|
| Consulter les cartes disponibles            | ✔️          | ✔️          | ✔️         |
| Contacter le service après-vente par email  | ✔️          | ✔️          | ✔️         |
| Ajouter ou retirer des cartes du panier     |             | ✔️          | ✔️         |
| Effectuer des paiements                     |             | ✔️          | ✔️         |
| Ajouter des cartes à la base de données     |             |             | ✔️         |

**Note:** La page d'administration est présente, mais le rôle administrateur n'est pas encore implémenté.
