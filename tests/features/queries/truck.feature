@truck
Feature: Test truck queries

  Scenario: Get truck by id
    When I submit the query truck_filter_id
    And the json response must be equals to truck_filter_id json response