@documentation
Feature: Check document email and sms activities

  Scenario: Check email activity
    Given the following document:
      | subject  | description  |
      | subject1 | description1 |
    When I login as administrator
    And I go to Acme/Demo/Documents
    And click view subject1 in grid
    And click "Send email"
    And fill form with:
      | Subject | Document email subject |
      | To      | admin@example.com      |
      | Body    | Document email body    |
    And click "Send"
    Then I should see "The email was sent" flash message

    When I click My Emails in user menu
    Then I should see following grid:
      | Contact | Subject                                    |
      | me      | Document email subject Document email body |

  Scenario: Send new activity sms from document view page
    When I go to Acme/Demo/Documents
    And click view subject1 in grid
    And click "Send sms"
    And fill form with:
      | From Contact | contact_email_1@gmail.com |
      | To Contact   | contact_email_2@gmail.com |
      | Message      | Sms message               |
    And click "Save"
    Then I should see "Saved successfully" flash message
    And  I should see only following actions on "Sms message" in activity list:
      | Add Context |
      | View Sms    |
      | Update Sms  |
      | Delete Sms  |

  Scenario: Add Context Sms in activity list
    When I click "Add Context" on "Sms message" in activity list
    Then I should see following "Document Context Grid" grid containing rows:
      | Subject  | Description  |
      | subject1 | description1 |
    And close ui dialog

  Scenario: View Sms in activity list
    When I click "View Sms" on "Sms message" in activity list
    Then I should see sms activity with:
      | From Contact | contact_email_1@gmail.com |
      | To Contact   | contact_email_2@gmail.com |
      | Message      | Sms message               |

  Scenario: Check activity in priority update page
    When I go to Acme/Demo/SMS messages
    Then I should see following grid containing rows:
      | From Contact              | To Contact                | Contexts              |
      | contact_email_1@gmail.com | contact_email_2@gmail.com | subject1 description1 |

  Scenario: Update Sms in activity list
    When I go to Acme/Demo/Documents
    And click view subject1 in grid
    And I click "Update Sms" on "Sms message" in activity list
    And fill form with:
      | From Contact | new_contact_email_1@gmail.com |
      | To Contact   | new_contact_email_2@gmail.com |
      | Message      | Sms message new               |
    And click "Save"
    Then I should see "Saved successfully" flash message
    And I collapse "Sms message new" in activity list
    And I should see sms activity with:
      | From Contact | new_contact_email_1@gmail.com |
      | To Contact   | new_contact_email_2@gmail.com |

  Scenario: Delete Sms in activity list
    When I collapse "Sms message new" in activity list
    And I click "Delete Sms" on "Sms message new" in activity list
    And confirm deletion
    Then I should see "Activity item deleted" flash message
    And I see no records in activity list

  Scenario: Check activity in priority update page
    When I go to Acme/Demo/Priorities
    And click view minor in grid
    And I should not see "Log call"
    And click "Edit Priority"
    And click "Log call"
    And fill "Log Call Form" with:
      | Subject             | Proposed Charlie to star in new film |
      | Additional comments | Charlie was in a good mood           |
      | Call date & time    | <DateTime:2017-08-24 11:00:00>       |
      | Phone number        | (310) 475-0859                       |
      | Duration            | 00:05:30                             |
    When I click "Log call"
    Then I should see "Call saved" flash message
    And should see "Proposed Charlie to star in new film" call in activity list
