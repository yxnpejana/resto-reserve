# Sprobe Laravel Vue Boilerplate
A base template for VueJS with backend API implementation using `Laravel 5.8.37` preconfigured `laravel/passport` authentication.

## Specifications / Infrastructure Information
- Nginx
- PHP-FPM
- MySQL
- Postfix
- CS-Fixer
- Data Volume
- Composer
- Cron
- Node/NPM
- Redis

## Prerequisites
- GIT
- Docker / Docker Toolbox with a running Docker Machine OR Docker for Windows

# Getting Started
Setup the `.env` file for Docker in the root directory  
```
cp .env.example .env
```
Make sure to fillup the following variables
```
ENVIRONMENT=development                 # development/staging/production
PROJECT_NAME=YOUR_PROJECT_NAME_HERE     # Prefix for the Docker Containers to be created
MYSQL_ROOT_PASSWORD=p@ss1234!           # root password of the root mysql user
MYSQL_DATABASE=YOUR_DATABASE_NAME       # use this value in src/backend/.env
MYSQL_USER=YOUR_DATABASE_USER           # use this value in src/backend/.env
MYSQL_PASSWORD=YOUR_DATABASE_USER       # use this value in src/backend/.env
....
....
....
API_DOMAIN=api.tcg.local // for local development
APP_DOMAIN=tcg.local // for local development
```
For Local Development in windows, add the following lines to `C:\Windows\System32\drivers\etc\hosts` or `/etc/hosts` for ubuntu  
```
192.168.99.100    tcg.local api.tcg.local
```
Note: Replace `192.168.99.100` with your Docker Machine IP.  
  
## Build the all containers  
```
docker-compose build
```
To build/rebuild a specific container, run the following command, CONTAINER_NAME is from the `docker-compose.yml`  
```
docker-compose build CONTAINER_NAME
```
Start the containers  
```
docker-compose up -d
```
Run the following command to login to any Docker Container  
```
docker exec -it CONTAINER_NAME bash
```
## Setting up Laravel
Install the composer packages  
```
docker-compose run composer install
```
Create the `.env` file and run the following to generate key for Laravel  
```
docker-compose run php cp .env.example .env
docker-compose run php php artisan key:generate
```
Update the `.env` values especially the database credentials then refresh the config  
```
docker-compose run php php artisan config:clear
```
Run the migration
```
docker-compose run php php artisan migrate:fresh
```
If you have seeders, you can run it by using the following command
```
docker-compose run php php artisan db:seed
```

---
Run the Laravel Passport installation
```
docker-compose run php php artisan passport:install --force
```
Copy the generated password grant Client ID & Secret in the `.env` file
```
API_CLIENT_ID={COPY FROM TERMINAL}
API_CLIENT_SECRET={COPY FROM TERMINAL}
API_VERSION=v1
```
After setting up all the values in the `.env` file, run the following command to make sure the environment variables are updated successfully.  
```
docker-compose run php php artisan config:clear
```
---

## PSR2 Coding Style
Running the Coding Standards Fixer Container  
  
To check without applying any fixes, run the following command:
```
docker-compose run fixer fix --dry-run -v
```
To fix all your PHP code to adhere the PSR2 Coding style, run:
```
docker-compose run fixer fix
```
To Apply fix only to a specific file
```
docker-compose run fixer fix <<file_name>>
```

## Unit Testing
PHPUnit
- Running a Test Case
```
docker-compose run php ./phpunit tests/<<test_file>>
```
- Running the whole Test Suite
```
docker-compose run php ./phpunit
```
The code coverage result will be available at  
<https://API_DOMAIN/report>
  
The code coverage logs will be available at  
<https://API_DOMAIN/report/logs>
  

## FRONTEND
This package uses VueJS as frontend framework. This docker setup will automatically serve the Vue on `docker-compose up -d`.  

All source code for frontend development is in `src/frontend` directory.

## Lint
To check if your Javascript code adheres the standard, run the following command
```
docker-compose run node yarn lint
```