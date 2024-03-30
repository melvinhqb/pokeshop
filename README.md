### Pokeshop - Guide d'installation et d'amélioration

#### I - Choix de l'architecture Modèle-Vue-Contrôleur (MVC)

Lors du développement de notre site web, nous avons opté pour l'architecture MVC afin de mieux organiser notre code et le rendre plus maintenable. Cette architecture divise l'application en trois composants principaux :

- **Modèles** : Responsables de l'accès aux données et de leur manipulation.
- **Vues** : Gèrent la présentation des données et affichent le contenu aux utilisateurs.
- **Contrôleurs** : Agissent comme des intermédiaires entre les vues et les modèles, coordonnant les actions de l'utilisateur.

Pour plus d'informations sur l'architecture MVC en PHP, vous pouvez consulter le lien suivant : [Adoptez une architecture MVC en PHP](https://openclassrooms.com/fr/courses/4670706-adoptez-une-architecture-mvc-en-php).

#### II - Installation

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
   - Notez que le site nécessite une connexion Internet pour certaines fonctionnalités d'affichage des cartes.

#### III - Zones d'amélioration

Voici quelques suggestions pour améliorer davantage le projet Pokeshop :

1. Ajouter une page d'erreur 404 (Page Not Found) pour gérer les routes incorrectes ou les valeurs associées à une clé fausses.
2. Améliorer l'URL en utilisant un fichier .htaccess pour rendre les routes plus conviviales.
3. Améliorer l'interface d'administration avec une nouvelle conception visuelle.
4. Factoriser le code de l'interface administrateur en utilisant le modèle Model View Controller (MVC).
5. Implémenter une table users pour gérer la partie login/registeur.
6. Créer un layout distinct pour les invités et les utilisateurs. Afficher un bouton de connexion pour les invités et le nom de l'utilisateur avec un menu déroulant pour les utilisateurs connectés.
7. Mettre en place un système de panier pour permettre aux utilisateurs d'ajouter temporairement des articles.
8. Personnaliser les titres dans la barre d'onglets.
9. Modifier la vue des cartes pour afficher les informations de manière stylisée et ajouter un bouton "ajouter au panier".
10. Modifier la vue des sets pour inclure la possibilité d'ajouter un certain nombre d'une carte au panier.
11. Ajouter une icône dans l'onglet à gauche du titre.
12. Dans la partie administrateur, consulter la base de données pour modifier les imformations (notamment les images des séries).
13. Pour l'affichage du tableau des cartes d'une extension, il faut une pagination pour ne pas avoir un tableau à rallonge.
14. Pour l'affichage du tableau des cartes, ajouter éventuellement une deuxième vue (en grille) avec les images mises en avant.
15. Mettre en style le footer.
16. Mettre en style la page d'accueil.
17. Ajouter une menu dropdown sur la catégorie produits avec la liste des séries.
