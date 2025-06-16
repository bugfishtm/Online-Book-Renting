# Runtime Daemon Folder

**Use this area with caution as this scripts are running with full server root access (if you have installed this CMS using the background daemon)**

Files named like run.*.php in this folder will be run every time the daemon executes. This is a purpose for operations which need continous execution.

**For security reasons, this functionality is currently limited to extensions of the administrator module, you can fit worker.php for your own needs if necessary, but store it elsewhere outside of the suitefish folder and customize your supervisor linux configuration fitting to your changes.

See our official documentation to get insights on which information is available for you to use while running workers.  

🐟 Bugfish <3