

This is a web application for real-time collection of geolocation data, tracks viewing and management.
Together with a dedicated it may be used as a complete self hosted server–client solution for logging and monitoring users' geolocation.



## Minimum requirements:
- PHP 5.5
- PHP extensions: ctype, json, pdo (with respective drivers), session, simplexml, xmlwriter, xdebug (only for tests)
- MySQL, PostgreSQL or SQLite (over PDO driver)
- browser with javascript enabled, cookies for authentication and saving preferences

## Features:
- simple
- allows live tracking
- track statistics
- altitudes graph
- multiple users
- user authentication
- Google Maps
- OpenLayers (OpenStreet and other layers)
- user preferences stored in cookies
- simple admin menu
- export tracks to gpx and kml
- import tracks from gpx

## Install
- Download zipped archive or clone the repository on your computer
- Move it to your web server directory (unzip if needed)
- Fix folder permissions: `uploads` folder (for uploaded images) should be writeable by PHP scripts
- In case of development version it is necessary to build javascript bundle from source files. You will need to install `npm` and run `npm install` and `npm run build` in root folder
- Create database and database user (at least SELECT, INSERT, UPDATE, DELETE privileges, CREATE, DROP for setup script, SEQUENCES for postgreSQL)
- Create a copy of `config.default.php` and rename it to `config.php`. Customize it and add database credentials
- Edit `scripts/setup.php` script, enable it by setting [$enabled](value to `true`
- Make sure you have a web server running with PHP and chosen database
- Open http://YOUR_HOST/ulogger-server/scripts/setup.php page in your browser
- Follow instructions in setup script. It will add database tables and set up your μlogger user
- **Remember to remove or disable `scripts/setup.php` script**
- Log in with your new user on http://YOUR_HOST/server/
- You may also want to set your new user as an [admin in config file]
- Folders `.docker/` and `.tests/` as well as composer files are needed only for development. May be safely removed

## Upgrade to version 1.x
- Incompatible changes include database and config file changes
- Upgrading manually:
  - for database changes, see MySQL example script in `scripts/migrate_to_1_x.mysql`
  - set `admin` column in `users` table to true for admin users
  - edit configuration from application settings dialog
- Upgrading with migration script from version 0.6:
  - create database backup
  - replace all project files with new ones, but keep old local config file: `config.php`
  - change directory to application root folder and run migration script from the console: `php scripts/migrate_to_1_x.php`
  - the script will update database schema and save old config variables to database
- Additional tasks after manual or script update:
  - edit your `config.php` file and remove all variables except database settings, see [config.default.php] for valid values
  - make sure `uploads` folder (for images uploaded from client app) is writable by PHP
  - clear browser cache and restart web page


- Install tests dependecies. PHP tests require PHP >= 7.3.
  - `composer install`
  - `npm install`
- Integration tests may be run against docker image. We need exposed http and optionally database ports (eg. mapped to localhost 8080 and 8081). Below example for MySQL setup
  - `docker build -t ulogger .`
  - `docker run -d --name ulogger -p 8080:80 -p 8081:3306 --expose 3306 -e ULOGGER_ENABLE_SETUP=1 ulogger`
- Use environment variables (or create `.env` file in `.tests/` folder) to set up connection details (below database credentials are docker defaults)
  - `DB_DSN="mysql:host=127.0.0.1;port=8081;dbname=ulogger;charset=utf8"`
  - `DB_USER=aregonet`
  - `DB_PASS=secret2`
  - `URL="http://127.0.0.1:8080"`
- PHP tests
  - `XDEBUG_MODE=coverage ./vendor/bin/phpunit -c .tests/phpunit.xml`
- JS tests
  - `npm test`  
- Other tests
  - `npm run lint:js`
  - `npm run lint:css`



## License
- GPL
- most icons come from [iconmonstr](https://iconmonstr.com)
