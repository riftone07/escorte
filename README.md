
# Guide de Déploiement - Projet Laravel

Bienvenue dans le guide de déploiement pour le projet Laravel! Suivez attentivement les étapes ci-dessous pour déployer l'application avec succès.

## Étapes de Déploiement

### 1. Installation des Dépendances

Avant de commencer, assurez-vous d'avoir [Composer](https://getcomposer.org/) installé sur votre machine. Ouvrez un terminal dans le répertoire du projet et exécutez la commande suivante :

```bash
composer install
```

### 2. Configuration de l'Environnement

Copiez le fichier d'environnement d'exemple en créant un nouveau fichier `.env` à la racine du projet :

```bash
cp .env.example .env
```

### 3. Génération de la Clé d'Application

Pour garantir la sécurité de votre application, exécutez la commande suivante pour générer une clé d'application unique :

```bash
php artisan key:generate
```

### 4. Liaison du Stockage

Pour permettre l'accès aux fichiers stockés, exécutez la commande suivante :

```bash
php artisan storage:link
```

### 5. Migration de la Base de Données

#### Configuration de la Base de Données

Avant d'exécuter la migration, assurez-vous que votre base de données est correctement configurée dans le fichier `.env`. Ouvrez ce fichier dans un éditeur de texte et localisez les variables suivantes :

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=votre_base_de_donnees
DB_USERNAME=votre_nom_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

Modifiez ces valeurs en fonction de votre configuration de base de données. Assurez-vous que la base de données spécifiée existe déjà.

#### Exécution de la Migration

Une fois que la configuration de la base de données est en place, vous pouvez procéder à la migration. La migration est le processus qui crée les tables nécessaires à votre application dans la base de données.

Ouvrez un terminal dans le répertoire de votre projet et exécutez la commande suivante :

```bash
php artisan migrate --seed
```

Cette commande va créer les tables définies dans les fichiers de migration et insérer des données de départ, si spécifiées.

### 6. Configuration de l'URL de l'Application

Ouvrez le fichier `.env` dans un éditeur de texte et ajoutez l'URL de votre site à la variable `APP_URL`. Cela devrait ressembler à quelque chose comme :

```dotenv
APP_URL=http://votre-url.com
```
