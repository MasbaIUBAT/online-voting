Online Voting System

Introduction

The Online Voting System is a web-based platform built using Laravel, designed to facilitate secure and efficient online elections. The system allows administrators to manage elections, candidates, and voters while ensuring a seamless voting process.

Features

User Authentication: Secure login for admins and voters.

Role Management: Different access levels for admin and voters.

Election Management: Create, update, and delete elections.

Candidate Management: Register and manage candidates.

Voting Process: Users can cast votes securely.

Results Calculation: Displays real-time election results.

Dashboard: Provides insights and reports on elections.

Secure Data Handling: Implements security best practices to protect user data.

Installation

Prerequisites

PHP 8.0+

Composer

Node.js & npm

MySQL or PostgreSQL database

Setup Instructions

Clone the Repository

git clone https://github.com/MasbaIUBAT/online-voting.git
cd online-voting

Install Dependencies

composer install
npm install && npm run dev

Environment Setup

cp .env.example .env
php artisan key:generate

Configure .env file with database and mail settings.

Run Migrations & Seed Database

php artisan migrate --seed

Start the Application

php artisan serve

The app will be available at http://127.0.0.1:8000/

Project Structure

Online-Voting-System/
├── app/              # Application logic
├── bootstrap/        # Bootstrap configuration
├── config/           # Configuration files
├── database/         # Migrations and seeders
├── public/           # Public assets (CSS, JS, Images)
├── resources/        # Views and frontend assets
├── routes/           # Web and API routes
├── storage/          # Storage for logs and cache
├── tests/            # PHPUnit tests
├── .env.example      # Environment variables template
├── composer.json     # PHP dependencies
├── package.json      # Node.js dependencies
└── README.md         # Project description

Usage

Admin Login: Use the credentials from the seeder or register a new admin.

Create Election: Set up a new election with candidates.

Voter Registration: Allow users to register and participate.

Voting: Voters can securely cast their votes.

View Results: Admins can monitor real-time results.

Contribution

Fork the repository.

Create a feature branch (git checkout -b feature-name).

Commit your changes (git commit -m "Description").

Push to your branch (git push origin feature-name).

Create a Pull Request.

License

This project is licensed under the MIT License.

Developed by MasbaIUBAT Team

 
