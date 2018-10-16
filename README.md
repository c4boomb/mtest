Installation
------------

1. Clone repository
2. `composer install`

Requirements
------------
PHP >= 7.0.5

Example
-------
#### #1 Task

`php application.php app:generate:combinations exampleInput.txt` 

#### #2 Task

`php application.php app:count:water exampleInput2.txt` 

Help
----
Add --help to get help for each command

Run `php application.php` to get list of all commands

Algorithms are in 
-----------------

`src/Service/CombinationsGenerator.php` for first task

`src/Service/WaterCounter.php` for second task



Dependencies
------------
`symfony/console` for console commands

`symfony/dependency-injection` for dependency injection

`symfony/config` and `symfony/yaml` for config processing 
