# My first php blog
## Welcome on board!
This project closes the object-oriented programming part of my Openclassroom training.

This is a demonstration blog, fully operational :
- Full usage : login = admin, password = admin
- Simple member : login = user1, password = user1 

**Dependencies**

This website uses an external librarie included by Composer.
- PHPMailer

You can download it, if not already installed on your machine [Composer] (https://getcomposer.org/download/).

This website also uses some "front" libraries:

- Jquery, Jqueryj.rumble and Jquery.scrolly
- Sass


**How to install?**

1. Clone this repository on your local machine.
2. Import `config/Base_SQL.sql` to create your database (MySQL currently used).
3. In project folder open a new terminal window and execute command line `composer install`.
4. Rename 'config/default.php' to 'config/ini.php'
4. Edit `config/ini.php` with:
	* your `DB_NAME` (blog)
	* your `DB_USER` (root)
	* your `picture_repository`, where you want to store blogposts uploaded pictures
	* the `allowed_extensions` you want to allow
	* your mail datas (SMTP, mail to)
5. Your website is ready to be used and customized :)

Have fun :+1: