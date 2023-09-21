### 1 - INSTALANDO UBUNTU 22.04.2 LTS NO WSL2
#### CONFIGURANDO USUÁRIO UNIX E SENHA
    Installing, this may take a few minutes...
    Please create a default UNIX user account. The username does not need to match your Windows username.
    For more information visit: https://aka.ms/wslusers
    Enter new UNIX username: luciolemos
    New password:
    Retype new password:
    passwd: password updated successfully
    Installation successful!
    To run a command as administrator (user "root"), use "sudo <command>".
    See "man sudo_root" for details.

    Welcome to Ubuntu 22.04.2 LTS (GNU/Linux 5.15.90.1-microsoft-standard-WSL2 x86_64)

    * Documentation:  https://help.ubuntu.com
    * Management:     https://landscape.canonical.com
    * Support:        https://ubuntu.com/advantage


    This message is shown once a day. To disable it please create the /home/luciolemos/.hushlogin file.
#### ATUALIZANDO OS PACOTES
    luciolemos@dev:~$ sudo apt update
### 2 - INSTALANDO O APACHE2
    luciolemos@dev:~$ sudo apt install apache2
#### LISTA DE CONTROLE DO FIREWAL DO UBUNTU
    luciolemos@dev:~$ sudo ufw app list
    Available applications:
      Apache
      pache Full
      Apache Secure
#### ESCOLHENDO O APACHE
    luciolemos@dev:~$ sudo ufw allow in "Apache"
    Rules updated
    Rules updated (v6)
#### VERIFICANDO O STATUS DO FIREWAL
    luciolemos@dev:~$ sudo ufw status
    Status: inactive
#### VERIFICANDO O IP PÚBLICO
    luciolemos@dev:~$ curl http://icanhazip.com
    187.19.241.252
### 3 - INSTALANDO MYSQL SERVER
    luciolemos@dev:~$ sudo apt install mysql-server

luciolemos@dev:~$ sudo mysql
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 8
Server version: 8.0.34-0ubuntu0.22.04.1 (Ubuntu)

Copyright (c) 2000, 2023, Oracle and/or its affiliates.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';
Query OK, 0 rows affected (0.02 sec)

mysql> exit
Bye

luciolemos@dev:~$ sudo mysql_secure_installation


luciolemos@dev:~$ mysql -u root -p
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 11
Server version: 8.0.34-0ubuntu0.22.04.1 (Ubuntu)

Copyright (c) 2000, 2023, Oracle and/or its affiliates.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> exit
Bye
### 4 - INSTALANDO PHP
    luciolemos@dev:~$ sudo apt install php libapache2-mod-php php-mysql
#### VERIFICANDO A VERSÃO DO PHP
    luciolemos@dev:~$ php -v
    PHP 8.1.2-1ubuntu2.14 (cli) (built: Aug 18 2023 11:41:11) (NTS)
    Copyright (c) The PHP Group
    Zend Engine v4.1.2, Copyright (c) Zend Technologies
    with Zend OPcache v8.1.2-1ubuntu2.14, Copyright (c), by Zend Technologies
#### CRIANDO O HOST `dev` DENTRO DA ESTRUTURA `/var/www`.
    luciolemos@dev:~$ sudo mkdir /var/www/dev
#### DANNDO PERMISSÃO AO USUÁRIO
    luciolemos@dev:~$ sudo chown -R $USER:$USER /var/www/dev

luciolemos@dev:~$ sudo nano /etc/apache2/sites-available/dev.conf

luciolemos@dev:~$ sudo a2ensite dev
Enabling site dev.
To activate the new configuration, you need to run:
  systemctl reload apache2

luciolemos@dev:~$ sudo a2dissite 000-default
Site 000-default disabled.
To activate the new configuration, you need to run:
  systemctl reload apache2
#### VERIFICANDO A SINTAXE
    luciolemos@dev:~$ sudo apache2ctl configtest
    Syntax OK
#### RELOAD DO APACHE
    luciolemos@dev:~$ sudo systemctl reload apache2
#### CRIA DENTRO DE `dev` O ARQUIVO `index.html`
    luciolemos@dev:~$ nano /var/www/dev/index.html
#### CRIA DENTRO DE `dev` o ARQUIVO `info.php`
    luciolemos@dev:~$ nano /var/www/dev/info.php

luciolemos@dev:~$ mysql -u root -p
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 15
Server version: 8.0.34-0ubuntu0.22.04.1 (Ubuntu)

Copyright (c) 2000, 2023, Oracle and/or its affiliates.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> CREATE DATABASE teste;
Query OK, 1 row affected (0.01 sec)

