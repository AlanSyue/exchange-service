# Currencies Exchange Service

# Requirement
docker and docker-compose: https://www.docker.com/products/docker-desktop

# Getting Started
## Set up the container.
```bash
$ cd docker/
$ cp .env.example .env
$ docker compose up -d
```

## Install the packages.
```bash
$ cd docker/
$ docker compose exec workspace sh
$ cp .env.example .env
$ composer install
$ php artisan key:generate
```

## Access to the website.
Clik the [link](http://localhost:9001/) and you will see the screen like below:
<img width="1440" alt="image" src="https://user-images.githubusercontent.com/33183531/179238560-86556188-fe1f-4faa-ba82-2a37510174bf.png">

# Currencies Exchange API
## API document
see [Stoplight](https://currency.stoplight.io/docs/currency/branches/main/4f0802bbb1fc7-exchange-the-currencies)

## Test API using CURL
```console
curl --request POST \
  --url http://localhost:9001/api/currencies/exchange \
  --header 'Content-Type: application/json' \
  --data '{
  "from": "USD",
  "to": "TWD",
  "amount": 10
}'
```

response
```console
{
  "data": {
    "amount": "304.44"
  }
}
```

# Sequence Diagram
![seq](https://user-images.githubusercontent.com/33183531/179241117-e3808b47-715f-403b-af15-573ddd3254f3.png)

# Class Diagram
![class](https://user-images.githubusercontent.com/33183531/179243350-f382c7ef-7005-488a-9ac1-a318f8580915.png)

# Automated Test
## Feature Test
```bash
$ cd docker/
$ docker compose exec workspace sh
$ ./vendor/bin/phpunit tests/Feature/CurrencyControllerTest.php
```

## Unit Test
```bash
$ cd docker/
$ docker compose exec workspace sh
$ ./vendor/bin/phpunit tests/Unit/Currency/ExchangeServiceTest.php
```

## Run test in CI
see [GitHub Action](https://github.com/AlanSyue/exchange-service/runs/7361505456?check_suite_focus=true)
