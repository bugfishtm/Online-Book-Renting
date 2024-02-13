# Cronjobs Files

DO NOT CHANGE FILES IN THAT FOLDER, THEY MAY GET OVERWRITTEN DURING CORE UPDATES!

This directory contains Cronjobs files responsible for executing various tasks. The files included here will trigger all cronjobs from site modules placed in the corresponding folders like `_cron/daily` or others.

**Usage:**
- Ensure that this directory is regularly scheduled in your server's crontab to execute the cronjobs.
- Modules should place their specific cronjobs in the appropriate folders (e.g., `_cron/daily`, `_cron/hourly`) for automatic execution.

**Important Notes:**
- Be cautious when modifying or adding cronjobs to avoid unintended consequences.
- Regularly check for updates or new cron tasks from site modules.

**Caution:**
- Ensure that server permissions and configurations allow the execution of cronjobs.
- Monitor log files for any errors generated during cron execution.