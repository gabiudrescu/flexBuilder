Feature: Flex builder
  This app will ask you a set of questions, based on which it will compile a list of commands you need to run
  In order to setup your new Symfony Flex app.

  Background:
    Given there are the following components:
      | name         | output | package         | type      |
      | command line | cli    | https://packagist.org/packages/symfony/console           | Official  |
      | web server   | web    | https://packagist.org/packages/symfony/web-server-bundle | Official  |

  Scenario: There is a homepage welcoming visitors
    Given I am on the homepage
    Then I should see "Symfony Flex Builder"

  Scenario: There is a form that allows you to select decide if the app is cli or web
    Given I am on the homepage
    And I fill in the following:
      | cli | 1 |
    When I press "Generate"
    Then I should see "composer req cli"

  Scenario: If I don't select any component, I will see an error
    Given I am on the homepage
    When I press "Generate"
    Then I should see "Please select at least one component"
