# Update Folder

The `_update` folder is used for managing database updates within suitefish cms. It contains PHP files that automate the process of updating the database schema and content to match the current module build number. 

Files in this folder follow a specific naming convention: `[build_number].php`. These files are responsible for implementing database changes necessary to upgrade from one build version to the next. If the current installed build version of the CMS does not match the deployed module build number, update files between these versions will be executed sequentially to bring the database up to date.

The `_update` folder typically includes:
- **PHP Update Files**: Named with the build number they update to, e.g., `201.php`, `250.php`.

🐟 Bugfish <3