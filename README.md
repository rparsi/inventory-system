Rahi API
====


A modernized code-base which contains the latest standard and best practices as of 2016.

Please make sure that you have thoroughly reviewed the following before submitting your pull requests:

* http://www.php-fig.org/
* https://symfony.com/doc/current/book/index.html
* https://doctrine-orm.readthedocs.org/en/latest/


How to Deploy
-------------

`{env}` is either **prod** or **dev** (without the quotes)

1. Using git checkout the correct branch

2. Ensure permission and ownership

    ```
    sudo chown `whoami`:devs var/ -R
    sudo chmod ug+rw var/ -R
    ```

3. Ensure that new files & directories inherits parent group ownership

    ```
    sudo find /path/to/your/checkout/* -type d -exec chmod g+s {} +
    ```

    **VERY IMPORTANT**

    * `var/cache` and `var/logs` directories must be writable by you AND apache (both your vm user account and apache are in the `devs` group)
    * Never run composer commands as root
    * If you are **mounting** from your VM, you need to run the composer commands **in your VM**
    * If you are **mounting** from your VM and try to run a composer command, you may encounter ```Resource temporarily unavailable``` error exception, composer most likely could not get to cache files because it is busy via mount


3. In `app/config`, create `parameters_dev.yml` and `parameters_prod.yml files`.

    For production, only the `parameters_prod.yml` is needed.

    See the following templates in `app/config` respectively:

        parameters_dev.yml.dist
        parameters_prod.yml.dist

4. Update vendors via composer

    ```
    composer install --optimize-autoloader
    ```

5. Clear symfony cache

    ```
    php bin/console cache:clear --env={env} --no-debug
    ```

6. Warm up symfony cache

    ```
    php bin/console cache:warmup --env={env} --no-debug
    ```

7. Dump assets (only works if the AsseticBundle is installed and configured -- we won't be building UI for a while so ignore this step)

    ```
    php bin/console assetic:dump --env={env} --no-debug
    ```

Database & Initial User
-----------------------

1. Import SQL changes

    ```
    php bin/console doctrine:schema:update --dump-sql
    ```

    As of Doctrine 2.2 and FOSUserBundle 1.3, Doctrine has a minor issue of generating proper INDEX for `username_canonical` and `email_canonical` as reported [here](https://github.com/FriendsOfSymfony/FOSUserBundle/issues/1919).

    If you encounter this, for now, please manually add length to its INDEX.
    Use length of 20 for username_canonical and 100 for email_canonical

    Alternatively, you can import `setup.sql`

2. Create a user via registration form

    Unfortunately, we cannot create user via FOSUserBundle command because we extended this and it contains required fields which the command doesn't prompt for

3. Set the user active (only if you disabled the registration email confirmation, which is explicitly enabled by our setttings)

    ```
    php bin/console fos:user:activate username
    ```

    Or you can activate the user by clicking the confirmation link sent to our [mail catcher](http://10.2.4.9:1080/)

Doctrine
--------

Starting with Symfony 3 the DoctrineBundle has merged some of it's commands for generating repository classes, entities and such.

    php bin/console doctrine:generate:entities Rahi/ApiBundle

Above will generate getters and setters, and repository classes for all entities in that namespace.
Since we will be using the GetterTrait and SetterTrait traits we don't really need to run the doctrine commands.
Creating new repository classes can be done easily by the developer, and the default Symfony 3 configuration makes
Doctrine auto generate proxies.

However if you're making entity changes you should still clear the doctrine cached meta-data:

    php bin/console doctrine:cache:clear-metadata
