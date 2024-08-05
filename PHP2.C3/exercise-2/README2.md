#Exercise (not mandatory)
>Create a shopping list application with a MySQL database to store items using prepared
>statements and bind_param.

**HTML Form Creation:**

- Create a new file named index.html
- Add the necessary HTML code to create a form that allows users to enter shopping items
and submit them
- Include appropriate labels, input fields, and a submit button
- Save the shopping item into DB

**PHP Script to Handle Form Submission:**
- Create a new file named add_item.php
- Establish a connection to your MySQL database using the mysqli extension
- Retrieve the user input from the form submission and store it in a variable
- Validate and sanitize the user input as necessary
- Prepare an SQL statement with placeholders for the item data
- Create a prepared statement using the prepare method of the mysqli object
- Check if the statement preparation was successful
- Bind the item variable to the prepared statement as a parameter using the bind_param
method
- Execute the prepared statement using the execute method
- Check if the execution was successful and display an appropriate success message to
the user
- Close the prepared statement and the database connection