mysql> CREATE USER 'teste_user'@'%' IDENTIFIED BY 'teste_pw';
Query OK, 0 rows affected (0.03 sec)

mysql> GRANT ALL ON teste.* TO 'teste_user'@'%';
Query OK, 0 rows affected (0.01 sec)

mysql> exit
Bye

luciolemos@dev:~$ mysql -u teste_user -p
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 16
Server version: 8.0.34-0ubuntu0.22.04.1 (Ubuntu)

Copyright (c) 2000, 2023, Oracle and/or its affiliates.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> show databases;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| performance_schema |
| teste              |
+--------------------+
3 rows in set (0.00 sec)

mysql> CREATE DATABASE e_comerce;
ERROR 1044 (42000): Access denied for user 'teste_user'@'%' to database 'e_comerce'
mysql> show databases;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| performance_schema |
| teste              |
+--------------------+
3 rows in set (0.01 sec)


luciolemos@dev:~$ mysql -u root -p
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 17
Server version: 8.0.34-0ubuntu0.22.04.1 (Ubuntu)

Copyright (c) 2000, 2023, Oracle and/or its affiliates.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> GRANT ALL ON e_comerce.* TO 'teste_user'@'%';
Query OK, 0 rows affected (0.01 sec)

mysql> exit
Bye
luciolemos@dev:~$ mysql -u teste_user -p
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 18
Server version: 8.0.34-0ubuntu0.22.04.1 (Ubuntu)

Copyright (c) 2000, 2023, Oracle and/or its affiliates.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> show databases;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| performance_schema |
| teste              |
+--------------------+
3 rows in set (0.00 sec)

mysql> exit
Bye
luciolemos@dev:~$ mysql -u root -p
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 19
Server version: 8.0.34-0ubuntu0.22.04.1 (Ubuntu)

Copyright (c) 2000, 2023, Oracle and/or its affiliates.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> show databases;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| mysql              |
| performance_schema |
| sys                |
| teste              |
+--------------------+
5 rows in set (0.00 sec)

mysql> CREATE DATABASE e_comerce;
Query OK, 1 row affected (0.03 sec)

mysql> show databases;
+--------------------+
| Database           |
+--------------------+
| e_comerce          |
| information_schema |
| mysql              |
| performance_schema |
| sys                |
| teste              |
+--------------------+
6 rows in set (0.00 sec)

mysql> GRANT ALL ON e_comerce.* TO 'teste_user'@'%';
Query OK, 0 rows affected (0.01 sec)

luciolemos@dev:~$ mysql -u teste_user -p
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 21
Server version: 8.0.34-0ubuntu0.22.04.1 (Ubuntu)

Copyright (c) 2000, 2023, Oracle and/or its affiliates.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> show databases;
+--------------------+
| Database           |
+--------------------+
| e_comerce          |
| information_schema |
| performance_schema |
| teste              |
+--------------------+
4 rows in set (0.00 sec)

mysql> use e_comerce;
Database changed
mysql> CREATE TABLE clientes (
    -> cliente_cod INT NOT NULL AUTO_INCREMENT,
    -> cliente_nome varchar(255) NOT NULL,
    -> cliente_sobrenome varchar(255) NOT NULL,
    -> cliente_sexo char (1),
cliente_    -> cliente_idt varchar(255) NOT NULL,
    -> cliente_cpf varchar (14) NOT NULL,
liente_    -> cliente_data_nascimento DATE,
    -> cliente_ts timestamp,
    -> PRIMARY KEY (cliente_cod)
    -> );
Query OK, 0 rows affected (0.06 sec)

mysql> show tables;
+---------------------+
| Tables_in_e_comerce |
+---------------------+
| clientes            |
+---------------------+
1 row in set (0.00 sec)

mysql> CREATE TABLE clientes (
    -> cliente_cod INT NOT NULL AUTO_INCREMENT,
    -> cliente_nome varchar(255) NOT NULL,
    -> cliente_sobrenome varchar(255) NOT NULL,
    -> cliente_sexo char (1),
    -> cliente_idt varchar(255) NOT NULL,
nte_cpf    -> cliente_cpf varchar (14) NOT NULL,
    -> cliente_data_nascimento DATE,
    -> cliente_ts timestamp,
    -> PRIMARY KEY (cliente_cod)
    -> );
ERROR 1050 (42S01): Table 'clientes' already exists
mysql> INSERT INTO clientes
    -> (cliente_nome, cliente_sobrenome, cliente_sexo, cliente_idt, cliente_cpf, cliente_data_nascimento, cliente_ts)
    -> VALUES
    -> ('PEDRO', 'LUCAS','M', '123456', '123456789-23', '2021-10-22', localtimestamp),
    -> ('MARCOS', 'MARCUS','M', '1325361', '09876543-54', '2021-11-22', localtimestamp),
