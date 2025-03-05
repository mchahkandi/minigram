# ChitChat

Welcome to the ChitChat Web App! This application is built using Laravel, Vue.js, Inertia.js, and Reverb, providing a modern and responsive user experience similar to Telegram. This README will guide you through the setup process and provide an overview of the project structure.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Running the Application](#running-the-application)

## Features

- User authentication (registration, login, logout)
- Real-time messaging
- User profiles and contact management
- Group chats
- Media sharing (images, files)

## Requirements

Before you begin, ensure you have met the following requirements:

- PHP >= 8.0
- Composer
- Node.js >= 14.x
- npm or yarn
- MySQL or another compatible database
- Git

## Installation

Follow these steps to set up the project on your local machine:

1. **Clone the Repository**

   Open your terminal and run the following command:

   ```bash
   git clone https://github.com/mchahkandi/chitchat.git
   ```


2. **Navigate to the Project Directory**

   ```bash
   cd chitchat
   ```

3. **Install PHP Dependencies**

   Make sure you have Composer installed, then run:

   ```bash
   composer install
   ```

4. **Install JavaScript Dependencies**

   You can use either npm or yarn. Choose one of the following commands:

   Using npm:

   ```bash
   npm install
   ```

   Using yarn:

   ```bash
   yarn install
   ```

5. **Copy the Environment File**

   Create a copy of the `.env.example` file:

   ```bash
   cp .env.example .env
   ```

6. **Generate Application Key**

   Run the following command to generate your application key:

   ```bash
   php artisan key:generate
   ```

## Configuration

1. **Database Setup**

   - Update your `.env` file with the correct database credentials:

     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_user
     DB_PASSWORD=your_database_password
     ```

   - Create the database specified in the `.env` file.

2. **Run Migrations and Seed Database**

   To set up the database tables, run:

   ```bash
   php artisan migrate --seed
   ```

## Running the Application

To start the development server, run:

```bash
composer run dev
```

This will start the server at `http://localhost:8000`. You can access the app in your web browser.


---

Thank you for checking out the Telegram Clone Web App! If you have any questions, feel free to reach out. Happy coding!
