# TFG IAramburu Symptom API

Service implemented in Python 3.12 + Django 4.2 to be used as part of a learning process of a CI/CD flow.


Here is the general architecture of the application. This repository only contains the Symptom API module.

![General architecture](doc/img/diagram.png)

### Requirements

The requirements to deploy:
- Docker
- Docker-compose
- Make

# APACHE


### Exposed Ports
|  Services  |  Exposed  |  Docker  |
|:----------:|:---------:|:--------:|
|   HTTP     |   9081    |    80    |
|   HTTPS    |   9041    |    443   |


# Mysql

### Exposed Ports
|  Services  |  Exposed  |  Docker  |
|:----------:|:---------:|:--------:|
|   Mysql     |   3316    |   3306   |


### Environment Variables
This is the default value of the environment variables:

   - MYSQL_ROOT_PASSWORD Maite123
   - MYSQL_DATABASE listsymptom
   - MYSQL_USER listsymptom
   - MYSQL_PASSWORD contrasena_listsymptom
   - DATABASE_HOST 127.0.0.1
   - DATABASE_PORT 3306

### Mandatory variables
If these variables are not set the container does not start
   - MYSQL_ROOT_PASSWORD
   - MYSQL_DATABASE
   - MYSQL_USER 
   - MYSQL_PASSWORD
   - DATABASE_HOST

## Certificates
To generate SSL certificates for the development environment, [minica](https://github.com/inakiAramburu/TFG/tree/main/devopsutility) has been utilized.

A wildcard certificate has been employed in the certificate generation to encompass all domains under 'tfg.test,' thereby simplifying certificate management. It is important to note that when using certificates in containers, container names must end with 'tfg.test' to ensure proper certificate functionality.


# Getting Started


To initiate the API, execute the following command:

```bash
make start
```

For further guidance on what `make` can accomplish, just input the following command:

```bash
make help
```

---


