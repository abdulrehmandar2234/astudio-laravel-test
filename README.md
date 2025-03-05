# Astudio Laravel Test


## 📌 Setup Instructions

### Clone the Repository
Repo link https://github.com/abdulrehmandar2234/astudio-laravel-test

```sh
git clone git@github.com:abdulrehmandar2234/astudio-laravel-test.git
cd astudio-laravel-test
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

Database dump is located at `database/laraveltestapp.sql`

Postman collection is located at `database/astudio.postman_collection.json`

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

### **Attribute Endpoints**

#### **Create an Attribute**
**Endpoint:** `POST /api/attributes`

**Request Body:**
```json
{
  "name": "department",
  "type": "text"
}
```

**Response:**
```json
{
  "data": {
    "id": 1,
    "name": "department",
    "type": "text"
  }
}
```

---

#### **Get All Attributes**
**Endpoint:** `GET /api/attributes`

**Response:**
```json
[
  {
    "id": 1,
    "name": "department",
    "type": "text"
  },
  {
    "id": 2,
    "name": "start_date",
    "type": "date"
  }
]
```

---

#### **Update an Attribute**
**Endpoint:** `PUT /api/attributes/{id}`

**Request Body:**
```json
{
  "name": "budget",
  "type": "number"
}
```

**Response:**
```json
{
  "data": {
    "id": 1,
    "name": "budget",
    "type": "number"
  }
}
```

---

#### **Delete an Attribute**
**Endpoint:** `DELETE /api/attributes/{id}`

**Response:**
```json
{
  "message": "Attribute deleted successfully"
}
```

---
### **Timesheet Endpoints**

#### **Create a Timesheet Entry**
**Endpoint:** `POST /api/timesheets`

**Request Body:**
```json
{
  "user_id": 1,
  "project_id": 2,
  "task_name": "Backend Development",
  "date": "2025-03-04",
  "hours": 5
}
```

**Response:**
```json
{
  "data": {
    "id": 1,
    "user_id": 1,
    "project_id": 2,
    "task_name": "Backend Development",
    "date": "2025-03-04",
    "hours": 5
  }
}
```

---

#### **Get All Timesheets**
**Endpoint:** `GET /api/timesheets`

**Example Request:**
- `GET /api/timesheets`

---
**Response:**
```json
{
    "data": [
        {
            "id": 2,
            "task_name": "Development Task",
            "date": "2025-02-12",
            "hours": 7,
            "user_id": 1,
            "project_id": 2,
            "created_at": "2025-03-05T13:58:10.000000Z",
            "updated_at": "2025-03-05T13:58:10.000000Z",
            "user": {
                "id": 1,
                "first_name": "John",
                "last_name": "Doe",
                "email": "admin@example.com",
                "remember_token": null,
                "created_at": "2025-03-05T13:58:10.000000Z",
                "updated_at": "2025-03-05T13:58:10.000000Z"
            },
            "project": {
                "id": 2,
                "name": "Project B",
                "status": "Inactive",
                "created_at": "2025-03-05T13:58:10.000000Z",
                "updated_at": "2025-03-05T13:58:10.000000Z"
            }
        }
    ]
}
```
#### **Update a Timesheet**
**Endpoint:** `PUT /api/timesheets/{id}`

**Request Body:**
```json
{
  "task_name": "Frontend Development",
  "hours": 6
}
```

**Response:**
```json
{
  "data": {
    "id": 1,
    "task_name": "Frontend Development",
    "hours": 6
  }
}
```

---

#### **Delete a Timesheet**
**Endpoint:** `DELETE /api/timesheets/{id}`

**Response:**
```json
{
  "message": "Timesheet deleted successfully"
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

