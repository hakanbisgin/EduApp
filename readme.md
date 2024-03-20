

Requirements:
- PHP 8.2
- Composer
- MySQL 5.7

To initialize db at the first time you can use [db_ddl.sql](db_ddl.sql)

To configure the project you can use the following commands:

```bash
cp .env.example .env
```
Then you can edit the .env file to match your configuration.


To install the project you can use the following commands:

```bash
composer install
```

To serve the project you can use php built-in server with the following command:

```bash
php -S localhost:8000 -t public/
```


