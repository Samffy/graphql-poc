@persons
Feature: Test persons queries

  Scenario: Ask for persons list
    When I submit the query persons_list
    And the json response must be equals to persons_list json response

  Scenario: Filter persons list using person ID
    When I submit the query persons_filter_id
    And the json response must be equals to persons_filter_id json response

  Scenario: Filter persons list using person ID and ask for all available data
    When I submit the query persons_filter_id_expand_all
    And the json response must be equals to persons_filter_id_expand_all json response