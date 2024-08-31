# Online-Book-Renting (obr)

The Online-Book-Renting (obr) system allows you to manage books, display them on a public page, and enable users to rent or donate books.

## Documentation

To access documentation:

| **Source** | **Description** |
|------------|-----------------|
| **In Repository** | Look inside the `docs` folder for README and license information. Open `index.html` in a web browser (e.g., drag and drop). |
| **Online Documentation** | [Online-Book-Renting Documentation](https://bugfishtm.github.io/Online-Book-Renting/) |

Additional documentation:

| **Resource** | **Description** | **Link** |
|--------------|-----------------|----------|
| BugfishCMS | Documentation for the OBR Platform | [BugfishCMS Documentation](https://bugfishtm.github.io/bugfish-cms/) |
| Bugfish Framework | Documentation for the Bugfish Framework | [Bugfish Framework Documentation](https://bugfishtm.github.io/bugfish-framework/) |

## Features

### Book Rental Management

| **Feature** | **Description** |
|-------------|-----------------|
| **Book Rental** | Rent books to users and set return deadlines. |
| **Deadline Tracking** | Monitor if users exceed return deadlines and manage necessary actions. |
| **Additional Information** | Add notes and user deposits for book security. |

### User and Permission Management

| **Role** | **Permissions** |
|----------|-----------------|
| **Administrator Users** | Access and manage all admin-related sections of the library. |
| **Default Users** | Request and donate books, view available books. |
| **Guests** | View the entire collection of books without logging in. |

### ISBN API Connections

| **Feature** | **Description** |
|-------------|-----------------|
| **ISBN API** | Enable API connections to automatically retrieve and pre-fill book details. |

### Multi-Language Support

| **Feature** | **Description** |
|-------------|-----------------|
| **Language Files** | Add new language files and adjust default language settings. |
| **User Preferences** | Allow users to select their preferred language. |

## Installation

For installation and setup instructions, refer to the `docs` folder. The documentation provides a step-by-step guide for installation.

## Docker

There may be a Docker image available for this project on my Docker Hub account:
[Docker Hub - bugfishtm](https://hub.docker.com/u/bugfishtm)

Please check the page to see if a suitable image for this project has been published. If available, it will provide a convenient way to get started with a pre-configured environment.

## Repository Structure

| **Folder** | **Description** |
|------------|-----------------|
| `.github` | Contains sponsorship-related files. |
| `_source` | Source code for deploying the web application. |
| `docs` | Comprehensive documentation for the project. |
| `_releases` | Software releases. |
| `_images` | Images for README and project information. |
| `_changelogs` | Versioning changelogs. |
| `_licenses` | Licenses for 3rd party libraries included in the project. |

## Project Code Location

The project is delivered as a site module named "obr" within a CMS. The code can be found in the `_site` folder of the website.

## 3rd Party Libraries

Various 3rd party libraries (e.g., jQuery) are used in this project. All external libraries and their licenses are located in the `/_core/_vendor` folder. The project utilizes the Bugfish Framework and Bugfish Backend CMS. See this repositories _licenses folder to view included licenses of libraries.

## License

For licensing information, please refer to the `license.md` file located in this repository.