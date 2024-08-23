# Online Book Renting (OBR)

Welcome to the Online Book Renting (OBR) Web Software documentation. OBR is a comprehensive platform for managing and renting books online. The software provides a seamless experience for both administrators and users, offering various features to manage books, rentals, users, and more.

## General Information

OBR is your premier destination for book rentals online. With an extensive catalog of literary treasures, OBR caters to every reader's taste. Our sophisticated web software offers a seamless browsing experience, making it easy to discover your next literary adventure. Join the OBR community today and explore a world of boundless literary exploration.

![Bugfish Framework](./bugfish-framework-banner.jpg)
![Bugfish CMS](./bugfish-cms-banner.jpg)

**Developed with Bugfish CMS and Bugfish Framework!**

## Features

### Book Management

- Manage books with detailed information.
- Display books on a public page for users to view and rent.
- Manage book quantities and stock.
- ISBN numbers are consistent across quantities; each individual book has a unique barcode.

### Book Renting Management

- Rent books to users and associate books with user accounts.
- No online booking system—users must visit your location to borrow books.
- Record rental transactions, including return dates, notes, and deposit information.

### User and Permission Management

- Two types of users: Administrators and Default Users.
- Administrators manage all sections, while Default Users can request and donate books.
- Guests (non-logged-in users) can view all books.

### ISBN API Connections

- Automatically fetch book details using ISBN API when adding new books.

### Multi-Language Support

- Add new language files and set default language in the interface.
- Support for per-user language settings.

## Requirements

- Webserver with Apache2
- Apache2 modules: `rewrite`, `ssl`
- MySQL database access (remote or local)
- PHP 8 with `curl`, `mysqli`, and `mbstring` modules
- Recommended: 1GB webspace

## Default Login for Web Interface

> **Important:** Change the initial password after your first login.

- **Username:** admin
- **Password:** changeme
