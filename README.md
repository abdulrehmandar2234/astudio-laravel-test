# Project Management API

## About This API
The **Project Management API** is a Laravel-based application that enables project creation, attribute management, and dynamic filtering using an Entity-Attribute-Value (EAV) system. This API supports project tracking, flexible attribute assignment, and efficient querying.

---

## 📌 Setup Instructions

### Clone the Repository
```sh
git clone https://github.com/your-repo/project-management-api.git
cd project-management-api
```

### Install Dependencies
```sh
composer install
```

### Configure Environment
Copy `.env.example` to `.env` and update database settings:
```sh
cp .env.example .env
```
Set up database credentials in `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laraveltestapp
DB_USERNAME=root
DB_PASSWORD=
```

### Run Migrations & Seed Database
```sh
php artisan migrate --seed
```

### Start the Server
```sh
php artisan serve
```
Your API will be available at `http://127.0.0.1:8000`

---

## 📖 API Documentation

### Authentication

#### Register a New User
**Endpoint:** `POST /api/register`

**Request Body:**
```json
{
  "first_name": "John",
  "last_name": "Doe",
  "email": "johndoe@example.com",
  "password": "securepassword",
  "password_confirmation": "securepassword"
}
```

**Response:**
```json
{
  "token": "your-auth-token"
}
```

#### Login
**Endpoint:** `POST /api/login`

**Request Body:**
```json
{
  "email": "johndoe@example.com",
  "password": "securepassword"
}
```

**Response:**
```json
{
  "token": "your-auth-token"
}
```

#### Logout
**Endpoint:** `POST /api/logout`

**Response:**
```json
{
  "message": "You have been successfully logged out!"
}
```

---

### User Crud

#### Get All Users
**Endpoint:** `GET /api/users`

**Response:**
```json
[
  {
    "id": 1,
    "first_name": "John",
    "last_name": "Doe",
    "email": "johndoe@example.com"
  }
]
```

#### Get a Single User
**Endpoint:** `GET /api/users/{id}`

**Response:**
```json
{
  "id": 1,
  "first_name": "John",
  "last_name": "Doe",
  "email": "johndoe@example.com"
}
```
#### Create User
**Endpoint:** `POST /api/users}`

**Request Body:**
```json
{
    "first_name": "John",
    "last_name": "Doe",
    "email": "johndoe@example.com",
    "password": "securepassword",
    "password_confirmation": "securepassword"
}
```

**Response:**
```json
{
  "data": {
    "id": 1,
    "first_name": "Jane",
    "last_name": "Doe",
    "email": "johndoe@example.com"
  }
}
```

#### Update User
**Endpoint:** `PUT /api/users/{id}`

**Request Body:**
```json
{
  "first_name": "Jane",
  "last_name": "Doe"
}
```

**Response:**
```json
{
  "data": {
    "id": 1,
    "first_name": "Jane",
    "last_name": "Doe",
    "email": "johndoe@example.com"
  }
}
```

#### Delete a User
**Endpoint:** `DELETE /api/users/{id}`

**Response:**
```json
{
  "message": "User deleted successfully"
}
```

---

### Get All Projects
**Endpoint:** `GET /api/projects`

**Example Response:**
```json
[
  {
    "id": 1,
    "name": "Project A",
    "status": "Active",
    "attributes": [
      { "name": "department", "value": "IT" },
      { "name": "start_date", "value": "2025-03-01" },
      { "name": "budget", "value": "50000" }
    ]
  }
]
```

### Filter Projects
**Endpoint:** `GET /api/projects?filters[field]=value`

**Example Requests:**
- `GET /api/projects?filters[name]=ProjectA`
- `GET /api/projects?filters[department]=IT`
- `GET /api/projects?filters[budget|>]=60000`

**Response:** Filtered project list.

### Create a New Project with Attributes
**Endpoint:** `POST /api/projects`

**Request Body:**
```json
{
  "name": "Project C",
  "status": "Active",
  "attributes": {
    "1": "Finance",
    "2": "2025-06-10",
    "3": "90000"
  }
}
```

**Response:**
```json
{
  "id": 3,
  "name": "Project C",
  "status": "Active",
  "attributes": [
    { "name": "department", "value": "Finance" },
    { "name": "start_date", "value": "2025-06-10" },
    { "name": "budget", "value": "90000" }
  ]
}
```

### Update Project Attributes
**Endpoint:** `PUT /api/projects/{id}`

**Request Body:**
```json
{
  "attributes": {
    "1": "Marketing",
    "3": "100000"
  }
}
```

**Response:** Updated project data.

### Delete a Project
**Endpoint:** `DELETE /api/projects/{id}`

**Response:**
```json
{
  "message": "Project deleted successfully"
}
```

---

## 🛠 Test Credentials

Use these test credentials to log in if authentication is implemented:

**User:**
```
Email: admin@example.com
Password: password
```

---

Happy Coding! 🚀

