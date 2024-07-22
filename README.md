# RG-CMS
Content Management System (CMS)
This project is a simple Content Management System (CMS) built using PHP (mainly), HTML, CSS, JS and MySQL.


Features
•	User Authentication: Secure login and registration system.
•	Content Management: CRUD operations for managing articles/posts.
•	User Roles: Different access levels (e.g. admin, regular user).


Installation
1.	Clone the repository: https://github.com/aligaafar/RG-CMS.git
2.	Make sure that you downloaded XAMPP & VSCode
3.	Create a database called “cms” in localhost/phpMyAdmin/
4.	Create 2 tables in the database (users, posts)
   •	users table has the following attributes
   ( id (INT, PRIMARY KEY), username (VARCHAR 255), email (VARCHAR 255), password (VARCHAR 255), added (datetime, current_timestamp() ) 
   •	posts table has the following attributes
   ( id (INT, PRIMARY KEY), title (VARCHAR 255), content (text), author(int), date (date), added(datetime) )

5.	create from a localhost/phpMyAdmin/  a user with the following credentials (Already initialized as the admin in the backend code) username : gaafar, email: gaafar@mail.com, password:123456
6.	now you can go to http://localhost/cms/ to access the CMS login page and upon successful login, you can manage articles, users, and settings.



Contributing
Contributions are welcome! If you'd like to add features or fix bugs, please fork the repository and submit a pull request.


License
This project is licensed under the MIT License - see the LICENSE file for details.


Acknowledgments
•	Bootstrap - Front-end framework
•	PHP - Server-side scripting language
•	MySQL - Database management system
 
