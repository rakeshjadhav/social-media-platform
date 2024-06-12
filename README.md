# Social Media Platform API Documentation

## User Registration Endpoint

### Endpoint

**URL:** `http://127.0.0.1:8000/api/v1/oauth/register`  
**Method:** `POST`  
**Content-Type:** `application/json`

### Request Body

The request body must be in JSON format and contain the following fields:

- `name` (string): The full name of the user.
- `email` (string): The email address of the user.
- `password` (string): The password for the user account.

#### Example Request Body

```json
{
    "name": "Rakesh Ramesh Jadhav",
    "email": "rakeshjadhav939881@gmail.com",
    "password": "Test123456"
}


## User Login Endpoint

### Endpoint

**URL:** `http://localhost:8000/api/v1/oauth/login`  
**Method:** `POST`  
**Content-Type:** `application/json`

### Request Body

The request body must be in JSON format and contain the following fields:


- `username` (string): The email address of the user.
- `password` (string): The password for the user account.
- `grant_type`: `password`,
-  `client_id`: `9c4378bc-2b50-4817-b1a2-c64929ce30e0`,
-  `client_secret`: ``,
 - `scope`: `*`

#### Example Request Body

```json
{
  "result": {
    "id": "e8ce3f66-52ee-4faa-96cc-0393e18795bb",
    "name": "Rakesh Ramesh Jadhav",
    "email": "rakeshjadhav939881@gmail.com",
    "email_verified_at": null,
    "status": "active",
    "created_at": "2024-06-12T02:53:15.000000Z",
    "updated_at": "2024-06-12T02:53:15.000000Z",
    "deleted_at": null,
    "token_type": "Bearer",
    "expires_in": 31536000,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...................",
    "refresh_token": "def502004a71aa------2"
  }
}


