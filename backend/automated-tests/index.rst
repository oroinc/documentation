.. index::
    single: Testing; Functional Testing

:title: Automated Tests Implementation in OroCommerce, OroCRM, OroPlatform

.. meta::
   :description: Principles of writing functional tests in the preconfigured testing environment with detailed guidance and examples

.. _automated-test:

Automated Tests
===============

Oro applications come with many features you can configure in various ways to fulfill your specific business needs. To ensure all the built-in features work as expected, no matter what configuration combination the business is using, Oro developers write tests. Since the application has many features, automated testing is a big part of the development. From the project start, we have been writing unit and functional tests, which help to test the application architecture and programming APIs.

However, these tests give developers no guarantee that when the user opens a page, everything will work as expected. For this reason, we use Behat Behavior-Driven Development framework, which behaves like an actual user instead of relying on the source code. It can emulate the user very well, run tests in a real web browser, and uses a business-readable, domain-specific language called Gherkin to describe tests.

Follow the links below to learn how to use automated tests for Oro applications:


.. toctree::
   :maxdepth: 1

   End-to-End <e2e>
   Integration <behat>
   Functional <functional>