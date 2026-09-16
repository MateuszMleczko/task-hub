# TaskHub

A simple kanban task board with user accounts, avatars and password reset via e-mail.
Backend: CakePHP 5. Frontend: custom SCSS on top of Bootstrap 5, built with Vite.

## Requirements

- PHP >= 8.2 with `intl`, `mbstring`, `pdo_mysql`
- Composer
- MySQL 8 (or MariaDB)
- Node.js >= 20 and npm

## Installation

```bash
git clone https://github.com/MateuszMleczko/task-hub.git
cd task-hub

# 1. PHP dependencies - also creates config/app_local.php with a random salt
composer install

# 2. JS dependencies + CSS/JS build into webroot/
npm install
npm run build
```

### Database

```sql
CREATE DATABASE task_hub CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'taskhub'@'localhost' IDENTIFIED BY 'taskhub';
GRANT ALL PRIVILEGES ON task_hub.* TO 'taskhub'@'localhost';
```

Set the connection details in `config/app_local.php` (`Datasources.default`: `username`, `password`, `database`),
then run the migrations - they create the tables and seed the default avatars:

```bash
bin/cake migrations migrate
```

### E-mail

Password reset ("Forgot your password?") needs a working SMTP transport - without it the reset link is never sent.
Configure `EmailTransport.default` in `config/app_local.php`; for local testing use for example: mailpit, smtp4dev or MailHog:

```php
'EmailTransport' => [
    'default' => [
        'className' => 'Smtp',
        'host' => 'localhost',
        'port' => 1025,
    ],
],
'emails' => [
    'mailerFromEmail' => 'noreply@taskhub.local',
],
```

## Running

```bash
bin/cake server -p 8765
```

Open <http://localhost:8765>. The UI language (pl/en) follows the browser's `Accept-Language` header.
