# Restricted Folder

This directory is designated for storing files related to site modules. Access to this folder is restricted and should only be done through PHP scripts or other authorized methods. 

**Important Notes:**
- Direct access to files within this directory is prohibited.
- Any attempt at hardlinking to files is not possible.
- Files included in Backup Functionality.
- Files may be moved if site module is moved in admin panel.

**Use like this for your site module if needed**:  
./_restricted/SITE_MOD_NAME/* 

Please ensure that access to this folder is controlled and limited to authorized scripts or methods to maintain the security of your website modules.
