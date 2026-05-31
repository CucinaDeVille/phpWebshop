## public
publicly reachable pages; e.g. apace webroot

## includes
reusable php files

## actions
files that digest forms

## sql
tables and test data
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
Change into the `phpWebshop` directory and run:

```bash
docker compose up
```

to start the application.
The `docker-compose.yaml` file includes the MySQL database and the Apache PHP Server.
