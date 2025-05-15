# API de Gestion de Stocks

Une API RESTful développée avec Laravel pour la gestion de stocks d'entreprise.

## 🚀 Technologies Utilisées

- PHP 8.x
- Laravel 10.x
- MySQL/MariaDB
- Composer

## 📋 Prérequis

- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js et NPM (pour les assets)

## ⚙️ Installation

1. Clonez le repository
```bash
git clone [url-du-repository]
cd gestion-stocks-api
```

2. Installez les dépendances PHP
```bash
composer install
```

3. Configurez l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

4. Configurez votre base de données dans le fichier `.env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=votre_base_de_donnees
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

5. Exécutez les migrations
```bash
php artisan migrate
```

6. Lancez le serveur de développement
```bash
php artisan serve
```

## 🔒 Authentification

L'API utilise Laravel Sanctum pour l'authentification. Assurez-vous d'inclure le token d'authentification dans les headers de vos requêtes :

```
Authorization: Bearer votre_token
```

## 📚 Documentation API

### Points d'entrée principaux :

- `POST /api/login` - Authentification
- `POST /api/register` - Création d'un compte
- `GET /api/categories` - Liste des catégories
- `POST /api/categories` - Création d'une catégorie
- `GET /api/categories/{id}` - Détails d'une catégorie
- `PUT /api/categories/{id}` - Mise à jour d'une catégorie
- `DELETE /api/categories/{id}` - Suppression d'une catégorie


## 🛠️ Tests

Pour exécuter les tests :

```bash
php artisan test
```

## 🤝 Contribution

Les contributions sont les bienvenues ! N'hésitez pas à ouvrir une issue ou soumettre une pull request.

## 📝 License

Ce projet est sous licence MIT.
