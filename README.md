#  User System in PHP

 - [Installation](#installation)
	 - [Dependencies](#dependencies)
	 - [Configuration](#configuration)
  - [Usage](#usage)


User System in PHP is testing project of PHP with framework [Symfony](https://symfony.com/).

## Installation


### Dependencies
Download and install all dependencies:
 - [Symfony](https://symfony.com/) - use installation instructions at [Symfony Installation Page]([https://symfony.com/doc/current/setup.html](https://symfony.com/doc/current/setup.html)).

### Configuration


## Usage
This is very simple application with one form (page) where new users can be added to database. Just visit [http://localhost:8000](http://localhost:8000) and try to add some user to database (host and port migth be different).

### REST Api Service
Threre is also a REST Api Service with this end points (host and port migth be different):
- [http://localhost:8000/api/users/list](http://localhost:8000/api/users/list) - to get list of all registered users in database.
- [http://localhost:8000/api/users/add](http://localhost:8000/api/users/add) - to create new user. This is PUT method, consider using Postman or some other tool to execute it (it won't work in a browser).