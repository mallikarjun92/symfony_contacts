# symfony_contacts
A symfony webapp to manage contacts

**** Requirements

* Symfony CLI  (download & install Symfony CLI from https://symfony.com/download)
* PHP 7.4 or higher


******** CLONE PROJECT

```bash
git clone https://github.com/mallikarjun92/symfony_contacts.git
cd symfony_contacts
```

******** Install Dependencies

```bash
composer install
npm install
```

******* Copy the ./node_modules/startbootstrap-sb-admin-2/ files to ./assets/sb-admin-2/ folder and run dev script

```bash
xcopy /s /Y ".\node_modules\startbootstrap-sb-admin-2\*" ".\assets\sb-admin-2\"
npm run dev
```

******** Run local server using Symfony CLI

```bash
symfony local:server:start -d
```

******** Connecting Database

* Create an empty MySQL database from localhost/phpmyadmin
* Configure database in .env file located in root directory
* In the .env file located in root directory change line DATABASE_URL="mysql://root:@127.0.0.1:3306/symfApp" to your database credential in the format shown below 
* e.g. DATABASE_URL="mysql://{username}:{password}@127.0.0.1:3306/{databasename}"

******* Run Doctrine Migration

run command
```bash
php bin/console doctrine:migrations:migrate
```

Open https://127.0.0.1:8000/ in the browser



