# symfony_contacts
A symfony webapp to manage contacts


******** CLONE PROJECT
git clone https://github.com/mallikarjun92/symfony_contacts.git
cd symfony_contacts

******** Install Dependencies
composer install
npm install
npm run dev

******** Run local server using Symfony CLI
To run local server using symfony download & install Symfony CLI from https://symfony.com/download

symfony local:server:start -d 

******** Connecting Database
Create a empty database from xampp control panel
Configure database in .env file located in root directory
In the .env file located in root directory change line DATABASE_URL="mysql://root:@127.0.0.1:3306/symfApp" to your database credential in the format shown below 
e.g. DATABASE_URL="mysql://{username}:{password}@127.0.0.1:3306/{databasename}"

******* Run Doctrine Migration
run command
php bin/console doctrine:migrations:migrate

Open https://127.0.0.1:8000/ in the browser