'LUC    -> ('LUCIO', 'LEMOS','M', '89678123', '90128934-31', '1968-04-22', localtimestamp),
    -> ('SILVANA', 'LEMOS','F', '1325361', '09876543-54', '1968-06-17', localtimestamp),
    -> ('PAULO', 'PABLO','M', '89678123', '90128934-31', '2021-12-22', localtimestamp),
    -> ('ISAIAS', 'MANOEL','M', '19387134', '2222334134-24', '2021-09-22', localtimestamp);
Query OK, 6 rows affected (0.01 sec)
Records: 6  Duplicates: 0  Warnings: 0

mysql> CREATE DATABASE example_database;
Query OK, 1 row affected (0.01 sec)

mysql> CREATE USER 'example_user'@'%' IDENTIFIED BY 'password';
Query OK, 0 rows affected (0.02 sec)

mysql> GRANT ALL ON example_database.* TO 'example_user'@'%';
Query OK, 0 rows affected (0.01 sec)

luciolemos@dev:~$ mysql -u example_user -p
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 33
Server version: 8.0.34-0ubuntu0.22.04.1 (Ubuntu)

Copyright (c) 2000, 2023, Oracle and/or its affiliates.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> show databases;
+--------------------+
| Database           |
+--------------------+
| example_database   |
| information_schema |
| performance_schema |
+--------------------+
3 rows in set (0.00 sec)

mysql> CREATE TABLE example_database.todo_list (
    -> item_id INT AUTO_INCREMENT,
    -> content VARCHAR(255),
    -> PRIMARY KEY(item_id)
    -> );
Query OK, 0 rows affected (0.04 sec)

mysql> INSERT INTO example_database.todo_list (content) VALUES ("My first important item");
Query OK, 1 row affected (0.01 sec)

mysql> SELECT * FROM example_database.todo_list;
+---------+-------------------------+
| item_id | content                 |
+---------+-------------------------+
|       1 | My first important item |
+---------+-------------------------+
1 row in set (0.00 sec)

mysql> exit
Bye
luciolemos@dev:~$ nano /var/www/dev/todo_list.php

luciolemos@dev:~$ mysql -u example_user -p
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 35
Server version: 8.0.34-0ubuntu0.22.04.1 (Ubuntu)

Copyright (c) 2000, 2023, Oracle and/or its affiliates.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> INSERT INTO example_database.todo_list (content) VALUES ("My last important item");
Query OK, 1 row affected (0.02 sec)

mysql> SELECT * FROM example_database.todo_list;
+---------+-------------------------+
| item_id | content                 |
+---------+-------------------------+
|       1 | My first important item |
|       2 | My last important item  |
+---------+-------------------------+
2 rows in set (0.00 sec)

mysql> exit
Bye
luciolemos@dev:~$ ls -l
total 0
luciolemos@dev:~$ sudo cd /var
[sudo] password for luciolemos:
sudo: cd: command not found
sudo: "cd" is a shell built-in command, it cannot be run directly.
sudo: the -s option may be used to run a privileged shell.
sudo: the -D option may be used to run a command in a specific directory.
luciolemos@dev:~$ cd /
luciolemos@dev:/$ cd var
luciolemos@dev:/var$ ls -l
total 48
drwxr-xr-x  2 root root   4096 Apr 18  2022 backups
drwxr-xr-x 12 root root   4096 Sep 20 22:18 cache
drwxrwxrwt  2 root root   4096 May  1 18:35 crash
drwxr-xr-x 36 root root   4096 Sep 20 22:25 lib
drwxrwsr-x  2 root staff  4096 Apr 18  2022 local
lrwxrwxrwx  1 root root      9 May  1 18:34 lock -> /run/lock
drwxrwxr-x 10 root syslog 4096 Sep 20 22:26 log
drwxrwsr-x  2 root mail   4096 May  1 18:34 mail
drwxr-xr-x  2 root root   4096 May  1 18:34 opt
lrwxrwxrwx  1 root root      4 May  1 18:34 run -> /run
drwxr-xr-x  7 root root   4096 May  1 18:36 snap
drwxr-xr-x  4 root root   4096 May  1 18:35 spool
drwxrwxrwt  5 root root   4096 Sep 20 23:09 tmp
drwxr-xr-x  4 root root   4096 Sep 20 22:26 www

luciolemos@dev:/var$ cd www

luciolemos@dev:/var/www$ cd dev

luciolemos@dev:/var/www/dev$ code .