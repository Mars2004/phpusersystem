#  User System in PHP

 - [Dependencies](#dependencies)
 - [Installation](#installation)
  - [Usage](#usage)
	  - [REST Api Service](#rest-api-service)
- [Possible Improvements](#possible-improvements)


User System in PHP is testing project of PHP with framework [Symfony](https://symfony.com/). User System was developed and tested on Xampp 7.4.6 and its PHP 7.4.6 version on Windows 10.

## Dependencies
Download and install all dependencies:
- PHP 7.4.6 (later version should also work) - use [PHP Download Page]([https://www.php.net/downloads]) or [XAMPP Download Page]([https://www.apachefriends.org/download.html]) to download and install.
 - [Symfony](https://symfony.com/) - use installation instructions at [Symfony Installation Page]([https://symfony.com/doc/current/setup.html](https://symfony.com/doc/current/setup.html)).

## Installation
- Download and install all [dependencies](#dependencies).
- Clone this repository.
- Run command line or bash and open directory in which is repository cloned to.
- Create database by command:
	- php bin/console doctrine:database:create (creates SQLite database <repo_dir>/var/data.db)
- Initialize database by command:
	- php bin/console doctrine:migrations:migrate
- Start server by command:
	- symfony server:start
- Server will start on [http://localhost:8000](http://localhost:8000).

## Usage
This is very simple application with one form (page) where new users can be added to database. Just visit [http://localhost:8000](http://localhost:8000) and try to add some user to database (host and port migth be different).

### REST Api Service
Threre is also a REST Api Service with these end points (host and port migth be different):
- [http://localhost:8000/api/users/list](http://localhost:8000/api/users/list) - to get list of all registered users in database.
- [http://localhost:8000/api/users/add](http://localhost:8000/api/users/add) - to create new user. This is PUT method, consider using Postman or some other tool to execute it (it won't work in a browser).

## Possible Improvements
- Column "Rights" of database table "User" looks like user role -> new table "User Roles" and each user can have one or more roles.
- "Add User Form" should call PUT method of REST Api at [http://localhost:8000/api/users/add](http://localhost:8000/api/users/add).