# Basic-PHP-Login-with-Security 🔐

**A hands-on comparison of vulnerable vs secure PHP login systems**, designed to teach web security fundamentals through practical examples. 

![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-brightgreen)

## 🚀 Key Features

### Insecure Version (`/insecure-version`)
- ✅ **Deliberate vulnerabilities** for educational purposes  
- 🎯 **Attack surfaces**: SQLi, XSS, CSRF, session hijacking  
- ⚠️ **For local testing only** - never deploy!

### Secure Version (`/secure-version`)
- 🔒 **Security fixes** for all vulnerabilities  
- 🛡️ **Implements**:  
  - Prepared statements (SQLi protection)  
  - `password_hash()` + `password_verify()`  
  - CSRF tokens  
  - Output escaping (`htmlspecialchars()`)  
  - Session regeneration  

---

## 🛠️ **Improved Installation Guide**

### Prerequisites
- PHP 8.0+ (`php -v`)
- MySQL 5.7+ (`mysql --version`)
- Apache/Nginx (**Recommended**: [XAMPP](https://www.apachefriends.org/))

### Step-by-Step Setup
1. **Clone & navigate**:
   ```bash
   git clone https://github.com/yourusername/Basic-PHP-Login-with-Security.git
   cd Basic-PHP-Login-with-Security
