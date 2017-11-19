Symfony App Flex Builder
=========

This application is meant to provide you a tool to configure your Flex instance by asking you the right questions.

My first experience with Symfony Flex was a bit different from what I've seen in the demo videos on the internet, mainly
because I have bumped into the situation of not knowing what I don't know.

I personally find that switching from an opinionated framework such as Symfony 3.3 to the new concept of Symfony Flex brings
quite a big cognitive load.

Not a bad thing, but a bit difficult in the beginning.

Enter Flex Builder
-----------------

The Flex Builder is a basic Symfony app that asks you a few questions about the app you are starting to build, in order to suggest
you some of the packages you might be needing during the development.

Instead of finding out yourself that you need the templating engine in your web app, why not make a list of requirements in the begining?

Just like going out to buy groceries: it's better with a shopping list :)

How it works?
-------------

A wizard-like form that asks you a few question, compiles all the boolean answers into a command line you need to run in your console.

For example, if you say you are building an web app, with a user interface with forms, that delivers emails to your customers, 
it will suggest you to install the followings:
 
 - webserver
 - twig
 - form
 
 All by running this command: `composer req webserver twig form`
 
 You'll be able to save your configuration under one URL, so you can later refer to it - in case you might need it.
