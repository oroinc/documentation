@documentation
@fixture-AcmeDemoBundle:documents.yml

Feature: Check user extend field

  Scenario: Check User entity extend field
    Given I login as administrator
    When I go to System / Entities / Entity Management
    And filter Name as is equal to "User"
    And I click View User in grid
    And I should see following grid containing rows:
      | Name                              | Label                        | Data Type    |
      | internal_rating                   | Internal rating              | Select       |
      | partner_since                     | Partner since                | DateTime     |
      | doc1_many_to_one_unidirect_rel    | Doc1 ManyToOneUnidirectRel   | Many to one  |
      | doc2_many_to_one_bidirect_rel     | Doc2 ManyToOneBidirectRel    | Many to one  |
      | doc3_many_to_many_unidirect_rel   | Doc3 ManyToManyUnidirectRel  | Many to many |
      | doc4_many_to_many_unidirect_w_rel | Doc4 ManyToManyUnidirectWRel | Many to many |
      | doc5_one_to_many_unidirect_rel    | Doc5 OneToManyUnidirectRel   | One to many  |
      | doc6_one_to_many_unidirect_w_rel  | Doc6 OneToManyUnidirectRel   | One to many  |
      | doc7_one_to_many_bidirect_rel     | Doc7 OneToManyBidirectRel    | One to many  |
      | doc8_one_to_many_bidirect_w_rel   | Doc8 OneToManyBidirectWRel   | One to many  |

  Scenario: Check User View extend field
    When go to System/User Management/Users
    And I click View John in grid
    And I should see user with:
      | Username                     | admin |
      | Partner Since                | N/A   |
      | Internal Rating              | N/A   |
      | Doc1 ManyToOneUnidirectRel   | N/A   |
      | Doc2 ManyToOneBidirectRel    | N/A   |
      | Doc3 ManyToManyUnidirectRel  | N/A   |
      | Doc4 ManyToManyUnidirectWRel | N/A   |
      | Doc5 OneToManyUnidirectRel   | N/A   |
      | Doc6 OneToManyUnidirectRel   | N/A   |
      | Doc7 OneToManyBidirectRel    | N/A   |
      | Doc8 OneToManyBidirectWRel   | N/A   |
    And I click "Edit profile"
    And I fill form with:
      | Partner Since              | <Date:Jul 01, 2022> |
      | Internal Rating            | 5                   |
      | Doc1 ManyToOneUnidirectRel | Document1           |
      | Doc2 ManyToOneBidirectRel  | Document2           |

  Scenario Outline: Add relation Outline
    And I click button "Add" on "<TypeRel>"
    And click on <DocumentRel> in grid
    And I click "Select"
    Examples:
      | TypeRel                      | DocumentRel |
      | Doc3 ManyToManyUnidirectRel  | Document3   |
      | Doc4 ManyToManyUnidirectWRel | Document4   |
      | Doc5 OneToManyUnidirectRel   | Document5   |
      | Doc6 OneToManyUnidirectRel   | Document6   |
      | Doc7 OneToManyBidirectRel    | Document7   |
      | Doc8 OneToManyBidirectWRel   | Document8   |

  Scenario: Save user
    When I save and close form
    Then I should see "User saved" flash message
    And I should see user with:
      | Username                     | admin                 |
      | Partner Since                | Jul 1, 2022, 12:00 AM |
      | Internal Rating              | 5                     |
      | Doc1 ManyToOneUnidirectRel   | 1                     |
      | Doc2 ManyToOneBidirectRel    | 2                     |
      | Doc3 ManyToManyUnidirectRel  | Document3             |
      | Doc4 ManyToManyUnidirectWRel | Document4             |
      | Doc5 OneToManyUnidirectRel   | Document5             |
      | Doc6 OneToManyUnidirectRel   | Document6             |
      | Doc7 OneToManyBidirectRel    | Document7             |
      | Doc8 OneToManyBidirectWRel   | Document8             |

  Scenario: Check inverse relation by Document
    When I go to Acme/Demo/Documents
    And I click "Edit" on row "Document2" in grid
    And I should see "Users2 ManyToOneBidirectRel"
    And click "Cancel"

    And I click "Edit" on row "Document7" in grid
    And I should see "Users7 OneToManyBidirectRel"
    And click "Cancel"

    And I click "Edit" on row "Document8" in grid
    And I should see "Users8 OneToManyBidirectWRel"
    And click "Cancel"
