# decision-making-system
A simple decision making tool written in PHP and HTML.

## Table of contents
- [Description](#description)
- [Installation](#installation)
- [Usage](#usage)

## Description
Web tool to assist in complicated decision making problems, utilising the AHP methodology. This application, extensively uses algorithms in order to solve a problem, by calculating weights for each criterion, factors that represent the criteria, and the alternative solutions of a target, under the influence of a factor. This online application was implemented by using PHP & HTML, an SQL database and Lapack libraries, which are used to calculate eigenvalues and eigenvectors that help evaluating the weights for each criteria, factor and alternative.

The application enables the researcher to create a survey, to determine a group of users who participate in the research, to collect responses, and export results. Each user has the opportunity to take part in a survey and view the results of previous surveys.
The tool's implementation demonstrates the convenience that a researcher can conduct a survey through a decision-making service, using simple data forms and programming structures. Furthermore, through this service, materialized algorithms of decision-making are provided, in order to help finding the optimal solution in a more rapid and easier way.

## Installation
For the deployment of the application you need
* Ubuntu Linux
* LAMP stack with php5.6
* LAPACKE library
* lapack wrapper https://github.com/ianbarber/php-lapack

> Important Note: `php-lapack` has been found not to work with later PHP versions. Thus requiring PHP5.6 to communicate with the Lapack Math Library.

### Apache and Mysql installation
```
$ sudo apt-get install apache2 mysql-server
```

## PHP5.6 Installation
```
$ sudo add-apt-repository -y ppa:ondrej/php
$ sudo apt-get update
$ sudo apt-get install libapache2-mod-php5.6 php5.6-dev php5.6 php5.6-xml php5.6-zip php5.6-mysql
```

Once PHP is installed. Follow the instructions on https://github.com/ianbarber/php-lapack to install the lapack wrapper and library.
Then, edit the php.ini file and 
```
1. Uncomment the line
extension=php_mysqli.dll

2. Add the line 
extension=/usr/lib/php/20131226/lapack.so

```
## Apache Configuration

Copy the `decision-making-system` folder under `/var/www/`
```
$ sudo chown -R $USER:$USER /var/www/decision-making-system
$ sudo chmod 777 /var/www/decision-making-system/en/admin
```
> Granting all permissions in the admin folder will allow the tool to be able to export the research results and save them in an excel file.

Next, copy the `apache/decision-making-system.conf` into `/etc/apache2/sites-available/` folder and enable the website
```
$ sudo a2ensite decision-making-system.conf
$ sudo a2dissite 000-default.conf
$ sudo systemctl restart apache2
```

## Database configuration

The project includes the database schema required for the application to run. You can create your database through the `schema.sql` file.
```
$ sudo mysql
mysql> CREATE DATABASE your_database;
$ sudo mysql your_database < schema.sql
```
Once you create the database, you have to create a user for the application to communicate with the database. 
```
$ sudo mysql
mysql> CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'user_password';
mysql> GRANT ALL PRIVILEGES ON database_name.* TO 'newuser'@'localhost';
```
Insert the details you created above into the `dbcon.php` file in `/var/www/decision-making-system/dbcon.php` 
```
$db_conx = mysqli_connect("127.0.0.1", "db_user", "password", "dbname");
```

Last, create an admin user through mysql to access the administrative pages.
```
insert into users (user_id, username, password, email, fname, lname, type, validate) values (0, 'username', md5('password'), 'email', 'firstname', 'lastname', 'admin', 1);
```

## Usage
The tool is user friendly with clear easy to follow procedures.

The site is separated by user accounts and administrator accounts. 

The administrator can:

* Create, modify and delete researches
* Assign users to answer a research
* Extract research results based on the user answers.

On the other hand a user can:
* Answer an assigned research
* View results

### Administrator
The administrator can find all the possible actions in a sidebar in his main screen.

![Create Research](https://octodex.github.com/images/yaktocat.png)

#### Creating a research

The administrator will have to complete a series of simple forms for the creation of a research.
The AHP methodology requires the research to have at least one criterion, at least one factor for each criterion and at least one alternative.
The administrator will have to provide the name and a description for each element.

![Create Research](https://github.com/alexandrakisdimi/decision-making-system/raw/master/screenshots/admin_main.png)
