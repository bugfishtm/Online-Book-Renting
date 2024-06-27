📁 **Public Module Data Folder**

The Public Folder is designated for storing files associated with site modules. This directory is openly accessible, allowing for various necessary operations.

- **Direct Access**: Files within this directory can be accessed directly.
- **Hardlinking**: Hardlinking to files is supported.
- **Relocation**: Files may be moved if the corresponding site module is relocated within the admin panel.

**Caution When Renaming Folders**
- Renaming folders can cause loss of relations to other site modules in _restricted/_public or _internal/_domains.
- Only rename Site Module Folders manually if you understand the implications.
- The Administrator Module has tools to find lost data.

**Usage Guide**

To use this folder for your site module, follow this path:
```plaintext
./_public/SITE_MOD_NAME/*
```

**Important Information**
If a Site modules name does change, the related folder / file names related in this folder may needs to be changed to, to not loose data. (Site Module Folder Names are the relation to Folder Name in this Directory.)


**Note:** Changes in this folder are persistent and will not be overwritten by core updates.

Happy coding and have a great one!  
🐟 Bugfish <3