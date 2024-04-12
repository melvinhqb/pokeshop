## Pokeshop - Guide d'installation et d'amélioration

### I - Choix de l'architecture Modèle-Vue-Contrôleur (MVC)

Lors du développement de notre site web, nous avons opté pour l'architecture MVC afin de mieux organiser notre code et le rendre plus maintenable. Cette architecture divise l'application en trois composants principaux :

- **Modèles** : Responsables de l'accès aux données et de leur manipulation.
- **Vues** : Gèrent la présentation des données et affichent le contenu aux utilisateurs.
- **Contrôleurs** : Agissent comme des intermédiaires entre les vues et les modèles, coordonnant les actions de l'utilisateur.

Pour plus d'informations sur l'architecture MVC en PHP, vous pouvez consulter le lien suivant : [Adoptez une architecture MVC en PHP](https://openclassrooms.com/fr/courses/4670706-adoptez-une-architecture-mvc-en-php).

### II - Installation

Suivez ces étapes pour installer le projet Pokeshop sur votre environnement de développement local :

1. **Téléchargement de XAMPP** :
   Téléchargez et installez XAMPP à partir du site officiel : [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html).

2. **Démarrage de XAMPP** :
   Lancez XAMPP et assurez-vous que les modules Apache et MySQL sont démarrés.

3. **Initialisation de la base de données** :
   - Accédez à votre navigateur et entrez l'URL `localhost/phpmyadmin`.
   - Connectez-vous à phpMyAdmin.
   - Allez dans l'onglet "Import" et sélectionnez le fichier `database.sql` situé dans le dossier `app/lib`.
   - Cliquez sur le bouton "Go" pour importer la base de données.

4. **Configuration du projet** :
   - Assurez-vous que le répertoire du projet est accessible via votre serveur web local (généralement dans le dossier `htdocs` pour XAMPP).
   - Configurez les paramètres de connexion à la base de données dans le fichier de configuration de votre projet (généralement `config/database.php` ou un fichier similaire). Assurez-vous que les informations d'hôte, de nom d'utilisateur, de mot de passe et de nom de la base de données correspondent à votre configuration locale.

5. **Accès au site** :
   - Ouvrez votre navigateur et entrez l'URL de votre site local (généralement `http://localhost/pokeshop`).
   - Vous devriez maintenant pouvoir accéder au site et naviguer dans ses fonctionnalités.

6. **Connexion à Internet** :
   - Notez que le site nécessite une connexion Internet pour certaines fonctionnalités telles de l'affichage des images et le formulaire de contact.

## III - Installation de Composer et gestion des dépendances

### Installation de Composer

Pour installer Composer, suivez les instructions ci-dessous selon votre système d'exploitation :

#### Sur Windows
1. Téléchargez le fichier d'installation de Composer depuis [getcomposer.org](https://getcomposer.org/download/).
2. Exécutez le fichier `.exe` téléchargé et suivez les instructions d'installation.
3. Ouvrez un terminal et tapez `composer` pour vérifier que Composer est correctement installé.

### IV - Configuration des variables d'environnement

Pour configurer les variables d'environnement :

1. Dupliquez le fichier `.env.exemple` et renommez-le en `.env` dans votre répertoire racine.
2. Ouvrez le fichier `.env` avec un éditeur de texte.
3. Modifiez les valeurs des variables pour correspondre à votre configuration spécifique.
4. Sauvegardez le fichier.

### V - Zones d'amélioration

Voici quelques suggestions pour améliorer davantage le projet Pokeshop :

1. Améliorer l'URL en utilisant un fichier .htaccess pour rendre les routes plus conviviales.
2. Améliorer l'interface d'administration avec une nouvelle conception visuelle.
3. Factoriser le code de l'interface administrateur en utilisant le modèle Model View Controller (MVC).
4. Mettre en place un système de panier pour permettre aux utilisateurs d'ajouter temporairement des articles.
5. Personnaliser les titres dans la barre d'onglets.
6. Modifier la vue des cartes pour afficher les informations de manière stylisée et ajouter un bouton "ajouter au panier".
7. Modifier la vue des sets pour inclure la possibilité d'ajouter un certain nombre d'une carte au panier.
8. Ajouter une icône dans l'onglet à gauche du titre.
9. Dans la partie administrateur, consulter la base de données pour modifier les imformations (notamment les images des séries).
10. Pour l'affichage du tableau des cartes d'une extension, il faut une pagination pour ne pas avoir un tableau à rallonge.
11. Pour l'affichage du tableau des cartes, ajouter éventuellement une deuxième vue (en grille) avec les images mises en avant.
12. Ajouter une menu dropdown sur la catégorie produits avec la liste des séries.
13. Ajouter la page panier et la page paiement.
