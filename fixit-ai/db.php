<?php
$db = new PDO("sqlite:fixit.db");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/* USERS */
$db->exec("
CREATE TABLE IF NOT EXISTS users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  firebase_uid TEXT UNIQUE,
  email TEXT UNIQUE,
  role TEXT DEFAULT 'user',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
");

/* ISSUES */
$db->exec("
CREATE TABLE IF NOT EXISTS issues (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER,
  type TEXT,
  description TEXT,
  severity INTEGER,
  location TEXT,
  status TEXT DEFAULT 'Open',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
");

/* DEFAULT ADMIN */
$adminEmail = 'admin@fixit.com';
$adminUID   = 'YMRnHIaGXOPVslrGkgJPmnDxjvU2';

$check = $db->prepare("SELECT id FROM users WHERE email=?");
$check->execute([$adminEmail]);

if (!$check->fetch()) {
  $db->prepare("
    INSERT INTO users(email, firebase_uid, role)
    VALUES (?, ?, 'admin')
  ")->execute([$adminEmail, $adminUID]);
}
