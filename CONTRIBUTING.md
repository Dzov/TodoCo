# Contribute !

## Set up 

1. Fork the project on your own repository
2. Clone the project locally
3. Follow the [instructions](https://github.com/Dzov/TodoCo/blob/master/README.md) to properly install the project

## General guidelines 

In order to maintain a good quality level and facilitate the app's maintenance, there are a few guidelines to follow. 

- To facilitate code navigation, the different classes are filed under subdirectories within the main source directories (ie: src/Controller/Task/EditTaskController).
- For better maintainability the source code respects the Single Responsibility Principle. As such, you may implement only one action per controller for example.
- To facilitate both the implementation of unit tests and code reusability, controllers should not contain any business logic.
- Business and application logic were dispatched within use cases and entities. A use case reflects a user intention and contains application logic, that is logic tied to a specific functionality within a specified context (ie: CreateTask). Business logic, that is a behavior that should be available throughout the application, should be contained within the entity.
- To facilitate readability the code within a class should be broken down in small methods with explicit names. 
 

## Contributing
1. Create a new branch with an explicit name : 01-fix_header
``` git checkout -b branchNumber-branch_name ```
2. Follow the general guidelines to properly implement a bug fix or new feature
3. Add or update existing tests
4. Push your code on your own repository 
``` git push origin branchNumber-branch_name ```
5. Create a [pull request](https://help.github.com/en/articles/creating-a-pull-request-from-a-fork) on the [source repository](https://github.com/Dzov/TodoCo/compare?expand=1)

## Code quality 
Make sure all tests pass before creating a pull request 

To run all tests execute the following command
 
``` php bin/phpunit ```

To only run unit tests you can execute
 
``` php bin/phpunit --testsuite unit ```


