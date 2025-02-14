# Installation

## Prerequisites

Before you begin the installation, ensure you have the following:

- Apache2 webserver recommended.
- Apache2 modules: `rewrite` (mandatory), `ssl` (optional), `deflate` (optional).
- MySQL: Version 5.7 or higher required. MySQL 8.0+ recommended for optimal performance.
- At least PHP 8.4.x, do not use lower version of php.
- Untested for PHP9
- curl, mysqli, and mbstring modules.
- Website will ask you for other required modules if necessary and not installed.
- At least 1GB of available webspace recommended.

## Installation Steps

1. **Download/Clone the Repository:**
	- You can download the repository as a ZIP file or clone it using Git.
```markdown
git clone https://github.com/bugfishtm/Online-Book-Renting.git`
```

2. **Copy Files:**
	- Navigate to the `/source` directory within the repository or in the choosen release.
	- Copy all files from the `/source` directory to your website's public html folder.

3. **Configure the Website:**
	- Access the website through your browser.
	- Follow the on-screen installation instructions to complete the setup.

4. (recommended) **Setup Cronjob:**  
	- Setup a cronjob on your server to run the file cronjob.php hourly as the website user (usually www-data).