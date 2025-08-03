# Blog Management System (Laravel)

A simple Laravel project demonstrating manual Role-Based Access Control (RBAC) with two roles:

- **Admin**: Can create, edit, delete posts and add comments.
- **Editor**: Can only create and edit posts.

---

## Requirements

- PHP >= 8.3.6
- Composer  
- MySQL
- Laravel Framework 12.21.0

---

## Setup Instructions

1. Clone the repository:

    git clone https://github.com/zainadiab/Blog-Management-System-Laravel
    cd Blog-Management-System-Laravel

2. Install PHP dependencies:

    composer install

3. Create the `.env` file:

    cp .env.example .env

    Make sure in `.env` file that `SESSION_DRIVER=file` instead of session

4. Generate the application key:

    php artisan key:generate

5. Configure the database:

    5.1. Open the `.env` file and update these values to match your local MySQL setup:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=blog_db
    DB_USERNAME=root
    DB_PASSWORD=

    5.2. Ensure you have a MySQL user account with proper privileges:
        mysql -u root -p
        CREATE DATABASE blog_db;
        GRANT ALL PRIVILEGES ON blog_db.* TO 'root'@'localhost';
        FLUSH PRIVILEGES;
        EXIT;

 Make sure the database `blog_db` exists in your MySQL before continuing.

6. Run migrations and seeders to create tables and initial data:

    php artisan migrate --seed

    ***This will create all tables and insert initial test data including admin and editor users.

7. Serve the project locally:

    php artisan serve

8. Open your browser and go to:

    http://127.0.0.1:8000

---

## Login Credentials

Seeded users (created by the seeder), both use password: `password`:

- **Admin**  
  Email: admin@example.com 
  Password: password

- **Editor**  
  Email: editor@example.com 
  Password: password

---

## Project Structure

- `app/Models/Post.php` — Post model with relationships and validations  
- `app/Models/Comment.php` — Comment model with relationships and validations  
- `app/Http/Controllers/PostController.php` — Post CRUD logic with manual RBAC checks, pagination, and search filtering  
- `app/Http/Controllers/CommentController.php` — Handles AJAX comment submission and comment-related logic  
- `app/Http/Middleware/RoleMiddleware.php` — Middleware for role-based access control  
- `routes/web.php` — Web routes for posts, comments, authentication, and AJAX endpoints  
- `database/seeders/` — Seeders for users, posts, comments with roles and sample data  
- `resources/views/posts` — Blade views for UI, including post listing with pagination/search, post details with AJAX comments, edit post, add new post and auth forms.

---

## Notes

- Manual Role-Based Access Control is implemented by checking `auth()->user()->role` in controllers and/or middleware.  
- Post listing page includes pagination and search filters (title and author).  
- Comments are displayed under each post; new comments can be added via AJAX without page reload.  
- User registration and login are implemented for access control.  
- Validation rules are applied on posts and comments to ensure data integrity.

---

## Author

Zaina Eishan  
Mid-level PHP Developer — Laravel & CakePHP  
[https://www.linkedin.com/in/zaina-eishan/]  
[https://github.com/zainadiab]
