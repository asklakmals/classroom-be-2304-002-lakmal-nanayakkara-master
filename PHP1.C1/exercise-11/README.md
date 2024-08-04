#Exercise * (advanced, not mandatory)

>Task: Create a PHP script that will perform the following tasks using functions and
>filesystem controls:
>Prompt the user to enter a directory path to scan.
>Scan the directory and all subdirectories for all files with a .txt extension.
>Create a new directory named "backup" inside the scanned directory.
>Create a backup copy of each .txt file found by copying it to the "backup" directory,
>while appending the current date and time to the filename.
>Create a report file named "backup_report.txt" inside the "backup" directory,
>containing the following information for each file backed up:
>Original filename and path
>Backup filename and path
>Date and time of backup
>Delete the "backup" directory and all of its contents.
**Requirements:**
*The script should prompt the user for input using the command line interface.*
*All filesystem operations should be performed using PHP functions, such as*
*opendir(), readdir(), is_dir(), is_file(), mkdir(), copy(), file_put_contents(), date().*