📁 **Restricted Module Data Folder**

The Restricted Folder is designated for storing files associated with site modules, with access restricted to authorized methods or PHP scripts. It is crucial to enforce access restrictions using mechanisms such as `.htaccess`.

- **Restricted Access**: Direct access to files within this directory must be strictly prohibited.
- **No Hardlinking**: Hardlinking to files should be prevented.
- **Relocation**: Files may be moved if the corresponding site module is relocated within the admin panel.

**Caution When Renaming Folders**
- Renaming folders can cause loss of relations to other site modules in _restricted/_public or _internal/_domains.
- Only rename Site Module Folders manually if you understand the implications.
- The Administrator Module has tools to find lost data.


**Usage Guide**

To use this folder for your site module, follow this path:
```plaintext
./_restricted/SITE_MOD_NAME/*
```


**Note:** Changes in this folder are persistent and will not be overwritten by core updates.

Happy coding and have a great one!  
🐟 Bugfish <3