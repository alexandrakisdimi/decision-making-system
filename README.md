# decision-making-system
A simple decision making tool written in PHP and HTML.

## Table of contents
- [Description](#description)
- [Installation](#installation)

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

## Database configuration

The project include the database schema required for the application to run.
Once the database is inserted and a database is created insert your credentials into the dbcon.php file. 

```
$db_conx = mysqli_connect("127.0.0.1", "db_user", "password", "dbname");
```

Create an admin user to access the administrative pages through mysql.
```
insert into users (user_id, username, password, email, fname, lname, type, validate) values (0, 'username', md5('password'), 'email', 'firstname', 'lastname', 'admin', 1);
```

```
