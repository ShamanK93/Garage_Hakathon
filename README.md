# 🚗 Garage_Hakathon

**Garage_Hakathon** est un site web développé avec **Symfony** permettant la vente et la gestion de voitures en ligne. Il s'agit d'un projet réalisé dans le cadre d'un hackathon, offrant une plateforme intuitive pour les utilisateurs souhaitant acheter, consulter ou gérer des véhicules.

## 📌 Fonctionnalités principales

- 🔐 Authentification et gestion des utilisateurs (inscription, connexion)
- 🚘 Affichage de la liste des voitures disponibles à la vente
- ❤️ Ajout de voitures en favoris
- 🧾 Détail complet de chaque voiture (modèle, prix, description, photos, etc.)
- 📦 Gestion des annonces de vente (CRUD pour les administrateurs ou vendeurs)
- 📁 Téléversement et gestion des images des véhicules
- 🔎 Recherche et filtrage par marque, modèle, prix...

## 🛠️ Technologies utilisées

- PHP 8+
- [Symfony](https://symfony.com/) 6.x
- Doctrine ORM
- Twig (moteur de templates)
- HTML / CSS / Bootstrap
- JavaScript (optionnel selon fonctionnalités)
- SQLite ou MySQL pour la base de données

## 🚀 Installation

1. **Cloner le projet**
   ```bash
   git clone https://github.com/ShamanK93/Garage_Hakathon.git
   cd Garage_Hakathon
Installer les dépendances


composer install
Créer le fichier .env.local (optionnel)

Exemple pour une base MySQL :


DATABASE_URL="mysql://user:password@127.0.0.1:3306/garage_hakathon"
Créer la base de données


php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
Lancer le serveur local


symfony server:start
Accéder à l'application

Ouvrez votre navigateur à l'adresse :
http://localhost:8000

👤 Rôles des utilisateurs
Visiteur : peut consulter les voitures et s’inscrire

Utilisateur connecté : peut ajouter aux favoris, contacter le vendeur

Admin/Vendeur : peut ajouter, modifier, supprimer des annonces

📸 Captures d'écran


📦 Structure du projet

.
├── config/
├── public/
├── src/
│   ├── Controller/
│   ├── Entity/
│   ├── Form/
│   └── Repository/
├── templates/
├── migrations/
├── var/
└── vendor/
✨ Auteurs
Shaman Lonny Amine 

Équipe Hackathon – 2025
