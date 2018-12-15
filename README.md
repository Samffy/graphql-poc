# GraphQL POC in PHP

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT) 
[![Build Status](https://travis-ci.org/Samffy/graphql-poc.svg?branch=master)](https://travis-ci.org/Samffy/graphql-poc) 
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Samffy/graphql-poc/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Samffy/graphql-poc/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/10471f85-68a0-4ca6-8f22-3f8ac34dfb89/mini.png)](https://insight.sensiolabs.com/projects/10471f85-68a0-4ca6-8f22-3f8ac34dfb89)

This project is a proof of concept to test graphQL usage in PHP.  
This work is based mainly on [Symfony framework](https://github.com/symfony/symfony/tree/4.1) and [overblog/GraphQLBundle](https://github.com/overblog/GraphQLBundle/tree/0.11).

This project implements :

* Type system
    * :heavy_check_mark: Scalars
    * :heavy_check_mark: Object
    * :heavy_check_mark: Interface
    * :heavy_check_mark: Union
    * :heavy_check_mark: Enum
    * :heavy_check_mark: Input Object
    * :heavy_check_mark: Lists
    * :heavy_check_mark: Non-Null
* Concepts :
    * :heavy_check_mark: Resolver
    * :heavy_check_mark: Query
    * :heavy_check_mark: GlobalId
    * :heavy_multiplication_x: Type Inheritance
    * :heavy_check_mark: Pagination
    * :heavy_check_mark: Mutation
    * :heavy_multiplication_x: Promise
    * :heavy_check_mark: Validation
    
## Requirement

* git
* composer
* PHP 7.1.3 or higher
* PDO-SQLite PHP extension enabled
* [a Symfony 4.2 compatible environment](https://symfony.com/doc/current/reference/requirements.html)

## Installation

Retrieve repository : 

```
$ git clone git@github.com:Samffy/graphql-poc.git
```

Go to the project directory : 

```
$ cd graphql-poc
```

Install and launch project using : 

```
$ make deploy
```

Go to : http://localhost:8000/graphiql

In `dev` mode, Symfony profiler is available at `/_profiler`.

## GraphQL

### Schema

You can consult the graphQL schema here :  
https://github.com/Samffy/graphql-poc/blob/master/config/graphql/schema.graphql

If you update this project, you can dump the new version of the GraphQL schema using this command : 

```
$ bin/console graphql:dump-schema --format=graphql --file=./config/graphql/schema.graphql
```

### Queries

This project use 2 mains types : `Person` and `Vehicle`  
A person has a `Pet` and one `Vehicle` or more.   
A `Pet` can be a `Dog`, a `Cat` or a `Bear`.  
A `Vehicle` can be a `Car` or a `Truck`.

Here is an example of a graphQL query :

```graphql
{
    persons(id: "UGVyc29uOmR1ZmZ5") {
        id
        title
        name
        birth_date
        created_at
        pet {
            ...on Animal {
                id
                name
                breed
            }
        }
        vehicles {
            id
            manufacturer
            model
            ...on Car {
                seats_number
            }
            ...on Truck {
                maximum_load
            }
        }
    }
}
```

You can find many examples in the [functional tests](tests/features/bootstrap/resources/graphql_query).

## Developer tools

This project use `Makefile` to simplify application usage.  
[Take a look](Makefile), you will find some useful commands.

### Database

This application use SQLite. Database is versioned and available in the `/var/app.db` file.  
Schema is available in the [original migration](src/Migrations/Version20180624103144.php). 

### Fixtures

If you corrupt data you can drop database and reload fixtures using this command : 

```
$ make install
```

### Tests

There is some functional tests, read it to see some useful examples.  
It basically launch [queries](tests/features/bootstrap/resources/graphql_query/) and check response.  

To launch them use : 

```
$ make integration
```

:warning: It will truncate database and dump default fixtures.
