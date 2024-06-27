📁 **Store Deployment Folder**

**Description**

If you are hosting your own store with an instance, this folder will provide all necessary data to external instances or the _storepage example module! The Administrator Module comes with full control over deployment!

**Files**

- **update.php**: Responsible for distributing the latest version utilized by this CMS. Configure this functionality by providing a serialized array with the necessary data. Refer to the administrator site module for a sample and adapt it to modify this functionality.

- **store.php**: Furnishes information for the store. When other instances inquire about available modules, this file outputs a serialized array containing available modules.

**Important**  
Changes in this folder are persistent and wont be overwritten with core updates! An exception is the file update.php and core.php which may will be overwritten during core updates.


Happy coding and have a great one!  
🐟 Bugfish <3