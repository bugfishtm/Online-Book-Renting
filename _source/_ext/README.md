📁 **Extensions Modules Folder**

The **Extensions Modules** directory houses modules installed by the store module or uploaded manually. These modules are accessible via the modules they are related to and can be controled by the administrator interface!

### Extensions are related to site modules
In this folder you will find folders which represent the site module folder names they are related to. Installed extensions of that sites are installed here in the specific folder of the site module. If a Site Modules folder name in _site does change, you need to change the extension folder of that site module to. The Administrator module will handle that for you, so its recommended to use it and stick to the dev rules which you can find on my youtube channel.

---------

**How to Install Extension Modules**

**Method 1: Choose Module from Store**
1. Login to the Administrator Site Module.
2. Navigate to "Store"
3. Download the desired extension through the web interface.
4. Navigate to the "Website Module" Area of the Administrator Module.
5. Activate the desired extension on the desired site Module.

**Method 2: Upload in Administrator Module**
1. Open the Administrator Module in your web browser.
2. Login as Administrator or Privileged user.
3. Go to the "Extensions" area and select "Upload Manually."
4. Upload the extensions's .zip file.
5. Navigate to the "Website Module" Area of the Administrator Module.
6. Activate the desired extension on the desired site Module.

**Method 3: Upload Manually**
1. Login to your webserver with FTP/SFTP.
2. Unpack the required Extension Modules folder.
3. Move the extracted folder to the _ext/SITEMODFOLDERNAME directory of the BugfishCMS installation.
   - Use only alphanumeric characters and underscores (_), but _ only at the start.
4. Site module is activated automatically if moved inside that folder. Installation with administrator Module is recommended.

**Notice**  
Site Modules which are inactive are stored in /_internal/_ext-dn/SITEMODULENAME/! 
Extension Modules Templates are stored in /_internal/_ext-tpl for multi deployment, in that folder /_internal/_ext-tpl they stay inactive!  

------

**Important Rules**
- Do not start a extension module name with a number.
- Do not start a extension module name with _ (reserved for core modules).
- Only use alphanumeric characters.
- Extension names and folder names should not exceed 10 characters.

**Note:** Changes in this folder are persistent and will not be overwritten by core updates, but Extension upgrades can change files in that folder.

Happy coding and have a great one!  
🐟 Bugfish <3