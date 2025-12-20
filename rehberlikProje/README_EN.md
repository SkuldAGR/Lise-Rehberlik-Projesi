# 🎓 Student Counseling Tracking System

A web-based management system developed for school counseling services to systematically record and track student meetings.

## 📋 Table of Contents

- [Features](#-features)
- [Technologies](#-technologies)
- [Installation](#-installation)
- [Usage](#-usage)
- [Project Structure](#-project-structure)
- [Database Structure](#-database-structure)
- [Screenshots](#-screenshots)
- [Contributing](#-contributing)
- [License](#-license)
- [Contact](#-contact)

## ✨ Features

- ✅ **Add Meetings**: Record student meetings in detail
- 📊 **List Records**: View and filter all meetings
- ✏️ **Edit**: Update existing records
- 🗑️ **Delete**: Remove unnecessary records
- 🔐 **Secure Login**: User authentication system
- 📱 **Responsive Design**: Mobile and desktop compatible interface
- 🎨 **Modern UI/UX**: User-friendly and modern design

## 🛠 Technologies

### Frontend
- **HTML5** - Structural markup
- **CSS3** - Styling and design
- **JavaScript (ES6+)** - Client-side interactions

### Backend
- **PHP** - Server-side programming
- **MySQL** - Database management

### Development Environment
- **XAMPP/WAMP** or similar local server
- Modern web browser (Chrome, Firefox, Edge, etc.)

## 🚀 Installation

### Prerequisites

1. **XAMPP/WAMP** must be installed
2. **Apache** and **MySQL** services must be running
3. Modern web browser

### Step by Step Installation

1. **Download the Project**
   ```bash
   git clone https://github.com/YOUR_USERNAME/rehberlikProje.git
   ```

2. **Move Project Folder to Web Server**
   ```bash
   # If using XAMPP
   cp -r rehberlikProje C:/xampp/htdocs/rehberlik
   
   # or if using WAMP
   cp -r rehberlikProje C:/wamp64/www/rehberlik
   ```

3. **Create Database**
   - Go to phpMyAdmin: `http://localhost/phpmyadmin`
   - Create a new database: `ogrenci`
   - Run the following SQL query:

   ```sql
   CREATE DATABASE IF NOT EXISTS ogrenci;
   USE ogrenci;

   CREATE TABLE IF NOT EXISTS girdiler (
       id INT AUTO_INCREMENT PRIMARY KEY,
       tarih DATE NOT NULL,
       saat TIME NOT NULL,
       ogrenci_adi VARCHAR(100) NOT NULL,
       sinif VARCHAR(20) NOT NULL,
       veli_adi VARCHAR(100),
       gorusme_turu VARCHAR(50),
       konu TEXT,
       asama VARCHAR(50),
       notlar TEXT,
       olusturma_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       guncellenme_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   );
   ```

4. **Configure Database Connection Settings**
   - Open `php/ayar.php` file
   - Update your database credentials if needed:
   ```php
   $host = "localhost";
   $kullanici = "root";
   $sifre = "";
   $veritabani = "ogrenci";
   ```

5. **Launch the Application**
   - Open this address in your browser: `http://localhost/rehberlik/html/giris.html`

## 📖 Usage

### Login
1. Open the application in your browser
2. Enter your username and password
3. Click the "Login" button

### Adding a New Meeting
1. Click "Add Meeting" button from the home page
2. Fill in the form:
   - Date and time
   - Student information
   - Meeting type and topic
   - Related notes
3. Click the "Save" button

### Viewing Records
1. Click "List Records" button from the home page
2. View all meeting records
3. Search and filter if desired

### Editing Records
1. Click the "Edit" button on the record you want to edit in the list
2. Make necessary changes
3. Click the "Update" button

### Deleting Records
1. Click the "Delete" button on the record you want to delete in the list
2. Confirm the deletion message

## 📁 Project Structure

```
rehberlikProje/
│
├── css/                    # Style files
│   ├── duzenle.css        # Edit page styles
│   ├── form.css           # Form styles
│   ├── giris.css          # Login page styles
│   ├── listele.css        # List page styles
│   └── main.css           # Main page styles
│
├── html/                   # HTML pages
│   ├── giris.html         # Login page
│   └── main.html          # Main page
│
├── img/                    # Images
│   └── user-icon.png      # User icon
│
├── php/                    # PHP files
│   ├── ayar.php           # Database connection settings
│   ├── duzenle.php        # Record editing operations
│   ├── ekle.php           # Record adding operations
│   ├── form.php           # Form page
│   ├── listele.php        # List records
│   └── sil.php            # Record deletion operations
│
├── script/                 # JavaScript files
│   ├── asamalar.js        # Stage management
│   ├── form.js            # Form interactions
│   └── giris.js           # Login page operations
│
├── .gitignore             # Git ignore file
├── README.md              # Project documentation (Turkish)
└── README_EN.md           # Project documentation (English)
```

## 🗄 Database Structure

### `girdiler` Table

| Field | Type | Description |
|-------|------|-------------|
| `id` | INT (Primary Key) | Unique record number |
| `tarih` | DATE | Meeting date |
| `saat` | TIME | Meeting time |
| `ogrenci_adi` | VARCHAR(100) | Student's name |
| `sinif` | VARCHAR(20) | Student's class |
| `veli_adi` | VARCHAR(100) | Parent's name |
| `gorusme_turu` | VARCHAR(50) | Meeting type |
| `konu` | TEXT | Meeting subject |
| `asama` | VARCHAR(50) | Process stage |
| `notlar` | TEXT | Additional notes |
| `olusturma_tarihi` | TIMESTAMP | Record creation time |
| `guncellenme_tarihi` | TIMESTAMP | Record last update time |

## 📸 Screenshots

_(You can add your screenshots here)_

## 🤝 Contributing

We welcome your contributions! To contribute:

1. Fork this repository
2. Create a new branch (`git checkout -b feature/NewFeature`)
3. Commit your changes (`git commit -m 'New feature: Description'`)
4. Push your branch (`git push origin feature/NewFeature`)
5. Open a Pull Request

### Contribution Guidelines
- Follow code standards
- Write meaningful commit messages
- Test your changes
- Update README when necessary

## 📝 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## 📧 Contact

For questions or suggestions:

- **GitHub**: [@YOUR_USERNAME](https://github.com/YOUR_USERNAME)
- **Email**: email@example.com

---

⭐ If you liked this project, don't forget to give it a star!

**Note**: This project was developed to improve education and counseling services. Pay attention to privacy and security measures when using it with real student data.
