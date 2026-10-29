# COS340: PHP MVC Exercises

Exercises for **COS340 – Open-Source Software Development**: a minimal MVC framework in plain PHP with a front controller and URL routing, used to build a product CRUD.

- `index.php` routes `/<controller>/<action>/<params>` to `app/controllers/<Controller>Controller.php`.
- `ProductController` lists, adds, edits and deletes products (stored in the PHP session, no database yet).
- Views live in `app/views/product/`.

## Running

Serve the folder with Apache and `mod_rewrite` (e.g. XAMPP) at `http://localhost/project1/`. If you use a different path, change `RewriteBase` in `.htaccess`. Then open `/product/list`.
