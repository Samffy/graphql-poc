@car
Feature: Test car queries

  Scenario: Get car by id
    When I submit the query car_filter_id
    And the json response must be equals to car_filter_id json response