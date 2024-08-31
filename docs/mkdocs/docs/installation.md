# Installation

## Prerequisites

Before you begin the installation, ensure you have the following:

- Apache2 webserver recommended. (To check compatibility with nginx check the main platforms documentation site of [bugfishCMS](https://bugfishtm.github.io/bugfish-cms).)
- Apache2 modules: `rewrite`, `ssl`.
- Access to a MySQL database (remote or local).
- PHP 8 installed with `curl`, `mysqli`, and `mbstring` modules. Website will ask you for other required modules if necessary and not installed.
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


## Initial Login

!!! danger "Change the default password immediately after your first login."

After installation, log in with the default credentials:

- **Username:** admin
- **Password:** changeme
