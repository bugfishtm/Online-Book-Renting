# Cronjob Folder

The `_cron` folder is dedicated to storing cron jobs that are executed at various intervals. The files must follow the naming convention `cron.*.php` to be auto-included by the core system.

Cron Files will be executed by CLI and so no Site Module is initialized when cron starts. You need to fetch required data and variables out of the database to work with them. See our official documentation to get insights on which information is available for you to use while running cronjobs.  

🐟 Bugfish <3