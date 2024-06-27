📁 **Script Modules Folder**

The **Script Modules** directory houses script modules installed by the administrator module or uploaded manually. These modules are accessible by hardlinking to them if they have a public.php file, or by accessing threm trough the administrator interface or a fitting extension or module.

---------

**How to Install Script Modules**

**Method 1: Choose Module from Store**
1. Login to the Administrator Site Module.
2. Navigate to "Store"
3. Download the desired script module through the web interface.
4. Navigate to the "Scripts" Area of the Administrator Module.
5. Install the aquired Script
6. Use the script by hardlinking to the scripts public.php or access it through cms administrator module restricted.php or internal functionalities.

**Method 2: Upload in Administrator Module**
1. Open the Administrator Module in your web browser.
2. Login as Administrator or Privileged user.
3. Go to the "Script Module" area and select "Upload Manually."
4. Upload the scripts's .zip file.
5. Install the aquired Script
6. Use the script by hardlinking to the scripts public.php or access it through cms administrator module restricted.php or internal functionalities.

**Method 3: Upload Manually**
1. Login to your webserver with FTP/SFTP.
2. Unpack the required Script Modules folder.
3. Move the extracted folder to the _script directory of the BugfishCMS installation.
   - Use only alphanumeric characters and underscores (_), but _ only at the start.
4. Use the script by hardlinking to the scripts public.php or access it through cms administrator module restricted.php or internal functionalities.

**Notice**  
Script Modules Templates are stored in /_internal/_script-tpl for multi deployment, in that folder /_internal/_script-tpl they stay inactive!  

------

**Important Rules**
- Do not start a script module name with a number.
- Do not start a script module name with _ (reserved for core modules).
- Only use alphanumeric characters.
- script module names and folder names should not exceed 10 characters.

**Note:** Changes in this folder are persistent and will not be overwritten by core updates.

Happy coding and have a great one!  
🐟 Bugfish <3