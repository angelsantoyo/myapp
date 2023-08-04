<p align="center"><img src="https://symfony.com/images/logos/header-logo.svg"></p>

# **Symfony 6 backoffice with Gentella Free Bootstrap 4 Admin Dashboard Template**

Gentelella A skeleton application with user account functionality on the foundation of the Symfony 5 framework, Twitter Bootstrap and Gentelella template .

## Theme Demo
![Gentelella Bootstrap Admin Template](https://colorlib.com/wp/wp-content/uploads/sites/2/gentelella-admin-template-preview.jpg
"Gentelella Theme Browser Preview")
**[Template Demo](https://colorlib.com/polygon/gentelella/index.html)**



# **Features**
- Administration Dashboard with Gentelella Admin Theme
- Responsive Layout
- Bootstrap 4
- USER/ROLES CRUD with ajax and symfony form system 
- Password reset and send email, with link to reset the password
- Authentication system
- Powerful blog management module (CRUD, Change histrory, file upload access control for Writers and Editors )
- FAQ module
- Translation functionality (Easy to set up whatever language you need/use)

# **Dockerized the develop (OPTIONAL)**
- If you are working with Docker Desktop for Mac, ensure **you have enabled `VirtioFS` for your sharing implementation**. `VirtioFS` brings improved I/O performance for operations on bind mounts. Enabling VirtioFS will automatically enable Virtualization framework.

- Create the file `./.docker/.env.nginx.local` using `./.docker/.env.nginx` as template. The value of the variable `NGINX_BACKEND_DOMAIN` is the `server_name` used in NGINX.

- For MAC and use the database local yo should
Docker for Mac (native)
Docker for Mac is particularly problematic because of networking limitations. The solution is as follows:

sudo ifconfig lo0 alias 10.200.10.1/24  # (where 10.200.10.1 is some unused IP address)
export DOCKER_HOST_IP=10.200.10.1

- Go inside folder `./docker` and run `docker compose up -d` to start containers.

- You should work inside the `php` container. This project is configured to work with [Remote Container](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers) extension for Visual Studio Code, so you could run `Reopen in container` command after open the project.

- Inside the `php` container, run `composer install` to install dependencies from `/var/www/symfony` folder.

- Use the following value for the DATABASE_URL environment variable:

```
DATABASE_URL=mysql://app_user:helloworld@db:3306/app_db?serverVersion=8.0.33
```

You could change the name, user and password of the database in the `env` file at the root of the project.
# **Requirements**
- PHP >= 8 (8.2.4 used in composer.json)
- Symfony- 6.2.*
- MySQL

**Recent Updates**
- removed sec check : **OK**
- upgraded to symfony 5.4 : **OK**
- next remove depreciations : **OK**
- new symfony security **OK**
- fix data fixtures **OK**
- PHP 8 compatible **OK**
- Annotations replacement for attribute **OK**
- Entities properties are typed now
- **UPDATED TO SYMFONY 6**
- Add FAQ

# **Credits**
- [Gentelella](https://github.com/ColorlibHQ/gentelella) - Admin template project is developed and maintained by [Colorlib](https://colorlib.com/ "Colorlib - Make Your First Blog") and Aigars Silkalns
- Mamour Wane (Mamless) co-founder of [ONETECHSN](https://onetechsn.com) designed and maintened the project so far

# **Third party tools**
- [Rector](https://github.com/rectorphp/rector) nice php open source tool to help upgrade code be compatible with higher version of framework and languages
- [PHP-CS-Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer) nice php open source tool fixes your code to follow standards (refactor)

## License information
Gentelella is licensed under The MIT License (MIT). Which means that you can use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software. But you always need to state that Colorlib is the original author of this template.

# **SETUP**
1 - Install all dependencies :

~~~
    composer install
~~~


2 - Create database using the next command:
~~~
    php bin/console doctrine:schema:create
~~~


3 - You will need to populate your database using fixtures for login.

Run:

~~~
    php bin/console doctrine:fixtures:load
~~~

And use the next credentials to login.

- Username : "admin"
- Password : "admin"

**ENJOY**

**Recent Updates**
- removed sec check : **OK**
- upgraded to symfony 5.4 : **OK**
- next remove depreciations : **OK**
- new symfony security **ok**
- fix data fixtures **ok**
- PHP 8 compatible **ok**
- Annotations replacement for attribute **ok**
- Entities properties are typed now
***
** Updates coming **
- Add contact module : 
- - Read messages in an inbox style **ok**
- - Sort by date and read status
- - Research in contacts
- - load mail with ajax
- Add faker to generate fake data 
- add SEO fields to each entity
- upgrade to symfony 6.4 (the LTS version november 2023)