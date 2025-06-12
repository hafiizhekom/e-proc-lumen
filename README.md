# E-Proc Lumen

E-Proc Lumen is a backend application built with Lumen (a micro-framework by Laravel) designed for developing e-procurement systems (electronic goods/services procurement). This project provides APIs for tender processes, user management, and other procurement-related features.

## Main Features

- User authentication (login & register)
- Tender management and procurement details
- Modular structure and easy to extend
- Integration with GitLab CI/CD for automatic deployment

## Installation

### Prerequisites

- PHP >= 7.3
- Composer
- MySQL/MariaDB Database

### Installation Steps

1. Clone this repository:
    ```sh
    git clone https://gitlab.com/hafiizhekom-commercial-project/e-proc-lumen.git
    cd e-proc-lumen
    ```

2. Install dependencies:
    ```sh
    composer install
    ```

3. Copy the environment file:
    ```sh
    cp .env.example .env
    ```

4. Configure your database settings in the `.env` file.

5. Generate the application key (if needed):
    ```sh
    php artisan key:generate
    ```

6. Run database migrations:
    ```sh
    php artisan migrate
    ```

7. Start the application:
    ```sh
    php -S localhost:8000 -t public
    ```
