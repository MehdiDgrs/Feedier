# Technical Test - Feedier 

## 📌 Project Overview

This project is a Laravel application built with the purpose of importing and storing feedback data.

### 🕒 Hourly CSV Import
- The application reads a CSV file every hour through a CRON job.

### 🖥 Vue.js Frontend Import
- Features a Vue.js frontend integrated on the Laravel backend. This interface includes a simple text field. When users submit this form, the application creates a new feedback entry in Feedier.

### 📤 Weekly Feedback Export
- Every Friday at 3 pm, an export of the imported feedback is sent to users with the role of admin via email. This export is attached as a JSON file.

### 🔐 User Authentication
- Users with role admin can log in to the application to import feedback.

### 🛠 Sentry Error Tracking
- The application is integrated with Sentry for exception monitoring. Ensure to have Sentry's DSN configured in your `.env` file to receive notifications on exceptions.
