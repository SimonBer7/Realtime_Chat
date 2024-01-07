# Realtime_Chat

# Simple Chat Application

This is a simple chat application that allows users to register, log in, and participate in real-time chat conversations.    
**Šimon Bernard C4b**

## URL

The application is hosted at this [website](http://157.230.124.90/login.php).

## Technologies Used

- PHP
- MySQL
- jQuery
- HTML
- CSS

## Features

- User registration
- User login/logout
- Real-time chat using jQuery and AJAX
- Messages stored in a MySQL database

## REST API Endpoints

### POST /process.php

- **Description**: Handles the processing of chat messages.
- **Request Method**: POST
- **Parameters**:
  - `message` (string): The message content.
  - `username` (string): The username of the sender.

### GET /process.php

- **Description**: Retrieves chat messages.
- **Request Method**: GET
- **Parameters**:
  - `all_messages` (optional): Retrieves all messages from all chat rooms.
  - `user_messages` (optional): Retrieves all messages from a selected user.
  - `search_word` (optional): Retrieves all messages containing a specific word.

### POST /registration.php

- **Description**: Handles user registration.
- **Request Method**: POST
- **Parameters**:
  - `name` (string): User's name.
  - `username` (string): User's chosen username.
  - `email` (string): User's email address.
  - `password` (string): User's chosen password.
  - `confirmpassword` (string): Confirmation of the chosen password.

### POST /login.php

- **Description**: Handles user login.
- **Request Method**: POST
- **Parameters**:
  - `usernameemail` (string): Username or email of the user.
  - `password` (string): User's password.

## Usage

1. Access the application at this [website](http://157.230.124.90/login.php).
2. Register a new account or log in with existing credentials.
3. Start sending and receiving real-time chat messages.

Enjoy chatting!

