# Store Management System - Laravel

## Project Description

Adidas is introducing an internal authentication and management system. This system provides an interface for administrators and sellers to efficiently manage products, categories, clients, and sales. The goal is to maintain a high level of customer service quality.

## Key Features

### CRUD for Entities
- **Categories**: Create, update, and delete categories.
- **Products**: Manage products with details such as name, description, price, images, tags.
- **Clients (Bonus)**: Manage client information like name, email, credit card, address.
- **Sales Management (Bonus)**: View and update the status of customer orders.

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
