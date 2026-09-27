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

**1.** Create the database and the user:

```sql
CREATE DATABASE task_hub CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'taskhub'@'localhost' IDENTIFIED BY 'taskhub';
GRANT ALL PRIVILEGES ON task_hub.* TO 'taskhub'@'localhost';
```

**2.** `composer install` created `config/app_local.php` from the example file, so it still points
at a placeholder database. Open it and set `Datasources.default` to the values used above:

```php
'Datasources' => [
    'default' => [
        'host' => 'localhost',
        'username' => 'taskhub',
        'password' => 'taskhub',
        'database' => 'task_hub',
        // ...
    ],
],
```

**3.** Verify the connection - this prints a table of migrations, all marked `down`:

```bash
bin/cake migrations status
```

**4.** Run the migrations - they create the tables and seed the default avatars:

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

Open <http://localhost:8765>

## License

TaskHub is released under the [MIT License](LICENSE), © 2026 Mateusz Mleczko

Third-party front-end packages keep their own licenses. `npm run build` writes their notices to
`webroot/THIRD_PARTY_LICENSES.md` (Bootstrap, Popper, SortableJS) and `webroot/css/fonts/`
(Bootstrap Icons, Inter - SIL Open Font License 1.1).
