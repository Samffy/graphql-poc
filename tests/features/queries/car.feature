@car
Feature: Test car queries

  Scenario: Get car by id
    When I submit the query car_filter_id
    And the json response must be equals to car_filter_id json response

  Scenario: Create, update and delete a car
    When I submit the query car_create
    And the json response must be equals to car_create json response
    # Trying to create a duplicate of the previous car using the same ID
    When I submit the query car_create
    Then The json element at "[errors][0][fields][0][message]" should be equal to "Car [Q2FyOnRpbWU=] already exist"
    When I submit the query car_update
    And the json response must be equals to car_update json response
    When I submit the query car_delete
    And the json response must be equals to car_delete json response
    # Trying to delete an already deleted car using its ID
    When I submit the query car_delete
    Then The json element at "[errors][0][message]" should be equal to "Car [Q2FyOnRpbWU=] not found"

  Scenario: Invalid car mutation creation
    When I submit the query car_create_invalid
    Then The json element at "[errors][0][fields][0][name]" should be equal to "manufacturer"
    Then The json element at "[errors][0][fields][0][message]" should be equal to "This value is too short. It should have 2 characters or more."

  Scenario: Trying to update a none existing car
    When I submit the query car_update_invalid
    Then The json element at "[errors][0][fields][0][name]" should be equal to "id"
    Then The json element at "[errors][0][fields][0][message]" should be equal to "Car [Q2FyOmJhdG1vYmlsZQ==] not found"
