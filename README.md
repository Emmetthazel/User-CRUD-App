# Simple User CRUD App

A simple web application built with Laravel for managing users and their tasks.

## Features

- User Authentication (Register, Login, Logout)
- User Profile Management (Update Profile, Change Password)
- Task Management (CRUD operations for tasks)
- Tasks with Due Dates
- Filter tasks by status (All, Pending, Completed)
- Sort tasks by creation date, due date, or title
- Pagination for the task list
- Responsive UI with Bootstrap 5

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP >= 8.1
- Composer
- Node.js & npm (or Yarn)
- A database (MySQL, PostgreSQL, SQLite, etc.)

## Installation

1.  **Clone the repository:**

    ```bash
    git clone <repository_url>
    cd Simple\ User\ CRUD\ App
    ```

2.  **Install PHP dependencies:**

    ```bash
    composer install
    ```

3.  **Install Node dependencies:**

    ```bash
    npm install
    # or yarn install
    ```

4.  **Copy the environment file:**

    ```bash
    cp .env.example .env
    ```

5.  **Generate an application key:**

    ```bash
    php artisan key:generate
    ```

6.  **Configure your database:**
    Open the `.env` file and update the database connection details:

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    ```

7.  **Run database migrations:**

    ```bash
    php artisan migrate
    ```

8. **Build assets (optional, but recommended):**

    ```bash
    npm run dev
    # or yarn dev
    ```
    For production:
    ```bash
    npm run build
    # or yarn build
    ```

## Running the Application

To run the development server, execute the following command:

```bash
php artisan serve
```

The application will be available at `http://127.0.0.1:8000`.

## Contributing

Mention how others can contribute to the project (Optional).

## License

Specify the project's license (Optional).
