@vehicles
Feature: Test vehicles queries

  Scenario: Ask for vehicles list
    When I submit the query vehicles_list
    And the json response must be equals to vehicles_list json response

  Scenario: Filter vehicles list using vehicle ID
    When I submit the query vehicles_filter_id
    And the json response must be equals to vehicles_filter_id json response

  Scenario: Filter vehicles list using owner ID
    When I submit the query vehicles_filter_owner
    And the json response must be equals to vehicles_filter_owner json response

  Scenario: Filter vehicles list using owner ID and vehicle ID
    When I submit the query vehicles_filters_id_owner
    And the json response must be equals to vehicles_filters_id_owner json response