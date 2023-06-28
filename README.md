# A La Renommée - Chaussures THIBAUD

## Installation du projet en mode développement
Une fois que vous avez cloné le git, il suffit de se rendre dans un terminal et de taper :
``composer i`` puis ``npm install``

## Utilisation de TailwindCss
TailwindCss est un framework css qui a un avantage non négligeable de fournir un fichier CSS avec seulement les classes utilisées dans le code du site internet.
Pour l'utiliser, il suffit de taper la commande suivante :
``npx tailwind -i ./src/Tailwindcss/base.css -o ./public/css/style.css --watch``

## Les namespace
Ce site interne utilise un autoloader. Ce dernier permet de charger de manière dynamique les classes utilisées sur la page.
Les namespaces utilisés sont:
- ``Config\`` pour le dossier `config`
- ``App\`` pour le dossier `src`


## Installation du projet en mode production

/!\ Il est important de bien réaliser tous les tests avant de réaliser cette fonctionnalité. Cela nécessite que votre site soit déjà en mode développement (cf. `Installation du projet en mode développement`) /!\

#### Installation de la base de données
Un assistant d'installation est livré directement avec le projet. Pour l'exécuter, vous devez:
- Mettre au format `.csv` les données des tables que vous voulez importer. Chaque fichier devra se trouver dans le dossier `install/` disponible directement à la racine du projet. Le délimiteur utilisé est la virgule `,`
- Nommer chaque fichier correctement:
  - `colors.csv` pour le fichier CSV contenant les couleurs des produits
  - `brands.csv` pour le fichier CSV contenant les marques des produits
  - `collections.csv` pour le fichier CSV contenant les collections de produits
  - `products.csv` pour le fichier CSV contenant les produits
- Modifier les variables dans le fichier `.env` afin que la connexion à la base de données puisse se faire
- Ouvrir un terminal dans le dossier `bin/` et faire la commande `php bin/install install`.

##### Vous ne souhaitez pas exécuter toutes les fonctions du fichier ?
Vous pouvez choisir de réaliser les commandes suivantes:
- `create:database` afin de créer la base de données
- `create:admin` afin de créer l'administrateur du site
- `import:colors` afin d'importer toutes les données concernant les couleurs des produits
- `import:collections` afin d'importer toutes les données concernant les collections de produits
- `import:brands` afin d'importer toutes les données concernant les marques de produits
- `import:products` afin d'importer toutes les données concernant les produits

Vous venez d'installer la base de données, votre site est en mode production!
Vous pouvez vous connecter en utilisant les informations suivantes:
identifiant: `admin@admin.fr`
mot de passe: `admin`

Pour la sécurité de votre infrastructure, nous vous conseillons de modifier votre mot de passe lors de votre première connexion.
