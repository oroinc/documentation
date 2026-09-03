:title: OroCommerce AI Development Platform

.. meta::
   :description: Learn about the AI Development Platform and how to request access to its Claude Code plugins for OroCommerce delivery.

.. _ai-development-platform:

OroCommerce AI Development Platform
===================================

The AI Development Platform is part of OroMomentum, Oro's ongoing AI program for OroCommerce delivery. It packages Oro's own development practices, including planning, coding conventions, code review, and testing, into a set of Claude Code plugins, so an AI agent works against the same standards your engineers already follow.

The complete technical documentation, including installation steps, the full plugin and skill catalog, and usage guides, is maintained in a private GitHub repository, so it never falls out of sync with what actually ships.

Included Plugins
----------------

The AI Development Platform is a Claude Code plugin marketplace built for OroCommerce delivery. It ships as nine plugins: six map to stages of the development lifecycle, plus shared plugins for project setup, for running the full workflow end to end, and for general utilities. You register the marketplace once per machine, and then install only the plugins that a given project needs. Installing a single plugin does not require adopting the rest.

.. csv-table::
   :header: "Plugin", "What It Covers"
   :widths: 25, 75

   "Foundation", "Project conventions and environment diagnostics"
   "Discovery", "Ticket requirements, development and design plans, and OroCommerce documentation lookup"
   "Design", "Storefront theme scaffolding, color palettes, and favicons"
   "Development", "Backend and frontend implementation across the OroCommerce stack"
   "Review", "Multi-lens code review covering architecture, security, and best practices"
   "Testing", "Browser-driven verification of a running application"
   "Maintenance", "Error investigation, root-cause analysis, and performance analysis"
   "Orchestrator", "Runs the plan, build, review, and verify stages as a single guided workflow"
   "Utility", "General-purpose helpers, such as exporting a session to Markdown"

Ways to Work with the Plugins
-----------------------------

You can run the plugins one stage at a time, with a single command per stage and full control over sequencing. Alternatively, you can hand a ticket to the orchestrator plugin, which runs the full plan, build, review, and verify sequence and pauses only where it needs a decision from you. Both approaches run the same automated checks, and both still require a person to review and approve the result before anything merges. The platform does not remove that step in either mode.

Secure Execution Environment
----------------------------

The plugins run through Claude Code, which supports two ways of working. Inside a container, Claude Code can see only the target project directory — it cannot reach SSH keys, credentials, or other repositories on the host. That boundary is what allows the platform to grant the agent real autonomy in a container without a constant stream of manual approval prompts.

Claude Code can also run directly on a developer's machine. This mode is also supported, but it is not sandboxed: the agent runs with the developer's own privileges, so the standard permission prompts stay in place as the safeguard instead.

Either way, project conventions are recorded once per project so every agent works from the same rules, and every change still passes automated checks and a senior engineer's review before it merges.

Current Status
--------------

The AI Development Platform is in an active pilot under the OroMomentum program, available to a limited group of Oro partners and customers. It is an early, fast-moving release, and Oro is opening it up specifically so partner feedback can shape how it develops.

Getting Access
--------------

Access to the AI Development Platform is granted through the OroMomentum program.

.. hint:: To request access, submit the join form on the |OroMomentum program page|. Oro shares the relevant repositories with the GitHub accounts your team provides. You can also contact your Oro representative directly.


.. include:: /include/include-links-dev.rst
   :start-after: begin
