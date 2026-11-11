.. _concept-guide--digital-sales-room:

.. important:: The Digital Sales Room feature is under development and is not available in current releases. This page describes the planned concept. The capabilities of the released feature may differ from the description below.

Digital Sales Rooms in OroCommerce
==================================

In traditional B2B e-commerce, the purchasing process is often fragmented. Buyers browse a storefront, but negotiate via email, exchange documents through file shares, and receive quotes as static PDF attachments. This disconnect creates friction, slows down deals, and leads to version control issues. The OroCommerce Digital Sales Room (DSR) is designed to address this.

+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
|  **A DSR is a buyer-specific, deal-scoped, persistent digital workspace that centralizes product selection, pricing, negotiation, documents, and communication within        |
|  a single structured interface in the OroCommerce Storefront.**                                                                                                              |
+------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

It is designed for assisted B2B sales, where purchasing decisions require collaboration, negotiation, and coordination between multiple stakeholders. Instead of relying on fragmented communication and disconnected tools, buyers and sellers can work together in a single shared environment.

The Digital Workspace
---------------------

A Digital Sales Room is a workspace that a member of a sales team builds for a client. It represents a single active deal and acts as a shared workspace for both buyers and sales teams. The room brings together the information related to the deal, such as selected products, pricing, quotes, supporting documents, and communication history. This helps both sides work from the same context and reduces the risk of misalignment as the deal progresses.

Each room is intended to show the progress of the deal. Buyers can see what has changed since their last visit, what actions are expected from them, and what is blocking or advancing the deal.

Collaboration happens within the deal context. Buyers can ask questions, request changes, share documents, and involve additional stakeholders. Sales teams can respond, update proposals, and manage iterations of the deal while keeping its history.

Core Feature Pillars
--------------------

While the workspace provides the environment for collaboration, its core features aim to remove the obstacles that slow a deal down.

The DSR replaces offline, manual processes with a single interactive workspace. This helps close the gap between buyer requirements and seller offerings. The following feature pillars show how the DSR addresses friction at each stage of a deal:

.. csv-table::
   :header: "The Challenge", "The Feature", "How DSR Addresses It"
   :widths: 25, 20, 55

   "**Information Fragmentation & Data Silos**", "*Deal Container*", "Brings customer data, curated products, quote revisions, and metrics together in one place. Both parties work within the same context and do not need to search through separate systems."
   "**Decision Fatigue & Catalog Overwhelm**", "*Guided Commerce*", "Offers a guided decision path instead of open self-service browsing. Sellers can pre-select relevant products and apply contextual pricing to guide the buyer toward the intended solution."
   "**Communication Gaps & Misalignment**", "*Collaboration Space*", "Provides a shared environment for Q&A, file exchange, and stakeholder tagging. Communication stays linked to specific deal sections, which helps the involved departments stay aligned."
   "**High-Effort Closing Processes**", "*Conversion Surface*", "Shortens the final steps of a sale. Buyers can sign digitally, update quantities, and turn a proposal into an order from the room. This reduces the manual paperwork that typically slows down the closing process."

Flexible Deal Rooms
-------------------

The Digital Sales Room is designed to support different deal types, depending on how a business sells. Each type represents a different way of progressing from evaluation to conversion, while using the same underlying workspace.

The following business cases illustrate how these deal types could work in real-world scenarios.

Quote-Centric Rooms
^^^^^^^^^^^^^^^^^^^

Quote-Centric Rooms are intended for cases when a seller presents a specific, predefined proposal for review. They suit sales where the seller defines the scope, and the buyer evaluates, negotiates, and approves it.

.. admonition:: Specialized Laboratory Equipment
   :class: business-case

   *BioTech Systems* is providing a structured proposal to a research university for a specific set of diagnostic scanners and a three-year service contract.

   **The DSR Workflow:**

   1. **Proposal:** The sales rep builds a room containing the finalized quote, technical manuals, and service-level agreements.
   2. **Technical Clarification:** The university’s lab manager uses the messaging in the room to ask about the equipment's footprint. The sales rep replies with the floor plan schematics directly in the room.
   3. **Revised Terms:** After a brief negotiation on the service frequency, the sales rep updates the proposal. The lab manager can see what changed in the pricing and terms compared to the first version.
   4. **Approval:** The university department head reviews the final proposal in the room and creates the order.

   **The Outcome:** The parties could complete the transaction without external emails or PDF attachments, and the university would keep a complete record of the technical and financial clarifications.

Offer-Centric Rooms
^^^^^^^^^^^^^^^^^^^

These rooms are intended for flexible, buyer-driven purchasing. Instead of a fixed bundle, the seller provides a curated selection of approved products and pricing. The buyer then builds their own solution from that selection.

