📌 Project Overview
A robust, full-stack Event Management System built to bridge the gap between organizers and attendees. The platform features a specialized Administrative Authorization Terminal that ensures only verified organizers can host events, maintaining high security and data integrity.

🚀 Key Features
Three-Tier Role System: Distinct dashboards and permissions for Admins, Organizers, and Customers.

Security Clearance Terminal: A "Root" level admin panel to authorize or revoke organizer credentials in real-time.

Live Booking Engine: Automated ticket counting, RSVP management, and instant booking confirmations.

Interactive Guest Lists: Organizers can monitor attendee data and manage event capacity dynamically.

Modern UI/UX: Developed with Tailwind CSS for a high-performance, responsive "Command Center" aesthetic.

🛠️ Tech Stack
Backend: PHP 8.4 / Laravel 13.2 (Eloquent ORM, Blade Templating)

Frontend: React.js / Tailwind CSS / Blade

Database: MySQL (Relational Schema with Foreign Key Constraints)

Authentication: Laravel Breeze / Custom Middleware for Security Clearances

📸 System Architecture
The system follows the MVC (Model-View-Controller) pattern to ensure clean code separation and scalability.

🔧 Installation & Setup
Clone the repo: git clone https://github.com/yourusername/event-system.git

Install dependencies: composer install && npm install

Configure .env: Set up your MySQL database credentials.

Run Migrations & Seeders:

Bash
php artisan migrate:fresh --seed
Launch: php artisan serve