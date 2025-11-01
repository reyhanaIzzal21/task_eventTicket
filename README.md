<div align="center">

# 🎫 Event Ticket

### Simple, Modern, and Lightweight Event Ticketing System

[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D7.4-8892BF?style=for-the-badge&logo=php)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7+-00758F?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-MIT-gold?style=for-the-badge)](LICENSE)

*Built with plain PHP — Perfect for education, prototypes, or school/campus projects*

[Features](#-features) • [Installation](#-installation) • [Documentation](#-documentation) • [Team](#-team)

</div>

---

## 🌟 Overview

**Event Ticket** is a comprehensive event management and ticketing system built with native PHP, designed to be simple yet powerful. This application facilitates event creation, ticket sales, and QR code-based validation — all without the complexity of heavy frameworks.

### 🎯 Purpose

- 📚 Educational tool for learning PHP and web development
- 🚀 Quick prototyping for event management systems
- 🎓 Perfect for school/campus projects and demonstrations
- 🔧 Easily customizable and extendable codebase

---

## ✨ Features

<table>
<tr>
<td width="50%">

### 👥 User Management
- **Dual Role System** (Admin & User)
- Session-based authentication
- Secure login & registration
- User profile management

### 🎪 Event Management
- Full CRUD operations for events
- Workshop details (title, slug, thumbnail)
- Venue & capacity management
- Dynamic pricing system

</td>
<td width="50%">

### 🎟️ Booking & Ticketing
- Seamless ticket booking flow
- Transaction tracking (booking_trx_id)
- QR code generation for tickets
- Real-time availability check

### 🔍 Validation System
- QR code scanner integration
- Instant ticket verification
- Valid/Invalid status display
- Admin validation dashboard

</td>
</tr>
</table>

---

## 🛠️ Tech Stack

```
Backend  ⚡ PHP (Native) - No framework dependencies
Database 💾 MySQL / MariaDB - Reliable data storage
Frontend 🎨 HTML5, CSS3, Bootstrap - Responsive design
Scripts  ⚙️ Vanilla JavaScript - Lightweight & fast
QR Code  📱 PHP/JS Libraries - Seamless generation & scanning
Tools    🔧 Composer (optional), Git
```

---

## 🚀 Installation

### Prerequisites

- PHP >= 7.4
- MySQL >= 5.7 or MariaDB
- Web server (Apache/Nginx) or PHP built-in server
- Composer (optional)

### Step 1: Clone Repository

```bash
git clone https://github.com/reyhanaIzzal21/task_eventTicket.git
cd task_eventTicket
```

### Step 2: Database Setup

Create a new database:

```sql
CREATE DATABASE event_ticket_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Import the SQL file:

```bash
mysql -u root -p db_event_ticket < database/event-ticket.sql
```

### Step 3: Configuration

Edit database credentials in `config/db.php`:

```php
<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'event_ticket_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');
```

### Step 4: Run Application

```bash
php -S localhost:8000
```

Then visit: `http://localhost:8000`

### Step 5: Login

Use default credentials from SQL seeder or create admin account:

```
Admin Access:
- Username: admin
- Password: (check SQL file)

Or register new account and set role='admin' in database
```

---

## 📁 Project Structure

```
event-ticket/
│
├── 📂 app/
│   ├── Controllers/      # Business logic & request handling
│   ├── Models/           # Database models & queries
│   └── Views/            # HTML templates & UI components
│       └── bookings/
│           └── widgets/  # Ticket validation views
│
├── 📂 assets/
│   ├── css/              # Stylesheets (modern theme)
│   ├── js/               # JavaScript files
│   └── images/           # Media assets & uploads
│
├── 📂 config/
│   └── db.php            # Database configuration
│
├── 📂 database/
│   └── event-ticket.sql  # Database structure & seeders
│
├── 📂 storage/           # Uploaded files & generated QR codes
│
├── 📂 public/            # Public assets & entry point
│
└── 📄 README.md          # You are here!
```

---

## 🎨 Feature Highlights

### 🖼️ Modern UI Design

- **Color Palette**: blue, White, blue theme
- **Responsive Grid**: Bootstrap-powered layout
- **Clean Typography**: Professional and readable
- **Smooth Animations**: Enhanced user experience

### 🔐 Security Features

- SQL injection prevention
- XSS protection
- Secure session management

### 📊 Admin Dashboard

- Event statistics overview
- Booking management interface
- Ticket validation history
- User activity monitoring

### 📱 QR Code System

- Automatic QR generation on booking
- Mobile-friendly scanner interface
- Instant validation feedback
- Invalid ticket detection

---

## 👥 Team

<table align="center" width="100%">
<tr align="center" width="100%">
<td align="center" width="25%">
<b>Reyhana Izzal.M</b><br />
<sub>Project Manager</sub><br />
</td>
<td align="center" width="25%">
<b>Yoga Andri.S</b><br />
<sub>System Analyst</sub><br />
</td>
<td align="center" width="25%">
<b>Izza Rahmatullah</b><br />
<sub>Backend Developer</sub><br />
</td>
<td align="center" width="25%">
<b>Dhama Giovanny</b><br />
<sub>Backend Developer</sub>
</td>
</tr>
</table>

<table align="center" width="100%">
<tr align="center" width="100%">
<td align="center" width="33%">
<b>Andrean Anggara.P</b><br />
<sub>Frontend Developer</sub>
</td>
<td align="center" width="33%">
<b>Ayub Raditia.W</b><br />
<sub>Frontend Developer</sub><br />
</td>
<td align="center" width="33%">
<b>Vicky Ade Reza.S</b><br />
<sub>QA Engineer</sub><br />
</td>
</tr>
</table>

---

## 💡 Tips & Best Practices

### 🎨 Customization

- CSS variables in `assets/css/variables.css` for easy theming
- Consistent naming conventions across JS/PHP
- Modular component structure for reusability

### 🚀 Future Enhancements

- [ ] Payment gateway integration (Midtrans/Stripe/DANA)
- [ ] Email notification system
- [ ] Multi-language support
- [ ] Advanced reporting & analytics
- [ ] Mobile app companion
- [ ] Social media integration

---
## 📞 Support

Need help? Reach out:
- 💬 Issues: [GitHub Issues](https://github.com/reyhanaIzzal21/task_eventTicket/issues)
---

<div align="center">

### ⭐ Star this repository if you find it helpful!

**Made with ❤️ by the Event Ticket Team**

[Report Bug](https://github.com/yourusername/event-ticket/issues) • [Request Feature](https://github.com/yourusername/event-ticket/issues)

</div>
