# yordas_tech_test
Software Engineer - Technical Screen Questions

Please find questions answers in app/public/index.php

### Setup

I will be adding unit tests to this project at a later stage, for now, all the tests are manually logged via comments & var_dump in the index.php

1. Clone the repo
   ```sh
   git clone git@github.com:D3VM4TT/yordas_tech_test.git
   ```
3. Navigate to the project docker directory
   ```sh
   cd yordas_tech_test/docker
   ```
4. Run Docker Compose
   ```sh
   docker-compose up
   ```
5. Open a interactive shell in the docker php container
   ```sh
   docker exec -it docker_php_1 bash
   ```
6. Install depencies using a local installation of composer
   ```sh
   composer install
   ```
7. Project should be running at [http://127.0.0.1:8080/](http://127.0.0.1:8080/)


### Tests
PHPUnit tests can be run be doing the below:
1. Open a interactive shell in the docker php container
   ```sh
   docker exec -it docker_php_1 bash
   ```
2. Make sure you are in the `/var/www directory`
3. Run the below command to run the tests
   ```sh
   vendor/bin/phpunit tests
   ``` 


