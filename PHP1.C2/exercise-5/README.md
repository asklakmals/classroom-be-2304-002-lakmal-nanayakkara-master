#Exercises * (not mandatory)
>Write a PHP function that takes a filename as input and outputs the number of
>words, number of sentences, and number of non-empty symbols in that file. Your
>function should use if-else statements, filesystem functions, loops, and arrays, and
>should not use any built-in PHP string functions except strlen() and
>str_contains()/strpos(). Your function should also handle edge cases, such as
>multiple spaces between words, leading and trailing spaces, and empty input
>strings.
Instructions:
1. Create a PHP file with a function named countStats().
2. The countStats() function should take a string as a parameter.
3. Inside the countStats() function, use file_get_contents() function to read the string from a
text file.
4. Create three variables to hold the word count, sentence count, and non-empty symbol
count, and initialize them to zero.
5. Use a for loop to iterate over each character in the string.
6. Inside the loop, use an if-else statement to check whether the current character is a letter,
digit, space, or punctuation mark.
7. If the current character is a letter or digit, increment the non-empty symbol count.
8. If the current character is a space, check whether the previous character was a letter or
digit. If it was, increment the word count.
9. If the current character is a period, exclamation mark, or question mark, check whether the
next character is also a period, exclamation mark, or question mark. If it's not, increment the
sentence count. Finally, return an array containing the word count, sentence count, and
non-empty symbol count.