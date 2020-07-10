.. _automated-test:

.. index::
    single: Testing; Functional Testing

:title: Automated Tests Implementation in OroCommerce, OroCRM, OroPlatform 3.1

.. meta::
   :description: Principles of writing functional tests in the preconfigured testing environment with detailed guidance and examples

Automated Tests
===============

OroCommerce comes with a multitude of features that you can configure in a variety of ways to fulfill your specific business needs. To ensure all the built-in features work as expected, no matter what configuration combination business is using, Oro developers write tests. Since OroCommerce has many features, automated testing is a big part of the development. From the project start, we have been writing unit and functional tests, which help to test the application architecture and programming APIs.

However, these kinds of tests give developers no guaranty that when the user opens a page, everything is going to work as expected. For this reason, we use Behat Behavior-Driven Development framework, which instead of relying on the source code behaves like an actual user. It can emulate the user very well, run tests in a real web browser, and uses a business-readable, domain-specific language called Gherkin to describe tests.

Follow the links below to learn how to use automated tests for Oro applications:


.. toctree::
   :maxdepth: 1

   functional
   behat