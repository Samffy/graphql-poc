@truck
Feature: Test truck queries

  Scenario: Get truck by id
    When I submit the query truck_filter_id
    And the json response must be equals to truck_filter_id json response

  Scenario: Create, update and delete a truck
    When I submit the query truck_create
    And the json response must be equals to truck_create json response
    # Trying to create a duplicate of the previous truck using the same ID
    When I submit the query truck_create
    Then The json element at "[errors][0][message]" should be equal to "Truck [VHJ1Y2s6c3BlZWQ=] already exist"
    When I submit the query truck_update
    And the json response must be equals to truck_update json response
    When I submit the query truck_delete
    And the json response must be equals to truck_delete json response
    # Trying to delete an already deleted truck using its ID
    When I submit the query truck_delete
    Then The json element at "[errors][0][message]" should be equal to "Vehicle [VHJ1Y2s6c3BlZWQ=] not found"

  Scenario: Invalid truck mutation
    When I submit the query truck_create_invalid
    Then The json element at "[errors][0][fields][0][field]" should be equal to "model"
    Then The json element at "[errors][0][fields][0][message]" should be equal to "This value should not be blank."
