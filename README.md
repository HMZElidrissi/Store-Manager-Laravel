# Store Management System - Laravel

## Project Description
This system provides an interface for administrators and sellers to efficiently manage products, categories, clients, and sales. Also a system to manage permissions for each type of user is implemented.

## Key Features

### CRUD for Entities
- **Categories**: Create, update, and delete categories.
- **Products**: Manage products with details such as name, description, price, images, tags.
- **Clients**: Manage client information like name, email, credit card, address.
- **Sales Management**: View and update the status of customer orders.

### Authentication
- Implementation of a custom Laravel authentication system.
- Features include account creation, login, logout, and password recovery via email.

### Pagination
- Intuitive pagination for products, categories, etc.

### Search
- Search functionality for products and categories.

### Filters
- Filters for navigating product lists (category, price, availability).

### Route and Permission Management
- CRUD for permission management.
- Automatic generation of permissions from routes (Bonus).

## Important Instructions

### Authentication and Authorization
- Custom authentication and authorization system without external packages.
- Role and permission management using Laravel.

### Email Password Recovery
- Feature implemented using a dedicated email service.

## Best Practices

### Services
- Use of dedicated services for specific tasks (email sending).

### Request Validation
- Ensuring data security and integrity in forms.

### Policies
- Managing authorization at the action and resource level.

## Installation

Follow these steps to install the project:
1. Clone the repository: `git clone https://github.com/HMZElidrissi/Store-Manager-Laravel.git`
2. Install the dependencies: `composer install`
3. Create a `.env` file: `cp .env.example .env`
4. Generate the application key: `php artisan key:generate`
5. Create a database and update the `.env` file with the database credentials.
6. Run the migrations: `php artisan migrate --seed`
7. Generate the storage link: `php artisan storage:link`
8. Generate permissions: `php artisan generate:permissions`
9. Serve the application: `php artisan serve`
