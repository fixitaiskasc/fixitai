# 🛠️ FixIt AI – Civic Issue Reporting Platform

FixIt AI is a smart civic issue reporting web application that allows citizens to report public infrastructure problems using just a photo.  
The system uses Google Gemini AI to automatically detect the issue type and severity, while administrators can review, approve, or close reported issues.

## 🚀 Features

### 👤 User Features
- Firebase Authentication (Email & Password)
- Report issues using camera or image upload
- AI-powered issue detection (type & severity)
- Add description and location
- View previously reported issues
- Clean UI with SweetAlert toast notifications

### 🛡️ Admin Features
- Admin dashboard
- Approve reported issues
- Close resolved issues
- View all user submissions
- Role-based access control (Admin / User)

## 🧠 AI Workflow

1. User uploads an image of a civic issue  
2. Image is sent to Google Gemini Vision API  
3. AI analyzes the image and returns:
   - Issue type (pothole, garbage, streetlight, etc.)
   - Severity score (1–10)  
4. The issue is stored in the database for admin review

## 🧰 Tech Stack

| Layer | Technology |
|------|-----------|
| Frontend | HTML, CSS, Bootstrap, JavaScript |
| Authentication | Firebase Authentication |
| AI | Google Gemini Vision API |
| Backend | PHP |
| Database | SQLite |
| Alerts | SweetAlert2 |
| Server | PHP Built-in Server / XAMPP |

## 📁 Project Structure

|fixit-ai/
├── index.html
├── auth.php
├── issue.php
├── analyze.php
├── db.php
├── fixit.db
└── README.md

## 🔐 Default Admin User

Admin access is role-based and stored in the database.

Email: admin@fixit.com  
Role: admin  

Password is managed using Firebase Authentication.  
The admin user must exist in Firebase with the same email address.

## ⚙️ Setup Instructions

### Clone the Repository
```bash
git clone https://github.com/your-username/fixit-ai.git
cd fixit-ai
```

### Start PHP Development Server
```bash
php -S localhost:8000
```

### Open the Application
```bash
http://localhost:8000/index.html
```

## 🔑 Firebase Setup

1. Go to Firebase Console
2. Create a new project
3. Enable Email / Password Authentication
4. Create a Web App
5. Copy Firebase configuration into index.html

```script
const firebaseConfig = {
  apiKey: "YOUR_API_KEY",
  authDomain: "YOUR_PROJECT.firebaseapp.com",
  projectId: "YOUR_PROJECT_ID",
  appId: "YOUR_APP_ID"
};
```

## 🤖 Gemini AI Setup
1. Open Google AI Studio
2. Create an API Key
3. Enable Generative Language API
4. Paste the API key in analyze.php

```php
$API_KEY = "YOUR_GEMINI_API_KEY";
```

## 🧪 Supported Issue Types
- Pothole
- Garbage
- Streetlight
- Road damage
- Other civic infrastructure issues

## 🔮 Future Enhancements
- Live GPS-based location tagging
- Map-based issue visualization
- Analytics dashboard for admins
- Before / After image comparison
- Cloud deployment using Firebase Functions

## License
This project is open-source and intended for educational, demo, and hackathon purposes.
