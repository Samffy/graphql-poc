@persons
Feature: Test persons queries

  Scenario: Ask for persons list
    When I submit the query persons_list
    And the json response must be equals to persons_list json response