Rahi API
====


A modernized code-base which contains the latest standard and best practices as of 2016.

How to Deploy
-------------

`{env}` is either **prod** or **dev** (without the quotes)

1. Using git checkout the correct branch

2. Ensure permission and ownership

    ```
    sudo chown `whoami`:devs var/ web/ -R
    sudo chmod ug+rw var/ web/ -R
    ```

3. Ensure that new files & directories inherits parent group ownership

    ```
    sudo find /path/to/your/checkout/* -type d -exec chmod g+s {} +
    ```

    **VERY IMPORTANT**

    * `var/cache`, `var/logs` and `var/session` directories must be writable by you AND apache
    * Should not run composer commands as root


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


Database & Initial User
-----------------------

1. Import SQL changes

    ```
    php bin/console doctrine:schema:update --dump-sql
    ```

    As of Doctrine 2.2 and FOSUserBundle 1.3, Doctrine has a minor issue of generating proper INDEX for `username_canonical` and `email_canonical` as reported [here](https://github.com/FriendsOfSymfony/FOSUserBundle/issues/1919).

    If you encounter this, for now, please manually add length to its INDEX.
    Use length of 20 for username_canonical and 100 for email_canonical

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


JS
--------

Using jspm for all javascript.
First ensure that the deployment environment has been setup:
```
cd frontend
jspm install
```

Then compile the specific js files (no watcher has been configured at this time):
```
cd frontend
jspm bundle-sfx ApiConsoleView ../web/js/build/apiConsole.js
```

The syntax for building js files is:
```
jspm bundle-sfx nameOfSourceFile ../web/js/build/nameOfOutputFile
```

In your Twig template refer to the generated JS file in the `web/js/build` directory:
```
<script type="text/javascript" src="{{ asset('js/build/yourBuildGeneratedFile.js') }}"></script>
```