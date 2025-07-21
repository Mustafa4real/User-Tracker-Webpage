# User-Tracker-Webpage
This simple PHP web application allows users to:
- Submit their name and age through a one-line form.
- Store the submitted data in a MySQL database.
- View all submitted entries in a table below the form.
- Toggle the `status` value (0 or 1) for each entry with a single click — updated live without page reload.

## Project Structure
```
User-Tracker-Webpage/
├── index.php # Main page: form + record display + JavaScript toggle
├── toggle.php # Backend logic to toggle status via AJAX
├── style.css # Basic styles for layout and table
└── README.md # Project documentation
```
## Database Setup

Make sure you have **XAMPP** installed and running (Apache + MySQL).


Open **phpMyAdmin** and run the following SQL script:

```
CREATE DATABASE IF NOT EXISTS info;

USE info;

CREATE TABLE IF NOT EXISTS user (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(25),
  age INT,
  status INT DEFAULT 0
);
```

## Running the Project
1. Place the user_form folder inside the htdocs directory:
`C:\xampp\htdocs\User-Tracker-Webpage\`
2. Start Apache and MySQL from the XAMPP Control Panel.

3. Open your browser and go to:

`http://localhost/User-Tracker-Webpage/index.php`

4. Use the form to enter new user records. The data will be displayed below the form in a table.

5. Each row includes a "Toggle" button to switch the user's status between 0 and 1 using AJAX (no page reload).

## How it looks like

https://github.com/user-attachments/assets/3c497839-fadc-47db-8c42-f6bb1cdb5082

