# Mental Wellness Support Platform

A comprehensive, student-focused mental health and wellness platform built with modern web technologies.

## 🧠 Overview

Mental Wellness Support is a premium wellness platform designed specifically for students to manage mental health, stress, anxiety, and emotional well-being. The platform features AI-powered wellness assistance, professional doctor consultations, appointment booking, and comprehensive support services.

## 🚀 Features

- **AI Wellness Chatbot**: 24/7 AI-powered wellness assistant
- **Doctor Directory**: Browse and book appointments with qualified professionals
- **Appointment System**: Easy appointment booking and management
- **Admin Dashboard**: Complete management system for administrators
- **Doctor Dashboard**: Schedule and appointment management for doctors
- **User Accounts**: Secure user registration and profile management
- **Institute Services**: Wellness training and support programs
- **Hospital Services**: Medical consultation and support
- **Helpline Support**: Emergency support and crisis assistance
- **Responsive Design**: Works seamlessly on mobile, tablet, and desktop

## 🛠️ Tech Stack

- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Backend**: PHP 8+
- **Database**: MySQL
- **Icons**: Font Awesome
- **Responsive**: Mobile-first design

## 📁 Project Structure

```
mental-wellness-support/
├── index.php                 # Homepage
├── about.php                 # About page
├── services.php              # Services page
├── doctors.php               # Doctor directory
├── chatbot.php               # AI Chatbot interface
├── booking.php               # Appointment booking
├── institute.php             # Institute services
├── hospital.php              # Hospital services
├── contact.php               # Contact page
├── faq.php                   # FAQ page
├── privacy-policy.php        # Privacy policy
├── terms.php                 # Terms and conditions
│
├── assets/                   # Static assets
│   ├── css/                  # Stylesheets
│   │   ├── style.css
│   │   ├── responsive.css
│   │   └── admin.css
│   ├── js/                   # JavaScript files
│   │   ├── main.js
│   │   ├── chatbot.js
│   │   ├── booking.js
│   │   └── admin.js
│   ├── images/               # Images
│   ├── icons/                # Icon assets
│   └── logos/                # Brand logos
│
├── includes/                 # Core PHP includes
│   ├── header.php
│   ├── footer.php
│   ├── navbar.php
│   ├── db.php
│   ├── config.php
│   ├── functions.php
│   ├── auth.php
│   ├── csrf.php
│   └── helpers.php
│
├── admin/                    # Admin panel
│   ├── index.php
│   ├── login.php
│   ├── dashboard.php
│   ├── users.php
│   ├── doctors.php
│   ├── appointments.php
│   ├── chatbot_logs.php
│   ├── services.php
│   ├── testimonials.php
│   ├── faqs.php
│   ├── contact_messages.php
│   └── settings.php
│
├── doctor/                   # Doctor portal
│   ├── login.php
│   ├── dashboard.php
│   ├── profile.php
│   ├── availability.php
│   └── appointments.php
│
├── user/                     # User portal
│   ├── register.php
│   ├── login.php
│   ├── dashboard.php
│   ├── profile.php
│   ├── bookings.php
│   └── support.php
│
├── api/                      # API endpoints
│   ├── chatbot.php
│   ├── booking.php
│   ├── doctors.php
│   ├── auth.php
│   ├── contact.php
│   └── notifications.php
│
├── database/                 # Database files
│   ├── schema.sql
│   ├── seed.sql
│   └── migrations/
│
├── uploads/                  # User uploads
│   ├── doctors/
│   ├── users/
│   ├── testimonials/
│   └── documents/
│
└── .htaccess
```

## 🎨 Brand Colors

- **Primary**: #003249 (Deep Blue)
- **Secondary**: #007ea7 (Cyan Blue)
- **Accent 1**: #80ced7 (Light Cyan)
- **Accent 2**: #9ad1d4 (Pale Cyan)
- **Neutral**: #ccdbdc (Light Gray-Blue)

## 📋 Installation

### Prerequisites
- PHP 8.0 or higher
- MySQL 5.7 or higher
- Apache with mod_rewrite enabled
- Composer (optional)

### Setup Steps

1. **Clone the repository**
```bash
git clone https://github.com/Alisa-ai-cloud/mental-wellness-support.git
cd mental-wellness-support
```

2. **Create MySQL Database**
```bash
mysql -u root -p < database/schema.sql
```

3. **Configure Database**
Edit `includes/config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'your_password');
define('DB_NAME', 'mental_wellness_support');
```

4. **Create Upload Directories**
```bash
mkdir -p uploads/{doctors,users,testimonials,documents}
chmod 755 uploads/
```

5. **Set Web Server**
- Set document root to project directory
- Ensure mod_rewrite is enabled
- Visit: `http://localhost/mental-wellness-support`

