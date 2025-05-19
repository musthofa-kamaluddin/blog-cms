# Simple PHP Blog CMS

A modern blog Content Management System (CMS) built with PHP and MySQL, featuring a sleek and responsive UI powered by Tailwind CSS. Admins can create, edit, and delete posts through a secure dashboard, while visitors enjoy a visually appealing interface to view posts.

## Features
- **Post Management**: Create, edit, and delete blog posts via an intuitive admin dashboard.
- **Public Interface**: Displays posts in a dynamic grid with a detailed view for each post.
- **Admin Authentication**: Secure login system for content management.
- **Modern UI**: Responsive design with animations, hover effects, and clean typography using Tailwind CSS.
- **MySQL Database**: Reliable storage for posts and user data.

## Requirements
- PHP 8.x
- MySQL
- Web server (e.g., XAMPP with MySQL enabled)
- No external PHP dependencies (Tailwind CSS loaded via CDN)

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/musthofa-kamaluddin/blog-cms.git
   ```
2. Navigate to the project directory:
   ```bash
   cd blog-cms
   ```
3. Start XAMPP and ensure MySQL is running.
4. Import the database schema:
   ```bash
   mysql -u root -p < sql/init.sql
   ```
5. Update MySQL credentials in `includes/config.php` if necessary (default: user `root`, no password).
6. Copy the project to XAMPP's `htdocs` directory (e.g., `D:\XAMPP2\htdocs\blog-cms`).
7. Access the blog at `http://localhost/blog-cms/public` and the admin panel at `http://localhost/blog-cms/public/admin/login.php`.

## Default Credentials
- **Username**: admin
- **Password**: admin123

**Important**: Change the password in `includes/config.php` for production use.

## Directory Structure
```
blog-cms/
├── includes/             # Configuration and helper files
├── public/               # Public-facing files
│   ├── admin/            # Admin panel files
│   └── assets/           # CSS and other assets
├── sql/                  # Database initialization script
├── .gitignore            # Git ignore file
├── README.md             # Project documentation
└── requirements.txt      # Dependency instructions
```

## Usage
- **Public**: Visit `public/index.php` to see all posts or `public/post.php?id=X` for a specific post.
- **Admin**: Log in at `public/admin/login.php` to manage posts. Use the dashboard to add, edit, or delete posts.

## Contributing
1. Fork the repository.
2. Create a new branch: `git checkout -b feature-name`.
3. Make your changes and commit: `git commit -m "Add feature"`.
4. Push to your branch: `git push origin feature-name`.
5. Create a pull request.

Suggestions for contributions:
- Add categories or tags for posts.
- Implement a comment system.
- Add image uploads for posts.

## License
MIT License

## Contact
For questions, open an issue
