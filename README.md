## About

Fitness REST API is an application which helps people to training at home. We want to share a healthy lifestyle.

## Installation
```
# Download using composer
git clone git@github.com:ViachViach/FitnessBack.git
```

## Getting Started

### Docker
This project store docker images. Download docker application to your machine if you don't have it. Open your terminal:
    
    cd /path/to/your_project_folder
    docker-compose up -d --build

### Composer
Make composer install:

    docker-compose exec php-fitnes /bin/sh
    composer install

### JWT token 

```
# Create folder
mkdir ./config/jwt

# Generate keys
openssl genpkey -out ./config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
openssl pkey -in ./config/jwt/private.pem -out config/jwt/public.pem -pubout
```

### Code style and test
You can check code style and test locally:

    composer check

### Application
Your application is available on localhost:81
Swagger documentation localhost:81/api/doc
