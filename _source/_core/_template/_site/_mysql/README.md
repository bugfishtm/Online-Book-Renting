# Mysql Files

The `_mysql` folder is used for managing database tables within Suitefish CMS. It contains PHP files that automate the creation of database tables if they do not already exist. This feature helps streamline the setup and maintenance of the CMS database structure.

Files in this folder follow a specific naming convention: `mysql.*.php`. These files are responsible for defining database tables. If a table named like the file (without the `mysql.` prefix) does not exist in the database, the corresponding PHP file will automatically execute to create it.

Inside the official documentation you can find variables which are available with information for your module and site development!

🐟 Bugfish <3