<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Run Project Locally

1. Clone the repo to your preferred location (eg. C:\xampp\htdocs\myproject).
    ```
    git clone https://github.com/Abhishek-2502/BlogHub
    ```

2. Download and install [Xampp](https://www.apachefriends.org/download.html) and [Composer](https://getcomposer.org/download/)

    - Go to "C:\xampp\php\php.ini" and Search for ";extension=zip". Uncomment the line by removing the ; so it becomes "extension=zip"

3. Open VSCode in cloned Repo.

4. Run below to install PHP dependencies.
    ```
    composer install 
    ```

5. Run below to compile frontend assets.
    ```
    npm install  
    ```
    ```
    npm run dev
    ```

6. Start Apache and MySQL from XAMPP:

    - Open XAMPP Control Panel.

    - Click Start next to Apache and MySQL.

    - Make sure both are showing “Running” and if MySQL is creating problem, open Task Manager and terminate "mysqld.exe".

7. Create a new MySQL database using phpMyAdmin and name it "blogdb"
    ```
    http://localhost/phpmyadmin/
    ```

8. Set up your .env file:

    - Copy .env.example to .env.

    - Open .env and set your database credentials:
        ```
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=blogdb
        DB_USERNAME=root
        DB_PASSWORD=
        ```

9. Run below to create the database tables. 
    ```
    php artisan migrate
    ```

10. Run below to create a symbolic link for image uploads.
    ```
    php artisan storage:link
    ```

11. Run below 
    ```
    php artisan key:generate
    ```

12. Run below to start the Laravel development server.
    ```
    php artisan serve
    ```

13. Visit below to register a new user and begin creating posts.
    ```
    http://127.0.0.1:8000/register
    ```
---

## Run Project via Docker

1. Follow Step 8. 

2. Build and start all containers
    ```
    docker-compose up -d --build
    ```

3. Follow Step 13.

Stop all containers
```
docker-compose down
```

---

## Deployment

When Deploying change following things:

- **vite.config.js:** Put VM IP instead of localhost in hmr host
- **.env:** Put VM IP instead of localhost in APP_URL and VITE_DEV_SERVER_URL

Run below command on VM from BlogHub folder:
```
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

Add 8000 and 5173 in Security Group(AWS) or Firewall(GCP)

---

## Technical Stack

**Frontend**:

* HTML
* Tailwind CSS
* JavaScript (ES6+)
* Vite (Module Bundler)
* Laravel Vite Plugin
* Alpine.js

**Backend**:

* PHP 8.x
* Laravel
* MySQL

**DevOps/Tools**:


* Docker
* Docker Compose
* Apache (inside Docker)
* Composer (PHP Dependency Manager)
* Node.js & NPM (for frontend build)
* Jenkins
* AWS/GCP

---

## License
This project is licensed under the **MIT License** – see the [LICENSE](./LICENSE) file for details.

--- 

## Author 
Abhishek Rajput
