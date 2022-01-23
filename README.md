# GildedRose Kata - PHP Version

Original Gilded kata PHP : https://github.com/emilybache/GildedRose-Refactoring-Kata/tree/main/php


## Installation

Either use Docker using the image of this project : 


```shell script
docker pull ghcr.io/resshins/gildedrose-refactoring:v1
```

It contains an image of apache2 with PHP 8.1 with the source of this project.
Then 

```shell script
docker run -d -p 80:80 <image_id>
```

as a reminder, you can retrieve the image id with : 

```shell script
docker image list
```


Either get the source file using :  

```shell script
git clone https://github.com/resshins/GildedRose-Refactoring-Kata-reviewed.git
```

Then  use a webserver (apache, nginx, etc) to run the code

## Docker compilation

2 files required : 

docker-compose.yml : 

```shell script
version : '3.8'
services:
  php:   
    build:
      context: .
      dockerfile: ./Dockerfile-WebSrv
    image: php:8.1-apache
    container_name: apachephpcont
    ports:   
      - 80:80
    volumes: 
      - ./GildedRose-Refactoring-Kata-reviewed:/var/www/html/ 
```


Dockerfile-WebSrv : 

```shell script
FROM php:8.1-apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN service apache2 restart
COPY GildedRose-Refactoring-Kata-reviewed /var/www/html/
RUN chown -R www-data:www-data /var/www/html
```

To compile the source : 

```shell script
docker-compose up --build -V
```


## Folders

- `src` - contains the two classes:
    - `Item.php` - this class should not be changed
    - `GildedRose.php` - this class is refactored 
- `tests` - contains the tests
    - `GildedRoseTest.php` - starter test.
- `index.php` - basic page to give an example of usage
- `Fixture`
    - `texttest_fixture.php` this could be used by an ApprovalTests, or run from the command line


## Testing

PHPUnit updated to cover all business rules. 

```shell script
composer test
```
