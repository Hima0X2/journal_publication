# journal_publication
It is an application of journal publication.

## Technologies Used

PHP
MySQL
HTML/CSS
JavaScript (for dynamic content)
PHPMailer (for sending emails)

## Prerequisites

Before starting, ensure you have the following installed:

PHP (version 7.0 or higher)
MySQL (or any other database server)
Composer (for PHP dependency management)
XAMPP or any local server environment (for testing)

## Setup

1. **Clone the repository:**

    ```bash
    git clone https://github.com/Hima0X2/journal_publication.git
    ```
    
2. **Install dependencies ( using Composer):**
  composer install
    
3. **Database Setup:**

  - Create a MySQL database named publication.
  - Import the database schema from database.sql file provided in the repository

4. **Configuration:**
    Update db.php with your MySQL database credentials:
  ```bash
   <?php
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "publication";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
 ```
5. **Start the Application:**
Launch your local server environment (XAMPP).
Access the application through your web browser: http://192.168.159.1/publication/tamplates/login.html
## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvement, please create an issue or submit a pull request.
