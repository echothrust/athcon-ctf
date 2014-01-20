You will notice that some tables are using the FEDERATED engine, meaning their actual data resided on another mysql server. The actual tables resided in the mysql db for echofish v0.1 (https://github.com/echothrust/echofish), that was setup among other monitoring utilities to facilitate both the ctf-mods and the defenders (admins).

Having said that, you can still import the ctf schema without installing echofish, but some functionality will be missing. However, if you setup echofish later, you also need to adjust the CONNECTION strings in 'echofish-federated-archive.sql' and re-import it.

Import procedure:

```
echo "CREATE DATABASE echofish" | mysql -u root -p
mysql -u root -p echofish < echofish-federated-archive.sql
echo "CREATE DATABASE athcon" | mysql -u root -p 
mysql -u root -p athcon < athcon.mysql
mysql -u root -p athcon < athcon-federated.mysql
mysql -u root -p athcon < athcon-triggers.sql
mysql -u root -p athcon < athcon-users.sql
mysql -u root -p athcon < athcon-events.sql
mysql -u root -p athcon < athcon-data.sql
```

