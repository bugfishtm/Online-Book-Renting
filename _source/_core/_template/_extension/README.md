# Template: Extension Module

 🧩 General Information

Extension Module Example for the Administrator module, especially for Developers. You can get more Information about Extension Modules inside the Suitefish Documentation and related Readme.md Files in the repository!

🗂️ Folder Structure

Scripts to be injected into the _administrator module.

```
./_extension/_admin/
├── mod_setting.php (Module Settings for Admin Module)
├── mod_nav.php (Module Navigation for Admin Module)
├── mod_site.php (Module Site for Admin Module)
├── mod_permission.php (Module Permissions for Admin Module)
├── mod_topbar.php (Module Topbar Injection for Admin Module)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Configuration to be injected at site module initialization.

```
./_extension/_config/
├── config_pre.php (Pre-startup configuration)
├── config_post.php (Post-startup configuration)
└── config.php (Main configuration file)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Store your code for cronjobs in this folder!

```
./_extension/_cron/
├── cron.example.php (Example Cronjob File)
├── .. (Store your other integrated cronjobs here.)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Store your css code in this folder!

```
./_extension/_css/
├── css.example.php (Example CSS File)
├── .. (Store your other css files here.)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Preview images for the readme.md file.

```
./_extension/_images/
├── ... (Content you may add)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Store your js code in this folder!

```
./_extension/_js/
├── js.example.php (Example JS File)
├── .. (Store your other js files here.)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Language Translations for sites in this extensions _admin folder and multi-langual store.

```
./_extension/_lang/
├── de.php (Translation File for German)
├── en.php (Translation File for English)
├── es.php (Translation File for Spanish)
├── fr.php (Translation File for French)
├── it.php (Translation File for Italian)
├── ja.php (Translation File for Japanese)
├── zh.php (Translation File for Chinese)
├── ... (Other language Files you may add)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Store your php code in this folder!

```
./_extension/_lib/
├── lib.example.php (Example Library File)
├── .. (Store your other library files here.)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Store your external licenses in this folder!

```
./_extension/_licenses/
├── example.lic (Example License File)
├── .. (Store your other License files here.)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Store your mysql tables in this folder!

```
./_extension/_mysql/
├── mysql.example.php (Example MySQL File for example table)
├── .. (Store your other mysql files here.)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Store your runtime files in this folder! (For the Background Linux Worker)

```
./_extension/_runtime/
├── run.example.php (Example runtime File)
├── .. (Store your other runtime files here.)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Theme files for your module.

```
./_extension/_theme/
├── ... (Content you may add)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Folder for Trigger files used by the Administrator Module.

```
./_extension/_trigger/
├── trigger.TRIGGERNAME.php (Example Trigger File for Trigger: TRIGGERNAME)
├── ... (Other Trigger Files)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Theme files for your module.

```
./_extension/_update/
├── 200.php (Example Update File to update to Build 200 from previous versions)
├── ... (Other Update Files)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Save Administrator View Injections in this folder.

```
./_extension/_view/
├── view.example.php (Example View Library File)
├── .. (Store your other WFC library files here.)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Store your wfc php classes code in this folder!

```
./_extension/_wfc/
├── wfc.example.php (Example WFC Library File)
├── .. (Store your other WFC library files here.)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Store your runtime worker files in this folder! (For the Background Linux Worker)

```
./_extension/_worker/
├── worker.example.php (Example runtime worker File)
├── .. (Store your other worker files here.)
├── index.php (Prevent Directory Listing)
├── README.md (Readme file with Folder Informations)
```

Files in the extensions root directory.
```
./_extension/
├── changelog.php (Changelog info)
├── index.php (Prevent Directory Listing)
├── LICENSE.md (Extensions License)
└── preview.jpg (Preview image)
├── README.md (Extensions Readme)
├── version.php (Versioning info)
```

## 📜 **License Information**

See the included License.md file for information about this projects license.

🐟 Bugfish <3