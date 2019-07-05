# Todo&Co [![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=Dzov_TodoCo&metric=alert_status)](https://sonarcloud.io/dashboard?id=Dzov_TodoCo)

A to do list application to manage your daily tasks.

Registered users can create, update and delete tasks. 
Tasks can be flagged as important and marked as done or in progress. 
Tasks can also be filtered based on priority and status.

Admin users can create, edit or delete users.  

## Getting Started

### Installing

Install the project on your computer.
```
git clone git@github.com:Dzov/TodoCo.git
```

Install the dependencies using composer.
```
composer install
```

#### Database and fixtures
In the `.env` file at the root of the project, adapt the `DATABASE_URL` variable by replacing the parameters `db_user`, `db_password` and `db_name` with your own configuration.

Create a new database by executing the command `php bin/console doctrine:database:create`. 
Then, execute the command `php bin/console doctrine:schema:update --force` in order to create the different tables based on the entity mapping. 

Once your database has been properly set up, run the following command in order to import the data fixtures : `php bin/console doctrine:fixtures:load --group=AppFixtures
`

### Tests

In order to run the tests, execute the following command in the console : 
``` php bin/phpunit ```

## Resources 

Code quality has been analyzed with [SonarCloud](https://sonarcloud.io/dashboard?id=Dzov_TodoCo)

The different issues can be found on [Github](https://github.com/Dzov/TodoCo/issues)

## Versioning

I used [GitHub](https://github.com/Dzov/TodoCo) for versioning. 

## Authors

**Amélie-Dzovinar Haladjian** 

## Acknowledgments

Many thanks to my mentor Sébastien Duplessy

