@person
Feature: Test person queries

  Scenario: Get person by id
    When I submit the query person_filter_id
    And the json response must be equals to person_filter_id json response