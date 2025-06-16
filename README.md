# Online-Book-Renting (OBR)

![Screenshot](./_images/_banner/obr-banner.jpg) 

## 🔍 Overview

> [!NOTE]
> No new features are planned for this project at this time.

> [!TIP]
> This project is actively maintained, with regular updates and prompt fixes for reported issues.

The Online-Book-Renting (obr) system allows you to manage books, display them on a public page, and enable users to rent or donate books.

![Screenshot](./_screenshots/site_book.png) 

### Features

#### Book Rental Management

| **Feature** | **Description** |
|-------------|-----------------|
| **Book Rental** | Rent books to users and set return deadlines. |
| **Deadline Tracking** | Monitor if users exceed return deadlines and manage necessary actions. |
| **Additional Information** | Add notes and user deposits for book security. |

#### ISBN API Connections

| **Feature** | **Description** |
|-------------|-----------------|
| **ISBN API** | Enable API connections to automatically retrieve and pre-fill book details. |

#### User Management

The software includes a powerful user management system, allowing administrators to create, manage, and organize users efficiently. This system helps ensure that user-related tasks are streamlined and secure.

#### Access Control

The software offers an advanced permission management system that allows you to define and control user access to specific features and resources. This helps maintain security and ensures that sensitive information is protected.

#### Multi-Language Support

This project supports multiple languages, including German, English, Spanish, Italian, French, Japanese, Chinese, Russian, Hindi, Portuguese, Korean, and Turkish. You can add new languages or modify existing text on the website by overriding translations.

#### Troubleshooting

The software comes with built-in debugging tools to help identify and resolve errors quickly. These features provide detailed logs and error reports, making it easier for developers to troubleshoot and enhance the software during the development process.

#### Powered by Suitefish

