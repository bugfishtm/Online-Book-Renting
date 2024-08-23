# Installation

## Prerequisites

Before you begin the installation, ensure you have the following:

- A web server running Apache2.
- Apache2 modules: `rewrite`, `ssl`.
- Access to a MySQL database (remote or local).
- PHP 8 installed with `curl`, `mysqli`, and `mbstring` modules.
- At least 1GB of available webspace.

## Installation Steps

1. **Download/Clone the Repository:**
	- You can download the repository as a ZIP file or clone it using Git:
	- [Download OBR](https://github.com/bugfishtm/Online-Book-Renting/archive/refs/heads/main.zip)
	- `git clone https://github.com/bugfishtm/Online-Book-Renting.git`

2. **Copy Files:**
	- Navigate to the `/source` directory within the repository.
	- Copy all files from the `/source` directory to your website's document root.

3. **Configure the Website:**
	- Access the website through your browser.
	- Follow the on-screen installation instructions to complete the setup.

## Post-Installation

After installation, log in with the default credentials:

- **Username:** admin
- **Password:** changeme

**Note:** Change the default password immediately after your first login.

## Troubleshooting

- Ensure all required Apache and PHP modules are installed and enabled.
- Verify database credentials during the setup process.
