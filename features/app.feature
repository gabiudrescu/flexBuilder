Feature: Flex builder
  This app will ask you a set of questions, based on which it will compile a list of commands you need to run
  In order to setup your new Symfony Flex app.

  Background:
    Given there are the following components:
      | name         | output |
      | command line | cli    |
      | web server   | web    |

  Scenario: There is a homepage welcoming visitors
    Given I am on the homepage
    Then I should see "Symfony Flex Builder"

  Scenario: There is a form that allows you to select decide if the app is cli or web
    Given I am on the homepage
    And I fill in the following:
      | cli | 1 |
    When I press "Generate"
    Then I should see "composer req cli"