6. **Create Admin Account** (via database)
```sql
INSERT INTO admin_users (full_name, email, password, role, status) 
VALUES ('Admin', 'admin@mentalwellnesssupport.com', '[HASHED_PASSWORD]', 'admin', 'active');
```

## 🔐 Security Features

- CSRF protection on all forms
- Secure password hashing (bcrypt)
- SQL injection prevention with prepared statements
- XSS protection with htmlspecialchars
- Session management with timeout
- Role-based access control (RBAC)
- File upload validation
- Secure HTTP headers

## 👥 User Roles

### Student/Patient
- Browse and filter doctors by specialty
- Book and manage appointments
- Use AI wellness chatbot 24/7
- View consultation history
- Manage personal profile
- Access wellness resources

### Doctor
- View scheduled appointments
- Manage availability and schedule
- Update profile and bio
- View patient information
- Provide appointment notes

### Admin
- Manage all users and doctors
- Approve/reject registrations
- View all appointments and bookings
- Manage services, FAQs, testimonials
- View chatbot conversation logs
- System settings and configuration
- View contact messages

## 📞 API Endpoints

### Chatbot API
- `POST /api/chatbot.php` - Send message and get response

### Booking API
- `POST /api/booking.php` - Create new appointment
- `GET /api/booking.php?action=get_availability` - Get doctor availability

### Doctor API
- `GET /api/doctors.php` - List all doctors
- `GET /api/doctors.php?specialty=psychologist` - Filter by specialty

### Auth API
- `POST /api/auth.php?action=login` - User login
- `POST /api/auth.php?action=register` - User registration

### Contact API
- `POST /api/contact.php` - Submit contact form

## 🗄️ Database Schema

### Main Tables
- `users` - Patient/student accounts
- `doctors` - Doctor profiles and credentials
- `doctor_availability` - Doctor working hours
- `appointments` - Booking records
- `chatbot_sessions` - Chat session tracking
- `chatbot_messages` - Chat message history
- `services` - Available services
- `testimonials` - Patient reviews
- `faqs` - Frequently asked questions
- `contact_messages` - Contact form submissions
- `admin_users` - Administrator accounts
- `settings` - System configuration

## 🎯 Default Credentials

**Admin Panel**: `/admin/login`
- Email: admin@mentalwellnesssupport.com
- Password: (set during setup)

**Doctor Portal**: `/doctor/login`
- Credentials: Create via admin panel

**Patient Login**: `/user/login`
- Create account via registration form

## 📱 Responsive Design

- ✅ Mobile phones (< 480px)
- ✅ Small phones (480px - 767px)
- ✅ Tablets (768px - 1200px)
- ✅ Desktops (1200px+)
- ✅ Large displays (1400px+)

## ♿ Accessibility

- Semantic HTML structure
- ARIA labels where appropriate
- Keyboard navigation support
- Color contrast compliance (WCAG AA)
- Readable font sizes
- Focus indicators on interactive elements

## 🚀 Deployment

### Production Checklist
1. Set `error_reporting` to 0 in config.php
2. Enable HTTPS (set `session.cookie_secure` to true)
3. Use strong database passwords
4. Configure proper file permissions (644 for files, 755 for directories)
5. Set up automated backups
6. Configure email service for notifications
7. Enable firewall rules
8. Set up SSL certificate

### Environment Setup

Create `.env` file (not in git):
```
DB_HOST=localhost
DB_USER=root
DB_PASS=secure_password
DB_NAME=mental_wellness_support
SMTP_USER=your-email@gmail.com
SMTP_PASS=app-password
APP_ENV=production
```

## 📚 Documentation

- [Installation Guide](docs/INSTALLATION.md)
- [API Documentation](docs/API.md)
- [Admin Guide](docs/ADMIN.md)
- [Contributing](CONTRIBUTING.md)

## 🐛 Troubleshooting

### Database Connection Error
- Check MySQL is running
- Verify credentials in `includes/config.php`
- Ensure database is created

### Upload Folder Issues
- Check folder permissions: `chmod 755 uploads/`
- Verify PHP write access

### 404 Errors
- Enable mod_rewrite in Apache
- Check .htaccess file permissions
- Restart Apache

## 📧 Support

For support and inquiries:
- **Email**: support@mentalwellnesssupport.com
- **Phone**: 1-800-WELLNESS
- **Emergency**: Available 24/7

## 📄 License

Copyright © 2026 Mental Wellness Support. All rights reserved.

## 🤝 Contributing

Contributions are welcome! Please follow our coding standards and submit pull requests.

## 🎓 Learn More

- [Mental Health Resources](https://www.mentalhealth.gov)
- [Student Wellness](https://www.apa.org/science/about/psa/student-stress)
- [Crisis Resources](https://988lifeline.org)

---

**Built with ❤️ for student mental health and wellness.**
