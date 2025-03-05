# Installation

Here, you'll find step-by-step instructions to help you set up the software. Follow the provided resources to ensure a smooth installation process and get up and running in no time.

---------------

## Docker Installation

Visit the download section of this website and find the link to the Docker image page. There, you'll find detailed instructions and the image needed to set up the Docker instance. Installation is straightforward as our Docker setup uses a single container and can be deployed with just one console command—no need for Docker Compose. If no Docker image is available, Docker installation is not possible.

---------------

## Script Installation

In the repository's `_scripts` folder, you'll find an installation script designed to install the full version with all features on a root server. This script is intended for users who wish to utilize our advanced hosting functionality on a fresh system. It is recommended only for advanced users with their own servers and infrastructure. If there is no script available in the folder, script installation is not possible.

---------------

## Manual Installation

This section explains the manual installation process, which does not require Docker or a script. This is the default method for setting up the project, especially if Docker or script installation are not viable options. Follow the steps provided to manually install and configure the project on your server.

---------------

### Prerequisites

Before you begin the installation process, please ensure that your system meets the following requirements. Having these prerequisites in place will help ensure a smooth setup and proper functionality of the software. Double-check the necessary components, tools, and configurations before proceeding with the installation.

- Apache2 webserver with modules: `rewrite` (mandatory), `ssl` (optional), `deflate` (optional).
- MySQL: Version 5.7 or higher required. MySQL 8.0+ recommended for optimal performance.
- Ensure you are using PHP version 8.4.x or higher. Avoid using any lower versions. Compatibility with PHP 9 is untested.
- The following PHP modules are required: `curl`, `mysqli`, and `mbstring`. The website will prompt you to install any additional required modules if they are not already installed.
- A minimum of 1GB of available web space is recommended.

---------------

### Installation Steps

By following these steps, your installation will be ready to go!

1. **Download or Clone the Repository:**
	- Visit the download section of the website, where you’ll find the download links for the latest release or choose to clone the repository directly from there.

2. **Copy the Files:**
	- Navigate to the `/source` directory in the repository or extract the chosen release file.
	- Copy all files from the `/source` folder to your web server's public HTML directory, ensuring all the necessary project files are accessible by the server.

3. **Configure the Website:**
	- Open the website in your browser and follow the installation wizard.
	- The wizard will guide you through the initial setup, where you’ll configure the database, administrative user, and other required settings.
	- The database tables will be created automatically during the installation process, so there is no need to import anything manually.

4. **Set Up Cronjob:**
	- For the CMS to function properly, you’ll need to set up a cronjob to run `_cronjob/cronjob.php` every hour as the web server user (usually `www-data` or the user running your web server). This ensures scheduled tasks run correctly.

5. **(Optional) Set Up Background Worker:**
	- For enhanced features and root-level functionalities, you may set up a background worker. Detailed instructions for setting it up can be found below. This step is optional but recommended for projects requiring more robust background operations. Modules that require this functionality will include a note in the store and during installation in the CMS.

-----------------

### Background Worker

!!! warning "The following step is optional, but required if you want to use advanced CMS Functionalities which depend on root level access. You need full control to a VM or Root Server - otherwise you can ignore this option."

1. Login to your server using SSH
2. Execute the following command: 
```bash
apt install supervisor
```

3. Create the file `/etc/supervisor/conf.d/suitefish.conf` with following content: 
```bash
	[program:suitefish]
	command=/usr/bin/php /var/www/html/_core/worker.php
	user=root
	autostart=true
	autorestart=true
	stderr_logfile=/var/log/suitefish_error.log
	stdout_logfile=/var/log/suitefish_log.log
	startsecs=0
	environment=SUITEFISH_SUPERVISOR_LOG_FILE="/var/log/suitefish_log.log"	
```

4. Ensure that the path specified in the `suitefish.conf` file (`/var/www/html/_core/worker.php`) correctly points to the location where your SuiteFish CMS is installed. The `worker.php` file is located in the `_core` folder within the SuiteFish CMS directory on your web server.
5. Execute following commands to run the suitefish background worker:
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start suitefish
```

---------------

## Initial Login

!!! danger "For your security, change the default password immediately after your first login."

Once the installation is complete, you can log in using the default credentials provided below:

- **Username:** admin@admin.local
- **Password:** changeme

**Important:** To ensure the security of your account and system, it is strongly recommended to change the password right after your first login. Failing to do so may expose your system to potential security risks.

---------------

## Troubleshooting

!!! note "This issue should not occur during Docker installations, as the `settings.php` file is preconfigured and ready for use in that environment."

If the `installer.php` script fails to generate the `settings.php` file for any reason, you can manually create the `settings.php` file by using the `settings_sample.php` file located in the `_source` folder of this project. Simply rename the file from `settings_sample.php` to `settings.php` and make the necessary configuration changes.