.. admonition:: Corporate Technology Refresh
   :class: business-case

   *Nova Systems* is helping a corporate client, *Streamline Corp*, upgrade the hardware for their new regional headquarters.

   **The DSR Workflow:**

   1. **Curated Selection:** The sales rep populates the room with a subset of their catalog, such as the laptop models, docking stations, and monitors approved by the client’s IT policy at pre-negotiated corporate rates.
   2. **Buyer-Led Configuration:** The client’s IT Manager enters the room and builds the "Refresh Package" by selecting the quantities of each item needed to cover their 200-person headcount.
   3. **Dynamic Pricing:** As the manager adjusts the quantities of laptops and peripherals, the total price updates based on their volume-based contract terms.
   4. **Consolidated Purchase:** Once the configuration is complete, the IT manager converts the selection into a single order.

   **The Outcome:** The buyer would not need to navigate a large general catalog, and the sales rep could keep the purchase within the items and pricing defined by the corporate agreement.

Agreement-Centric Rooms
^^^^^^^^^^^^^^^^^^^^^^^

Agreement-Centric Rooms are intended for high-value contracts that require legal review and several levels of internal authorization before a purchase can be finalized.

.. admonition:: Industrial Manufacturing (Complex Agreement)
   :class: business-case

   *Apex Machinery* is finalizing a $2M contract with *Global Fab Inc*. This deal requires technical validation, legal review of contract terms, and formal approval from both the CFO and the VP of Operations.

   **The DSR Workflow:**

   1. **Workspace Setup:** The sales rep prepares a shared digital environment for this contract. They upload the initial proposal, technical drawings, and a project timeline.
   2. **Legal Review & Revision Tracking:** The buyer’s Legal Counsel is invited to the room. They use the communication tools to highlight specific liability clauses. The sales rep uploads a revised contract, and Legal compares the two versions.
   3. **Multi-Party Signing:** To finalize the deal, two signatures are required from the buyer’s side. Both signers sign in the room, one after the other.
   4. **Order Finalization:** Once the final signature is collected, the buyer accepts the offer and converts it into an order.

   **The Outcome:** With communication among the legal, financial, and technical teams in one place, Apex Machinery could avoid the fragmented communication that often delays complex transactions.

Benefits for Buyers and Sellers
-------------------------------

For the **buyer**, the DSR is designed to reduce the guesswork of complex procurement and to provide a dedicated environment where they can manage their internal requirements alongside the seller’s offer.

.. csv-table::
   :widths: 30, 70

   "**Real-Time State Awareness**", "Buyers can follow the status of the deal. When they open the room, they can see what has changed since their last visit, which actions are required from their side, and which items are blocking the progress of the deal."
   "**Interactive Communication**", "Instead of writing emails, buyers can message the seller and request specific changes, such as pricing adjustments or technical clarifications, within the workspace."
   "**Direct Commerce Actions**", "Buyers can act on the deal from the room. They can compare quote versions, adjust product quantities within the limits set by the seller, and proceed to checkout."
   "**Multi-Stakeholder Management**", "B2B deals often involve multiple departments, so buyers can share the room with colleagues from legal, finance, or operations. All decision-makers then work from the same data and the same version of the proposal."

For the **sales team**, the DSR is a central workspace to organize the deal, help the buyer through the decision-making process, and keep the deal moving forward.

.. csv-table::
   :widths: 30, 70

   "**Deal Room Builder**", "Sales reps can arrange the layout, theme, and section order of the room. They can add products in bulk, attach supporting content such as ROI calculators, and manage pricing through quote versions and discounts."
   "**Permissions & Rules**", "The seller can set rules for customer actions, such as allowing quantity edits or comments only. The seller can also keep internal notes hidden from the buyer."
   "**Communication**", "Sales teams can track requested changes and deal progress in one place. Sales reps can reply to buyer feedback and manage notifications for the stakeholders."
   "**Versioning Tools**", "Sales teams can take snapshots of the deal state before making updates. This lets them create new quote versions, product sets, or contract iterations and keep the history of the negotiation."
   "**Sharing Controls**", "Sellers can control who has access to the room, for example, with secure links, password protection, or access limited to authorized users. They can invite additional stakeholders as the deal grows."
   "**Engagement Insights**", "The DSR can show who viewed the room, which sections they viewed, and when they were last active. Sales reps can use this information to plan their follow-ups."
   "**Real-Time Collaboration**", "Sales reps can hold meetings with the buyer from the room, for example, with meeting scheduling and screensharing. They can use these meetings for guided product tours and live sessions to finalize agreements."
