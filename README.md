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
* LAMP stack
* LAPACKE package

### LAMP
LAMP is a group of open-source software that is typically installed together to enable a server to host dynamic websites and web apps. 

If you have never installed a LAMP stack before, you will find this tutorial useful. 

[How To Install Linux, Apache, MySQL, PHP (LAMP) stack on Ubuntu 18.04](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-ubuntu-18-04)

### LAPACKE
The installation of lapacke package, in order to be used with PHP, requires the lapack libraries the OS provides, subversion to pull the latest version of the package from version control, and cmake to install the package

```
$ apt install gfortran
$ apt install liblapack-dev
$ apt install svn
$ apt install cmake
```

We are now ready to install php lapacke
```
$ svn co https://icl.cs.utk.edu/svn/lapack-dev/lapack/trunk lapack
$ cd lapack
$ mkdir build
$ cd build
$ cmake -D BUILD_SHARED_LIBS=ON -D LAPACKE=ON ../
$ make 
$ sudo make install
```