This project has been created with [Suitefish-CMS](https://github.com/bugfishtm/suitefish-cms). The Backend consists of a various set of Suitefish functionalities and the full included [Bugfish-Framework](https://github.com/bugfishtm/bugfish-framework).

## 🛠️ Installation 

### Setup Guide (Not using Docker)

For installation instructions, please refer to our documentation, which can be found in the "Documentation" section of this README. You can access the instructions online at [https://bugfishtm.github.io/Online-Book-Renting/installation.html](https://bugfishtm.github.io/Online-Book-Renting/installation.html) or locally at [./docs/installation.html](./docs/installation.html).

### Docker Quick Setup

To deploy the Docker image `bugfishtm/obr:latest` using a single command, you can use the following:

```bash
docker run -d --restart always -p 80:80 -p 443:443 -e sf_db_pass=your_password -e sf_url=your_url -e sf_timezone=Europe/Berlin -v obr_data:/var/www/html/_data -v obr_mysql:/var/lib/mysql bugfishtm/obr:latest
```

This command does the following:

- Runs the container in detached mode (`-d`)
- Set the startup policy to start always, so the container will not stop if the system performs a reboot.
- Maps ports 80 and 443 from the container to the host
- Sets required environment variables (`-e`)
- Creates and mounts volumes for persistent data (`-v`)
- Uses the `bugfishtm/obr:latest` image from Docker Hub

Replace `your_password`, `your_url`, and `your_timezone` with appropriate values. The volumes `obr_data` and `obr_mysql` will be created automatically if they don't exist.

|Variable|Description|
|-------|-------|
| sf_db_pass | MySQL root password for database to be created and used. |
| sf_url | Domain this service is running on. E.g http://localhost or https://localhost |
| sf_timezone | Timezone you want the service to run at. E.g Europe/Berlin. Use tz identifiers from https://en.wikipedia.org/wiki/List_of_tz_database_time_zones |

### Initial Login
Initial user account for the website after deployment:  
username: admin@admin.local  
password: changeme  

## 📖 Documentation

The following documentation is intended for both end-users and developers.


| **Description**                                                       | **Link**                                                                                         |
|----------------------------------------------------------------------|-------------------------------------------------------------------------------------------------|
| Access the online documentation for this project. | [https://bugfishtm.github.io/Online-Book-Renting/index.html](https://bugfishtm.github.io/Online-Book-Renting/index.html)  |
| If you'd prefer to access the documentation locally, you can find it at. | ./docs/index.html |

The following documentation is intended for developers.

| Description | Link  |
|----------------|----------------------------|
| Documentation for the integrated CMS - for developers.                                                                                              | [https://bugfishtm.github.io/suitefish-cms/](https://bugfishtm.github.io/suitefish-cms/)|
| Documentation for the integrated framework - for developers.                                                                                        | [https://bugfishtm.github.io/bugfish-framework/](https://bugfishtm.github.io/bugfish-framework/)  |

## ❓ Support Channels

If you encounter any issues or have questions while using this software, feel free to contact us:

- **GitHub Issues** is the main platform for reporting bugs, asking questions, or submitting feature requests: [https://github.com/bugfishtm/Online-Book-Renting/issues](https://github.com/bugfishtm/Online-Book-Renting/issues)
- **Discord Community** is available for live discussions, support, and connecting with other users: [Join us on Discord](https://discord.com/invite/xCj7AEMmye)  
- **Email support** is recommended only for urgent security-related issues: [security@bugfish.eu](mailto:security@bugfish.eu)

## 📢 Spread the Word

Help us grow by sharing this project with others! You can:  

* **Tweet about it** – Share your thoughts on [Twitter/X](https://twitter.com) and link us!  
* **Post on LinkedIn** – Let your professional network know about this project on [LinkedIn](https://www.linkedin.com).  
* **Share on Reddit** – Talk about it in relevant subreddits like [r/programming](https://www.reddit.com/r/programming/) or [r/opensource](https://www.reddit.com/r/opensource/).  
* **Tell Your Community** – Spread the word in Discord servers, Slack groups, and forums.  

## 📁 Repository Structure 

This table provides an overview of key files and folders related to the repository. Click on the links to access each file for more detailed information. If certain folders are missing from the repository, they are irrelevant to this project.

|Document Type|Description|
|----|-----|
| .github | Folder with github setup files. |
| [.github/CODE_OF_CONDUCT.md](./.github/CODE_OF_CONDUCT.md) | The community guidelines. |
| _changelogs | Folder for changelogs. |
| _docker | Folder to prepare docker images. |
| _images | Folder for project images. |
| _licenses | Folder for 3rd party licenses. |
| _releases | Folder for releases. |
| _screenshots | Folder with project screenshots. |
| _source | Folder with the source code. |
| docs | Folder for the documentation. | 
| .gitattributes | Repository setting file. Only for development purposes. |
| .gitignore | Repository ignore file. Only for development purposes. |
| README.md | Readme of this project. You are currently looking at this file. |
| repository_reset.bat | File to reset this repository. Only for development purposes. |
| repository_update.bat | File to update this repository. Only for development purposes. |
| [CONTRIBUTING.md](CONTRIBUTING.md) | Information for contributors. | 
| [CHANGELOG.md](CHANGELOG.md) | Information about changelogs. | 
| [SECURITY.md](SECURITY.md) | How to handle security issues. |
| [LICENSE.md](LICENSE.md) | License of this project. |

## 📑 Changelog Information

Refer to the `_changelogs` folder for detailed insights into the changes made across different versions. The changelogs are available in **HTML format** within this folder, providing a structured record of updates, modifications, and improvements over time. Additionally, **GitHub Releases** follow the same structure and also include these changelogs for easy reference.

## 🌱 Contributing to the Project

I am excited that you're considering contributing to our project! Here are some guidelines to help you get started.

**How to Contribute**

1. Fork the repository to create your own copy.
2. Create a new branch for your work (e.g., `feature/my-feature`).
3. Make your changes and ensure they work as expected.
4. Run tests to confirm everything is functioning correctly.
5. Commit your changes with a clear, concise message.
6. Push your branch to your forked repository.
7. Submit a pull request with a detailed description of your changes.
8. Reference any related issues or discussions in your pull request.

**Coding Style**

- Keep your code clean and well-organized.
- Add comments to explain complex logic or functions.
- Use meaningful and consistent variable and function names.
- Break down code into smaller, reusable functions and components.
- Follow proper indentation and formatting practices.
- Avoid code duplication by reusing existing functions or modules.
- Ensure your code is easily readable and maintainable by others.

## 🤝 Community Guidelines

We’re on a mission to create groundbreaking solutions, pushing the boundaries of technology. By being here, you’re an integral part of that journey. 

**Positive Guidelines:**
- Be kind, empathetic, and respectful in all interactions.
- Engage thoughtfully, offering constructive, solution-oriented feedback.
- Foster an environment of collaboration, support, and mutual respect.

**Unacceptable Behavior:**
- Harassment, hate speech, or offensive language.
- Personal attacks, discrimination, or any form of bullying.
- Sharing private or sensitive information without explicit consent.

Let’s collaborate, inspire one another, and build something extraordinary together!

## 🛡️ Warranty and Security

I take security seriously and appreciate responsible disclosure. If you discover a vulnerability, please follow these steps:

- **Do not** report it via public GitHub issues or discussions. Instead, please contact the [security@bugfish.eu](mailto:security@bugfish.eu) email address directly.   
- Provide as much detail as possible, including a description of the issue, steps to reproduce it, and its potential impact.  

I aim to acknowledge reports within **2–4 weeks** and will update you on our progress once the issue is verified and addressed.

This software is provided as-is, without any guarantees of security, reliability, or fitness for any particular purpose. We do not take responsibility for any damage, data loss, security breaches, or other issues that may arise from using this software. By using this software, you agree that We are not liable for any direct, indirect, incidental, or consequential damages. Use it at your own risk.

## 📜 License Information

The license for this software can be found in the [LICENSE.md](LICENSE.md) file. Third-party licenses are located in the ./_licenses folder. The software may also include additional licensed software or libraries.

🐟 Bugfish 
