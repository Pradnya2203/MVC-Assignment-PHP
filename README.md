# mvc-assignment

> Basic application with MVC architecture

## Setup

1. Clone the repository and `cd` into it.

1. Install composer using:
    ```console
    > curl -s https://getcomposer.org/installer | php
    > sudo mv composer.phar /usr/local/bin/composer
    ```

1. Install dependencies and dump-autoload:
    ```console
    > composer install
    > composer dump-autoload
    ```

1. Import schema present in `schema/schema.sql` in your database.

1. Serve the public folder at any port (say 8000):
    ```console
	> cd public
    > php -S localhost:8080
    ```

# features
Same login for admin as well as client
Passwords are salted and hashed

# ADMIN:
Can add books in the library
Can accept or deny the check in requests
Can access the available books in the library
Can impose fine(auto generated)

# CLIENT:
Can see the available books in the library
Can send check in request
Can access the books that are approved by the admin and checkout them

# BOOKS:
Can have multiple copies of one book
Fine is imposed per day after late submission

# DATABASE:
3 databases are used

1-client : Stores the name, username and password(hashed and salted) of a user/admin  and the fine to be paid by a particular client

2-books : Stores the status of a particular book which is requested by any user and keeps track of the amount of days passed between check in and check out of the book to impose fine

3-Book: Stores the available books in the library and the number of each book

# WORKING:

A user can register themselves and the data is stored in the client database with the default fine being 0 rupees
When a user send check in request the books database is updated with a new row with username and bookname with status 0. Admin can chose to accept or deny this request. When the request is accepted , the books table is updated with status 1 and issue date . If denied then the row is deleted from the books database. When  a user checks out a book the return date is noted and a fine is imposed if returned after more than 7 days. Admin can also add a book which updates the Book database. 



