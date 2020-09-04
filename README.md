<p align="center"><img src="https://wolfpackit.nl/wp-content/uploads/2018/10/Wolfpack_logo.jpg" width="400"></p>

## About Project

This app developed to Create, Read, Update and Delete two main entities; Wolf and Pack.
There is another functionality to Add/Remove Wolf to/from Pack.

As mentioned there are two entities in this project right now:

#### Wolf

It should be possible to list all the wolves including some basic personal information
such as their name, gender and birthdate. Furthermore, it should be possible to add,
remove and update wolves in this list. All wolves have a location, and it should be
possible to update the location of a wolf such that we can include a map with all wolves
in the app.


#### Pack

Wolves like hanging out in packs, in our app we’d like an option to create packs to which
we can add wolves. Packs consist of a name and one or more wolves. Furthermore,
sometimes we want to remove wolves from a pack again. The app should be able to
display a list of packs, and the wolves which are in them.

## Requirements

I used Laravel v7.27.0 during the development.

-   PHP >= 7.2.5 - PHP is a popular general-purpose scripting language that is especially suited to web development
[ [PHP Official Website](https://www.php.net/) ]
-   Composer - A Dependency Manager for PHP
[ [Composer Official Website](https://getcomposer.org/) ]
- MySQL - MySQL is an open-source relational database management system.
[ [MySQL Official Website](https://www.mysql.com/) ]

You can install all the requirements manually based on your operating system or you can use Laragon for winodws, XAMPP for Linux or MAMP for MacOS.

## Using the app
1. open a terminal
2. Change directory to project directory
3. Run ``composer -vvv install`` in the project root directory
4. Create a database in your MySQL database and put the database name and credentials in ``.env`` file.
5. Run ``php artisan migrate`` to migrate the tables
6. You can server the application using any web servers like Apache, Nginx, LiteSpeed, etc or just
server it using PHP built-in web server by running ``php artisan server`` command.

After running the project you can find the swagger UI under the address ``http://YOURADDRESS/api/documentation``.


### Packages Used

- **[L5 Swagger](https://github.com/DarkaOnLine/L5-Swagger)**


### Useful Links

- **[Lravel](https://laravel.com/)**
- **[Laragon](https://laragon.org/)**
- **[WampServer](https://www.wampserver.com/en/)**
- **[XAMPP](https://www.apachefriends.org/index.html)**
- **[Nginx](https://www.nginx.com/)**
- **[Apache](https://httpd.apache.org/)**
- **[LiteSpeed](https://www.litespeedtech.com/products/litespeed-web-server)**
