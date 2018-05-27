# GraphQL POC in PHP

This project is a proof of concept to test graphQL usage in PHP.  
This work is based mainly on [Symfony framework](https://github.com/symfony/symfony/tree/4.0) and [overblog/GraphQLBundle](https://github.com/overblog/GraphQLBundle/tree/0.11).

This project implements :

* Type system
    * :heavy_check_mark: Scalars
    * :heavy_check_mark: Object
    * :heavy_check_mark: Interface
    * :heavy_check_mark:Union
    * :heavy_check_mark: Enum
    * :heavy_multiplication_x:Input Object
    * :heavy_multiplication_x: Lists
    * :heavy_multiplication_x: Non-Null
* Concepts :
    * :heavy_check_mark: Resolver
    * :heavy_check_mark: Query
    * :heavy_multiplication_x: Type Inheritance
    * :heavy_multiplication_x: Pagination
    * :heavy_multiplication_x: Mutation
    * :heavy_multiplication_x: Promise
    
## Requirement

* git
* composer
* A Symfony 4.0 compatible environment

## Installation

Retrieve repository : 

```
$ git clone git@github.com:Samffy/graphql-poc.git
```

Go to the project directory : 

```
$ cd graphql-poc
```

Install dependencies : 

```
$ composer install
```

Launch Symfony web server : 

```
$ bin/console server:run
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

## Queries

This project use 2 mains types : `Person` and `Vehicle`  
A person has a `Vehicle`.  
A `Vehicle` can be a `Car` or a `Truck`.

Here is an example of a graphQL query :

```graphql
{
  persons(id: "duffy") {
    id
    title
    name
    birth_date
    created_at
    vehicles(id: "cox") {
      id
      manufacturer
      model
      ... on Car {
        seats_number
      }
      ... on Truck {
        maximum_load
      }
    }
  }
}
```
