#Exercises (not mandatory)

>Task: Create a PHP script that reads in multiple text files, merges their contents, and
>performs the following operations:

- Removes any duplicate lines in the merged content
- Sorts the remaining lines in descending order
- Truncates each line to a maximum length of 30 characters
- Adds a suffix "#n" to each line indicating its position in the sorted list
Writes the updated content to a new file, appending the current date and time to
the filename
Requirements:
- Use PHP8 features such as match expressions, attributes, and the nullsafe
operator.
- Utilize array functions like array_unique(), arsort(), and array_map().
- Utilize string functions like substr(), trim(), and str_replace().
- Utilize filesystem functions like scandir(), realpath(), and file_put_contents().