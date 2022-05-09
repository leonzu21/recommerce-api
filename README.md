Recommerce API Coding Test
========================

Recommerce wants to build a REST API service where one can create mobile phone
trade-ins and view these trade-ins.
Trade-in prices are set according to the make and model of the phones.
User management is not to be dealt with for now : only the email address of the user making
the trade-in order must be registered.
Likewise, no security or access control to the API is to be implemented. However, we would
appreciate it if you could provide empty comments and / or code blocks indicating how you
would anticipate this evolution.

Requirements
------------

  * PHP 7.2 or higher;
  * MySQL Server 8.0
  * PDO-SQLite PHP extension enabled;

Installation
------------

Download Symfony to install the `symfony` binary on your computer.

Then navigate to the project's root folder.

```bash
$ cd recommence-api
```

Install composer packages

```bash
$ composer install
```

Populate your .env file with the MySQL Database connection string like below

```bash
DATABASE_URL="mysql://root:[password]@127.0.0.1:3306/recommerce?serverVersion=8.0"
```

Create the database schema and tables

```bash
$ bin/console doctrine:database:create
$ bin/console doctrine:schema:create
```

Usage
-----

Run the following command from within the project's root folder:

```bash
$ symfony server:start
```

Then access the application in your browser at the given URL (<https://localhost:8000> by default).

You can find the API dashboard at <https://localhost:8000/api>


API Endpoints
-----

GET, POST, DELETE endpoints are available for each of /api/brands, /api/products and /api/orders.

However, in order to add products to an order, you must first create a new order without adding the products, and then you should
 create new products stating the order's object IRI in the POST request. Likewise, a brand should already be created beforehand.
 
 Example:
```bash
{
  "brand": "api/brands/4",
  "order": "api/orders/2",
  "name": "Device Name",
  "price": 128.74
}
```
