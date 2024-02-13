# Public Folder

This directory is designated for storing files related to site modules. Access to this folder is NOT restricted and can be done in any way required. 

**Important Notes:**
- Direct access to files within this directory is possible.
- Any attempt at hardlinking to files is possible.
- Files included in Backup Functionality.
- Files may be moved if site module is moved in admin panel.

**Use like this for your site module if needed**:  
./_public/SITE_MOD_NAME/* 

Please ensure that only non-critical files are in this folder, as hardlinking is possible and anyone can access file as they are not protected in any way.
