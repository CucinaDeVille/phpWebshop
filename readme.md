## public
Pages, pictures and actions that make up the website.

## includes
Reused php files like the connection to the database.

## sql
Files creating the structure of the database and filling test data into it.
To test if data has been successfully loaded into the db, execute following command to connect to the db container interactively:

```bash
docker exec -it phpwebshop-db-1 mysql -u webshop -p
```
The database credentials are configured in `docker-compose.yml`.

Continue by switching to the **webshop** database by typing:
```sql
USE webshop
```
Now you can query data. For example by checking which users exist:
```sql
SELECT username FROM users;
```

### Users
The database contains one initial admin user.

The user is defined in `sql/seed.sql` and the password is stored as a hash.
A helper script `hash.php` can be used to generate password hashes.

## docker
If you have cloned this repository, change into the `phpWebshop` directory and run:

```bash
docker compose up
```

to start the application.
The `docker-compose.yaml` file includes the MySQL database and the Apache PHP Server.

## docs
This folder contains an ER diagram highlighting the structure of the tables within the database.
