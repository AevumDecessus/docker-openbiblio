Docker + Openbiblio
===================
Dockerized containers for running an openbiblio instance

Contains the following addons:
* lookup2
* advanced opac

Instructions for use:
1. Create a data container for mariadb. See [this post](http://container42.com/2013/12/16/persistent-volumes-with-docker-container-as-volume-pattern/) for why.

    ```bash
    docker run -d -v /var/lib/mysql --name data-mariadb-openbiblio --entrypoint /bin/echo mariadb
    ```
2. Modify the values for database passwords in docker-compose.yml and src/public/database_constants.php
3. Run docker via compose

    ```bash
    docker-compose up -d
    ```
4. Navigate to http://localhost:8080/install/index.php to create initial database tables
5. Navigate to http://localhost:8080/admin to access the library admin interface
6. Default login is:
  * admin
  * admin
7. Navigate to http://localhost:8080/lookup2/lookupOptsForm.php?reset=Y to install the default lookup2 options
8. Navigate to http://localhost:8080/lookup2/lookupHostsForm.php?reset=Y to install the default lookup2 hosts
9. Enjoy!
