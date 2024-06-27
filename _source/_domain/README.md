📁 **Domain Files Folder**

This folder is designed to store `robots.txt` and `sitemap.xml` files for different site modes that may be running on various domains. 

**Instructions**

1. **Symbolic Linking**: 
   - Create symbolic links for every folder and file in this CMS to the corresponding virtual hosts (vhosts) of your domains.

2. **Domain Configuration**:
   - In each domain, link the `sitemap.xml` and `robots.txt` files to the respective files in the `_domain` directory.
   - This setup allows multiple `robots.txt` and `sitemap.xml` files to coexist and function properly within a single CMS instance across multiple domains.

**Use Case**

This configuration is only necessary if you need to manage `robots.txt` and `sitemap.xml` files for multiple domains within a multi-site setup.


**Note:** Changes in this folder are persistent and will not be overwritten by core updates.

Happy coding and have a great one!  
🐟 Bugfish <3