# A simple website on Laravel for calculating utility bills.

A site for calculating utility bills, storing data in a database, displaying with graphs.


## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

## Prerequisites
What things you need to install the software.

- Git.
- PHP.
- Composer.
- Laravel CLI.

## Install
Clone the git repository on your computer
```
$ git clone https://github.com/alavir-ua/up-counter.git
```
You can also download the entire repository as a zip file and unpack in on your computer if you do not have git

After cloning the application, you need to install it's dependencies.
```
$ cd up-counter
$ composer install
```

## Setup
When you are done with installation, copy the .env.example file to .env
```
$ cp .env.example .env
```

Generate the application key
```
$ php artisan key:generate
```
Add the DB Credentials & APP_URL

Next make sure to create a new database and add your database credentials to your .env file:

```
DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
Generate the application password in your gmal account and add the parameters to the .env file
[Link](https://support.google.com/accounts/answer/185833?hl=uk)
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=ENTER_YOUR_EMAIL_ADDRESS(GMAIL)
MAIL_PASSWORD=ENTER_YOUR_GMAIL_PASSWORD
MAIL_ENCRYPTION=tls
MAIL_FROM_NAME=ENTER_YOUR_NAME
```

You will also want to update your website URL inside of the `APP_URL` variable inside the .env file:

```
APP_URL=http://localhost:8000
```

## Run the application
```
$ php artisan serve
```
## Links
[Live Demo](https://up-count.000webhostapp.com/)

