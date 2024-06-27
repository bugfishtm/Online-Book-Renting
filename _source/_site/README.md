📁 **Website Modules Folder**

The **Site Modules** directory houses modules installed by the store module or uploaded manually. These modules are accessible via the integrated admin panel or by adjusting the `cfg_ruleset.php` file.

### Caution When Renaming Folders
- Renaming folders can cause loss of relations to other site modules in _restricted/_public or _internal/_domains.
- Only rename Site Module Folders manually if you understand the implications.
- The Administrator Module has tools to find lost data.

---------

**How to Install Site Modules**

**Method 1: Choose Module from Store**
1. Login to the Administrator Site Module.
2. Navigate to "Store"
3. Download the desired module through the web interface.
4. Navigate to the "Website Module" Area of the Administrator Module.
5. Install the uploaded module template with a desired name.
6. Open the site module once to initialize required data and variables in the database.

**Method 2: Upload in Administrator Module**
1. Open the Administrator Module in your web browser.
2. Login as Administrator or Privileged user.
3. Go to the "Website Module" area and select "Upload Manually."
4. Upload the module's .zip file.
5. Install the uploaded module template with a desired name.
6. Open the site module once to initialize required data and variables in the database.

**Method 3: Upload Manually**
1. Login to your webserver with FTP/SFTP.
2. Unpack the required Site Modules folder.
3. Move the extracted folder to the _site directory of the BugfishCMS installation.
   - Use only alphanumeric characters and underscores (_), but _ only at the start.
4. Use the administrator module or ./developer.php script (ensure it's activated in cfg_ruleset.php) to use the new site module.

**Notice**  
Site Modules which are inactive are stored in /_internal/_site-dn! 
Site Modules Templates are stored in /_internal/_site-tpl for multi deployment, in that folder /_internal/_site-tpl they stay inactive!  

------

**Setting Up Standalone Module Pages**
- Use cfg_ruleset.php in the website's root folders to access deep CMS functionalities.

**Important Rules**
- Do not start a site module name with a number.
- Do not start a site module name with _ (reserved for core modules).
- Only use alphanumeric characters.
- Module names and folder names should not exceed 10 characters.

**Note:** Changes in this folder are persistent and will not be overwritten by core updates.

Happy coding and have a great one!  
🐟 Bugfish <3