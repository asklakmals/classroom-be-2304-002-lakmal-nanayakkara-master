#Practical Task
**Task: Create a PHP script to display a list of contacts using PDO.**
1. Create a table named "contacts" with the following structure:
id (INT, primary key, auto-increment)
name (VARCHAR, 100 characters)
email (VARCHAR, 100 characters)
phone (VARCHAR, 20 characters)
2. Connect to the "contacts_db" database using PDO.
3. Display a list of all contacts from the "contacts" table in a table.
4. Add buttons to display table with contract but for different fetch
modes (PDO::FETCH_ASSOC, PDO::FETCH_BOTH, PDO::FETCH_BOUND,
PDO::FETCH_CLASS, PDO::FETCH_OBJ)
5. Handle possible errors, such as a failed database connection or
query execution.
6. Display meaningful error messages to the user when necessary.

*Note: Use prepared statements to prevent SQL injection when inserting or updating*
*data into the database.*
*Consider adding some basic styling to the contact list and forms to improve the*
*user experience.*