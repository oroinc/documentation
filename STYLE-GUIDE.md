# Oro Documentation Style Guide

This guide defines the writing and formatting conventions for Oro documentation published on the [Oro documentation portal](https://doc.oroinc.com/).

Use this guide when creating, updating, or reviewing documentation.

For repository structure, file naming conventions, and contribution workflow, see [CONTRIBUTING.md](CONTRIBUTING.md).

For reStructuredText syntax and markup examples, see [RST-SYNTAX.md](RST-SYNTAX.md).

For building the documentation and verifying your changes, see [BUILD.md](BUILD.md).


## About This Guide

Use this guide to create clear and consistent Oro documentation.

The guide applies to technical writers, developers, and other contributors who create or update documentation on the documentation portal.

Following the same grammar, terminology, structure, and formatting conventions helps ensure that:

- Contributors use consistent writing standards.
- Technical and non-technical readers can understand the documentation.
- Readers can quickly find and scan information.
- Search systems and large language models can correctly identify and interpret content.
- New content remains consistent with the rest of the documentation portal.

Follow this guide first. When it does not address a particular question, refer to the [Google Developer Documentation Style Guide](https://developers.google.com/style). For additional guidance on technical terminology, use the [Microsoft Writing Style Guide](https://learn.microsoft.com/en-us/style-guide/welcome/).


## Core Writing Principles

Use the following principles to create clear, consistent, and accessible Oro documentation.

| Principle | Description | Recommended | Not recommended |
|---|---|---|---|
| **Voice and Tone** | Use a clear, direct, and professional tone. Use promotional language only in [concept guides](https://doc.oroinc.com/user/concept-guides/) or SEO content. | This setting controls which payment methods are available at checkout. | This setting influences the payment options you can offer during checkout. |
| **Direct Statements** | State the main point immediately. Avoid vague introductions and unnecessary lead-in phrases. | This setting applies to all customers in the group. | It is important to note that this setting applies to all customers in the group. |
| **Plain Language** | Use short, familiar words. Avoid unnecessarily formal or complex expressions. | Use the filter to find the order. | Utilize the filtering functionality to locate the order. |
| **One Idea per Sentence** | Express one idea in each sentence. Do not join several facts, conditions, or results with colons, semicolons, or dashes.<br><br>If a sentence contains three or more parallel items, use a list. | This application is a standalone pnpm workspace. It has its own `pnpm-lock.yaml` file. The `pnpm headless:setup` command does not install its dependencies. | This application is its own pnpm workspace: `pnpm-workspace.yaml` declares `packages: []`, so it has no members and its own lockfile, and `pnpm headless:setup` does not install it. |
| **Clear References** | Make sure that the reader knows what *it*, *this*, *that*, and *which* refer to. If a pronoun can refer to more than one noun, repeat the noun. | Enable the integration and configure the mapping. Configuring the mapping incorrectly may cause data loss.<br><br>You can also run `pnpm headless:setup` from this directory. | Enable the integration and configure the mapping. This may cause data loss.<br><br>It also runs from this folder. |
| **Cause and Effect** | Describe a cause and its result in separate sentences. Connect the sentences with *as a result*, *for this reason*, or *because*. | The library stores its configuration at the module level. If the dependency tree contains two copies of the library, the components do not receive the configuration. For this reason, install the library in your application. | The library holds module-level configuration, so a second copy would receive the configuration this module writes while the components read the first one. |
| **Literal Language** | Use literal verbs and nouns. Avoid figurative expressions, idioms, and slang. Readers who are not native English speakers may misunderstand them.<br><br>For common replacements, see [Product Terms and Word Usage](#product-terms-and-word-usage). | The form creates two errors of its own.<br><br>The entry appears in the changelog.<br><br>The rule checks the value. | The form mints two errors of its own.<br><br>The entry lands in the changelog.<br><br>The rule judges the value. |
| **Unfamiliar Terms** | Explain a technical term at first use if the intended audience may not know it. Use a short phrase, a separate sentence, or a note in parentheses.<br><br>Prefer a common term over specialized jargon when both are accurate. | The command packs the module into a package archive (`.tgz` file).<br><br>Relationship endpoints accept a linkage document. A linkage document contains only resource identifiers, not full resources. | The command packs the tarball.<br><br>The body is a linkage document. |
| **Active and Passive Voice** | Prefer the active voice when the actor (person or system) is important.<br><br>Use the passive voice when the actor is unknown, obvious, or less important than the action or result.<br><br>Do not use the passive voice to hide responsibility or make instructions unclear. | **Active:** OroCommerce validates the configuration before saving it.<br><br>**Passive** — the result is more important than the actor: The configuration is saved at the website level.<br><br>**Passive** — the actor is unknown: The customer record was updated on July 15, 2026.<br><br>**Passive** — permissions or restrictions: Access is denied when the user does not have the required permission. | Wordy passive: The validation of the configuration is performed by OroCommerce before the configuration is saved.<br><br>Hidden responsibility: The incorrect value was entered.<br><br>Passive instruction: The **Save** button should be clicked. |
| **Present and Future Tense** | Use the present tense for current product behavior, instructions, and immediate results.<br><br>Use the future tense when describing an event that occurs later, such as a scheduled process, an upcoming expiration, or the result of a future condition.<br><br>Do not switch between the present and future tense when the timing is the same. | Current behavior: OroCommerce validates the file before the import starts.<br><br>Immediate result: Click **Save**. The application updates the configuration.<br><br>Future condition: The token will expire 24 hours after it is generated.<br><br>Mixed timing: When the administrator approves the product, OroCommerce publishes it immediately. The product will appear in the storefront after the next search index update. | Unnecessary future tense: OroCommerce will validate the file before the import starts.<br><br>Unnecessary future result: Click **Save**. The application will update the configuration.<br><br>Incorrect present tense for a scheduled event: The scheduled job runs at midnight tomorrow. |
| **Imperative Mood** | Start each procedural step with a direct action verb. The implied subject is *you*.<br><br>Use *do not* for prohibitions. Do not use *never* in instructions. | Update the configuration and click **Save**.<br><br>Navigate to **System > Configuration > General Setup > Localization**.<br><br>Do not edit `CHANGELOG.md` manually. | You should now update the configuration and click the **Save** button.<br><br>Never edit it by hand. |
| **Second-Person Address** | Use *you* when the intended reader performs an action in the application. | You can configure the payment method for each website. | We can configure the payment method for each website. |
| **Role- and Permission-Specific Language** | Use a specific role when access, permissions, or responsibilities differ. Use singular *they* in subsequent sentences. | An administrator can create and manage a user role. They can also assign permissions to it. | |
| **References to Other Platform Users** | Use specific role names such as customer, customer user, vendor, or seller when describing another person's actions. Use singular *they* in subsequent sentences. | If a customer user forgets their password, they can request a reset link. | If a user forgets his password, he can request a reset link. |
| **Gender-Neutral Language** | Use gender-neutral role names and singular *they*.<br><br>Use singular *they* to refer to one person when their gender is unknown, irrelevant, or not specified. It replaces wordy constructions such as *he or she*, *his or her*, and *him or her*. | Each user must verify their email address. | Each user must verify his email address.<br><br>Each user must verify his or her email address.<br><br>Each user must verify his/her email address. |
| **Objective and Accurate Claims** | Avoid subjective words that may blame or discourage readers, such as *easy*, *simple*, *obvious*, and *just*. | The DELETE method removes the specified resource.<br><br>The approach provides the expected result but has several limitations.<br><br>The layer provides the base of an OroCommerce storefront application. | DELETE is quite easy to understand. It is used to delete the specified resource.<br><br>The approach is simple and works perfectly well, although it has a few flaws. |
| **Verifiable Product Details** | Do not invent product behavior, UI labels, navigation paths, or configuration options. Follow existing documentation patterns when introducing new content. | | |
| **Acronyms** | Spell out an acronym at first use unless it is universally recognized by the intended audience. Use the acronym consistently afterward.<br><br>This rule also applies to developer documentation, for example, to CSRF, TTL, and ESM.<br><br>Do not repeat a word that is already part of the acronym. | Configure single sign-on (SSO). The SSO configuration applies to all users.<br><br>cross-site request forgery (CSRF) token<br><br>access token<br><br>JSON Web Token (JWT) | Configure SSO. The single sign-on authentication mechanism applies to all users.<br><br>CSRF token (at first use)<br><br>JWT token |
| **Contractions** | Use complete forms instead of contractions. Preserve contractions only in quotations, code, product names, or interface text. | do not<br>does not<br>it is<br>have not<br>cannot | don't<br>doesn't<br>it's<br>haven't<br>can't |
| **Disability-Inclusive Language** | Use respectful, accurate language that focuses on the person or the required accessibility support. | person with a disability<br>users without disabilities<br>screen reader user; person who uses a screen reader | special-needs person<br>normal users<br>visually challenged user, blind user |
| **Inclusive Technical Terminology** | Avoid violent, oppressive, or exclusionary metaphors unless they are literal commands or third-party terms. | allowlist, blocklist<br>unexpected, unusual, invalid, inconsistent<br>gap, omission | whitelist, blacklist<br>crazy, insane, dumb<br>blind spot |
| **Success and Failure** | Describe the actual status instead of relying only on color. | successful, failed, permitted, blocked, active, inactive<br><br>Successful requests and failed requests. | green, red, good, bad<br><br>Green requests and red requests. |
| **Example and Placeholder Content** | Use neutral terms for non-production content. | sample data, test data, placeholder data | dummy data, dummy object |
| **Literal Non-Inclusive Terms** | Preserve a non-inclusive term when it is part of code, an API, a command, or a third-party interface. Format it as literal content and explain it neutrally where necessary. | Run the `kill` command to stop the process. | Kill the process. |

## Page Organization

Use meaningful titles, focused paragraphs, structured lists, and simple tables.

| Principle | Description | Recommended | Not recommended |
|---|---|---|---|
| **Titles and Headings** | Use meaningful headings and follow the established heading conventions. Do not number headings. Begin headings consistently with verbs or nouns.<br><br>Begin the headings of task sections with an imperative verb. Do not use the *-ing* form.<br><br>Capitalize major words in descriptive titles and headings. Do not capitalize articles, short conjunctions, or prepositions of four letters or fewer unless they are the first or last word (*a*, *an*, *the*, *in*, *on*, *at*, *for*).<br><br>For heading markup, see [Headings](RST-SYNTAX.md#headings). | Create a Simple Product<br><br>Manage Sales in the Back-Office<br><br>Tax Rules Creation Prerequisites<br><br>Generate a Custom SDK | 1.2.4 Product Configuration<br><br>Generating a Custom SDK |
| **Page Introductions** | Start a page or a README file with a complete sentence that names the product or feature and states what it is. Then describe what it does or contains. | OroCommerce UI is a UI component library for OroCommerce storefronts. The library includes Vue 3 components and a design system. | A UI component library for OroCommerce storefronts, including Vue 3 components and a design system. |
| **Paragraphs** | Use short paragraphs that focus on one main idea. Put the most important information first. | | |
| **Meta Titles and Meta Descriptions** | Add a meta title and meta description to major documentation articles to improve their visibility in search results. Place both attributes at the top of the `.rst` file. Write a unique, descriptive title and summarize the article's purpose in the description. | `:title: Activities Management in the OroCommerce Back-Office`<br><br>`.. meta::`<br>`   :description: Learn how OroCommerce back-office users can manage tasks, calls, cases, calendar events, and contact requests.` | |
| **Documentation Menus** | Oro documentation has two navigation menus: the full documentation menu on the left and the page contents menu on the right.<br><br>You cannot hide the full documentation menu. Its depth is configured globally and applies throughout the documentation.<br><br>You can hide the page contents menu if it does not help readers navigate the content, for example, on short pages or pages without a meaningful heading structure. | To hide the page contents menu, add the following attribute at the top of the `.rst` file:<br><br>`:oro_show_local_toc: false` | |
| **Procedures** | Use numbered steps for actions completed in sequence. Begin each step with an imperative verb and keep one primary action per step.<br><br>Do not create a numbered list with only one step. Write a single action as a sentence. | 1. Navigate to **Products > Products**.<br>2. Click **Create Product**.<br>3. Select **Simple**.<br>4. Click **Continue**.<br><br>To generate the SDK, run `pnpm generate-sdk`. | On the product page, click **Create Product**, select **Simple**, choose a product family, select a category, and click **Continue**.<br><br>1. Run `pnpm generate-sdk`. |
| **Lists** | Use bullets when the order of items does not matter. Use parallel grammatical structures and consistent punctuation.<br><br>Use a list instead of a sentence when a sentence contains three or more parallel items, such as the parts of a package, the actions of a command, or the available options. | **Example 1:**<br>The following product types are available:<br>• Simple<br>• Configurable<br>• Product kit<br><br>**Example 2:**<br>Follow these steps:<br>1. Open the fridge.<br>2. Take out the milk.<br>3. Close the fridge. | The following product types are available (inconsistent list):<br>• Simple.<br>• Creating configurable products<br>• You can also create a product kit.<br><br>The module auto-registers the components, installs the directives and the toast plugin, and serves the icon and placeholder assets. |
| **List Introductions** | Introduce each list with a complete sentence that ends with a colon. Use a standard introductory phrase that matches the purpose of the list. | Alternative ways to complete a task:<br>Use one of the following options:<br><br>A process:<br>This command does the following:<br><br>The parts of a product or package:<br>The package includes: | The tool can be used both as a standalone generator and as an internal engine. |

## Commands, Code, and Files

Use these conventions for commands, code examples, file names, and directory names in user documentation, developer documentation, and README files.

For code block markup in `.rst` files, see [RST-SYNTAX.md](RST-SYNTAX.md).

| Principle | Description | Recommended | Not recommended |
|---|---|---|---|
| **Full Command Names** | Write the complete command, including the tool that runs it. Do not shorten a command to the script name only. | The `pnpm preview` command starts the application from the `.output` directory. | `preview` serves the `.output` that `build` produced. |
| **Object Types** | Name the type of each technical object at first mention, such as a file, directory, command, script, tag, or variable. | Open the `nuxt.config.ts` file.<br><br>The `pnpm build` command creates the `.output` directory.<br><br>Add the `headless-nuxt` tag. | Open `nuxt.config.ts`.<br><br>`build` creates `.output`.<br><br>Add `headless-nuxt`. |
| **Code Block Introductions** | Introduce each code block with a complete sentence that ends with a colon. State the purpose of the code before the code. | To install the dependencies, run:<br><br>To use the `redis` driver, add the following variables to the `.env` file: | Install from this directory:<br><br>One command. |
| **Command Location** | State the directory where the reader must run the command. | From the repository root, run:<br><br>In the OroCommerce application directory, run the following command: | Run `pnpm headless:setup`. (The location is not specified.) |
| **Placeholders** | Enclose placeholders in angle brackets. Explain what value replaces each placeholder. | `export ORO_NPM_TOKEN=<token>`<br><br>Replace `<token>` with your access token for the `@oroinc` registry. | `export ORO_NPM_TOKEN=<token>` (The placeholder is not explained.) |
| **Script Descriptions** | Describe scripts in a table with the **Script** and **Description** columns. Start each description with a verb in the third person. End each description with a period. | `pnpm build` --- Builds the library for production.<br><br>`pnpm eslint:fix` --- Fixes ESLint issues automatically. | `pnpm build` --- build the module for distribution<br><br>`pnpm eslint:fix` --- fix what ESLint can fix |
| **Code Block Format** | Format code blocks according to the file type:<br>• In `.md` files, use three backticks.<br>• In `.rst` files, use the `.. code-block::` directive.<br><br>Always specify the language, such as `bash`, `json`, `yaml`, or `ts`. Use the same format for all code blocks in a file. | In `.md` files:<br>` ```bash `<br>`pnpm install`<br>` ``` `<br><br>In `.rst` files:<br>`.. code-block:: bash`<br><br>`   pnpm install` | Code blocks without a language.<br><br>Three backticks in some blocks and four backticks in others in the same file. |
| **Working Code Examples** | Make sure that each code example works as written. Check commands, flags, types, and imports before you publish the example. | `pnpm add @oroinc/json-api-sdk-generator`<br><br>`const productsApi = new ProductsApi(apiConfig);` | `pnpm install @oroinc/json-api-sdk-generator -s` (In pnpm, `-s` means `--silent`, not `--save`.)<br><br>`const productsApi: Promise<ProductsCollectionModel[]> = new ProductsApi(apiConfig);` (The type does not match the value.) |
| **Command Results** | After a command, describe its result if the result is not obvious. Also describe what the reader must do next, if anything. | The `pnpm preview` command does not rebuild the application. After each code change, run `pnpm build` again. | `pnpm preview` (No explanation of the result or the next step.) |



## Notices and Supporting Content

Use notices only when information must be separated visually from the main text. Choose the notice type according to the importance and risk.

For the markup of each block, see [Notices](RST-SYNTAX.md#notices).

| Type | Description | Recommended |
|---|---|---|
| **Note / Hint / Tip** | Use any of these blocks for important contextual or supplementary guidance that does not prevent task completion.<br><br>Use `note`, `hint`, and `tip` when several equally important blocks appear together and require visual separation. | `.. note:: You can configure user settings globally or per website.`<br><br>`.. hint:: Check out the Commerce Storefront guide for more details.`<br><br>`.. tip:: It is also possible to amend the order content until the order is submitted.` |
| **Important** | Use for information required for successful completion, feature availability, edition limitations, or patch-release requirements. | `.. important:: This feature is only available in the Enterprise edition.`<br><br>`.. important:: This feature is only available as of OroCommerce version 6.0.3.`<br><br>`.. important:: Schema changes are permanent and cannot be easily rolled back.` |
| **Caution / Warning** | Use either block to identify a risk, undesirable outcome, data loss, financial impact, security exposure, or another consequence. In Oro documentation, these blocks may be used interchangeably. | `.. caution:: Changing the website fallback may replace website-level values with organization-level settings.`<br><br>`.. warning:: Do not use test payment credentials in production. Test credentials may expose payment data or prevent payment processing.` |
| **Admonition** | Use when the block requires a custom title. Admonitions are commonly used for marketing, business guidance, or SEO content. | `.. admonition:: Business Tip`<br><br>`   Explore OroCommerce product management capabilities for complex B2B catalogs.` |
| **Patch Release Version and Enterprise Edition Availability** | Always indicate whether a feature is available starting from a specific patch release or only in the Enterprise edition. This information helps readers determine whether the feature is available in their installed version.<br><br>Place the availability information before the feature description when it applies to an entire feature or section. For a minor option, action, or setting, add the information in parentheses immediately after its name. | `.. note:: <feature name> is available as of OroCommerce Enterprise version 7.0.3.`<br><br>The **Do Not Render Title** option (available as of OroCommerce version 6.0.3).<br><br>**Share with Others/Unshare** (available for the Enterprise edition only). |
| **Global Version Notice** | Use a global notice to indicate whether readers are viewing documentation for an upcoming or previously released version. The notice applies to all documentation pages and is maintained in `_themes/sphinx_rtd_theme/alert.html`. | **Upcoming LTS version (`master`):** You are browsing upcoming documentation for version \<number\> of OroCommerce, scheduled for release in \<year\>.<br><br>**Current LTS version:** Do not display a global version notice.<br><br>**Previously released version:** You are browsing documentation for version \<number\> of OroCommerce, supported until \<year\>. |


## Links and Cross-References

Use descriptive links and stable anchor names so readers understand where a link leads and why it is relevant.

For link markup, see [Internal Links](RST-SYNTAX.md#internal-links) and [External Links](RST-SYNTAX.md#external-links).

| Principle | Description | Recommended | Not recommended |
|---|---|---|---|
| **Links and Cross-References** | Use descriptive link text that identifies the destination. Use the exact page or section title where possible.<br><br>Identify whether the destination is a page, section, guide, or external resource when this information adds clarity. | For password instructions, see Change Your Password.<br><br>For field details, see Display Settings.<br><br>See the Layout section for more information about the UI customization. | Click here for more information.<br><br>See above.<br><br>Read more. |
| **Anchor Links** | Create an anchor from the documentation path and the section or page name. Use lowercase letters and hyphens. Use double hyphens to separate major path levels. | `.. _user-guide--system--config--prices-create-price-list:` | |
| **Anchor Stability** | Keep existing anchors when changing a heading unless the anchor is incorrect or misleading. If you do change an anchor, update the references across all documentation. | | |


## Capitalization

Use title case for descriptive titles and headings. Use sentence case for headings that begin with a command.

Match the capitalization of UI labels exactly.

| Principle | Description | Recommended | Not recommended |
|---|---|---|---|
| **Title Case** | Capitalize major words in descriptive titles and headings. Do not capitalize articles, short conjunctions, or prepositions of four letters or fewer unless they are the first or last word (*a*, *an*, *the*, *in*, *on*, *at*, *for*). | Create and Manage Tasks in the Back-Office<br><br>Configuration for a Website | Create And Manage Tasks In The Back-Office<br><br>Configuration For A Website |
| **UI Labels** | Capitalize the following visible UI elements according to their interface labels:<br>• Button names<br>• Column headings<br>• Command labels<br>• Icon labels<br>• Menu names and menu commands<br>• Tab titles<br>• Title bar text | Click **Save and Close**.<br><br>In the **Customer Group** column, select a group. | Click **Save And Close**.<br><br>In the customer group column, select a group. |
| **Proper Names** | Capitalize proper nouns, names, brands, companies, institutions, organizations, nationalities, holidays, events, streets, days, months, and abbreviations. | John Doe<br>OroCommerce<br>Wednesday<br>January<br>German<br>OroHive<br>URL<br>CSV | john doe<br>Orocommerce<br>wednesday<br>january<br>german<br>Orovibe<br>Url<br>Csv |
| **Terms and Concepts** | Do not capitalize general terms and concepts unless they are UI labels or part of an official name. | marketing list details page<br>website configuration<br>payment method | Marketing List View Page<br>Website Configuration<br>Payment Method |


## Punctuation

### List Punctuation

| Principle | Recommended | Not recommended |
|---|---|---|
| **Short Items** | The following interface elements are available:<br>• Buttons<br>• Icons<br>• Lists | The following interface elements are available:<br>• Buttons.<br>• Icons.<br>• Lists. |
| **Action Fragments** | You can use marketing lists to:<br>• Manage marketing campaigns<br>• Review mailing statistics<br>• Manage subscribers<br>• Share lists with other OroCommerce users | You can use marketing lists to:<br>• Manage marketing campaigns;<br>• Review mailing statistics;<br>• Manage subscribers;<br>• Share lists with other OroCommerce users. |
| **Complete Sentences** | You can do the following:<br>• Map the marketing list to address books in Dotdigital and keep them synchronized.<br>• Use your address books to create email campaigns in Dotdigital and import them to the Oro application.<br>• Use Dotdigital campaign statistics and Oro application reporting tools to analyze the campaign efficiency. | You can do the following:<br>• Map the marketing list to address books in Dotdigital and keep them synchronized<br>• Use your address books to create email campaigns in Dotdigital and import them to the Oro application<br>• Use Dotdigital campaign statistics and Oro application reporting tools to analyze the campaign efficiency |
| **Procedure Steps** | 1. Open the product.<br>2. Update the product information.<br>3. Click **Save and Close**. | 1. Open the product<br>2. Update the product information<br>3. Click **Save and Close** |
| **Option Descriptions** | Use `---` in RST to render an em dash:<br><br>**Owner** --- Select the organization that owns the website.<br><br>**Name** --- Enter the website name. | **Owner**: The website owner. |

### General Punctuation

| Punctuation | Description | Recommended | Not recommended |
|---|---|---|---|
| Colon (`:`) | Use a colon after an introduction to a list, example, or explanation. | The following interface elements are available:<br>• Buttons<br>• Icons | The following interface elements are available<br>• Buttons<br>• Icons |
| Comma (`,`) | Use a comma:<br>• After an introductory *if* clause. Do not use a comma when the *if* clause follows the main clause.<br>• Before *and* or *or* in a list of three or more items.<br>• Before *and*, *but*, *or*, or another coordinating conjunction when it connects two complete sentences.<br>• After *e.g.*, *for example*, or *for instance* when it introduces examples. Use *e.g.* only inside parentheses. | If the import is successful, the records appear on the product list.<br><br>The records appear on the product list if the import is successful.<br><br>Configure products, prices, and inventory.<br><br>Select an organization, website, or customer.<br><br>The import is complete, and the records are available on the product list.<br><br>The configuration is valid, but the integration is disabled.<br><br>Open the product and update its price.<br><br>Supported image formats include raster formats (e.g., PNG, JPEG, and GIF). | If the import is successful the records appear on the product list.<br><br>The records appear on the product list, if the import is successful.<br><br>Configure products, prices and inventory.<br><br>Select an organization, website or customer.<br><br>The import is complete and the records are available on the product list.<br><br>The configuration is valid but the integration is disabled.<br><br>Open the product, and update its price.<br><br>Supported image formats include raster formats (e.g. PNG, JPEG, and GIF). |
| Hyphen (`-`) | Use hyphens in compound modifiers and established product terms.<br><br>Do not hyphenate an adverb ending in *-ly* with the word that follows. | back-office menu<br>website-level configuration<br>system-wide permissions<br>role-based access<br>record-specific actions<br>product-related settings<br>customer-facing page<br>third-party application<br>pre-generated credentials<br>built-in text editor<br>step-by-step guidance<br>multi-website management<br>multi-warehouse feature<br>single-page application<br>server-rendered content<br>a two-step procedure<br>a 30-day period<br><br>an out-of-the-box feature **but** the feature is available out of the box<br><br>real-time inventory updates **but** inventory updates in real time<br><br>a read-only field **but** the field is read only<br><br>**Adverbs ending in -ly:**<br>globally configured settings<br>automatically generated identifier<br>previously created website | |
| Em Dash (`---`) | Use an em dash to separate an option or field name from its description. In RST, enter three hyphens (`---`) to render an em dash. | **Owner** --- Select the organization that owns the website.<br><br>**Inbox** --- Contains newly delivered emails. | **Owner**: Select the organization that owns the website. |
| Parentheses (`()`) | Use parentheses for brief supporting information, abbreviations, or examples. Do not put essential instructions only in parentheses. | Import a comma-separated values (CSV) file.<br><br>Supported formats include image files (e.g., PNG and JPEG). | Enable the integration. (This step is required before the import.) |


## Navigation and UI References

| Principle | Description | Usage |
|---|---|---|
| **Interface Elements** | Use bold formatting when referring to UI elements. | Click **Save**.<br><br>Open the **Settings** tab.<br><br>Select **Create New User**. |
| **Navigation Instructions** | Provide the full path to the required location. Separate navigation levels with a `>` sign and one space on each side. Format the complete path in bold.<br><br>Use either of the following established sentence patterns. | **Example 1:**<br>Navigate to **System > Configuration** in the main menu.<br>Select **Commerce > Customer > Customer Users** in the menu to the left.<br><br>**Example 2:**<br>Navigate to **System > Configuration > Commerce > Customer > Customer Users** in the main menu. |

### Corners, Sides, and Spatial References

Use concise spatial references only when the location helps identify the element.

| Preposition | Use for | Usage |
|---|---|---|
| **in** | Content contained within a field, list, dialog, window, section, panel, menu, directory, header, footer, UI, or interface area. | You can create orders in the back-office/in the storefront.<br>Select **Enabled** in the list.<br>In the dialog, enter the task subject.<br>The notification appears in the interface.<br>in the top-right/top-left corner |
| **on** | Pages, tabs, toolbars, menu bars, screens, task lists, and specific surfaces. | Enter your credentials on the storefront login page.<br>On the **General** tab, select **Enabled**.<br>Click **Edit** on the toolbar.<br>The filter panel appears on the left.<br>Updating the Widgets guide is on the to-do list. |
| **at** | A specific point, position, level, scope, process step, or stage. | Configure the setting at the website/entity level.<br>The total appears at the bottom of the order page.<br>At the final step, click **Submit**.<br>The file is available at `/var/log/oro`.<br>This feature is configured at the development stage.<br>at checkout |
| **under** | An item located within a named menu, heading, category, or parent section. | |
| **next to**<br>**to the right of**<br>**to the left of** | An element immediately beside another element. | The filter panel appears to the left of the product list.<br>Click the icon to the right of the product name. |


## Product Terms and Word Usage

| Term | Recommended | Not recommended |
|---|---|---|
| **back-office** | Use **back-office** when referring to the Oro administration interface.<br><br>Configure the settings in the back-office. | |
| **storefront** | Use **storefront** when referring to the customer-facing interface.<br><br>Customers can manage their orders in the storefront. | |
| **OroCommerce** | Configure the integration in OroCommerce.<br><br>Configure the integration in the OroCommerce back-office. | Configure the integration in the OroCommerce.<br><br>Configure the integration in OroCommerce back-office. |
| **Oro application** | The Oro application displays the product list. | Oro application displays the product list. |
| **headless storefront** | Use **headless storefront** for a storefront application that runs separately from OroCommerce and communicates with OroCommerce only through the API.<br><br>The application runs in headless mode. It communicates with OroCommerce only through the API. | |
| **its vs it's** | Use *its* as the possessive form of *it*.<br><br>Use *it's* only when it means *it is* or *it has*.<br><br>Quick test: replace *it's* with *it is*. If the sentence still makes sense, use *it's*. Otherwise, use *its*.<br><br>Correct: The application stores its configuration in the database. (Quick check: "The application stores it is configuration.")<br><br>In Oro documentation, use *its* for possession and write *it is* or *it has* in full. Avoid the contraction *it's*. | |
| **until** | The product remains unavailable until it is approved. | The product remains unavailable till it is approved. |
| **checkbox** | Select the **Enable Tags** checkbox. | Select the **Enable Tags** check box. |
| **drop-down** | Use the drop-down to select the required option. | Use the drop down to select the required option.<br><br>Use the dropdown to select the required option. |
| **out-of-the-box / out of the box** | Avoid *out-of-the-box* and *out of the box*. Prefer a term that accurately describes the feature: *default*, *built-in*, *preconfigured*, *included*, or *system-provided*. If you still use it, follow the usage rule below.<br><br>OroCommerce provides out-of-the-box reports. (Used as a modifier.)<br><br>Several reports are included out of the box. (Used as an adverb.) | |
| **answer for** | Use *contain an entry for*.<br><br>A locale file must contain an entry for each code that the rules report. | A locale file answers for the codes its rules report. |
| **bridge** | Use *connect*.<br><br>The module connects the component library to a Nuxt application. | The module is the bridge between the component library and a Nuxt application. |
| **bump** | Use *increase the version*. Use *version bump* only in the context of release tools.<br><br>A change to any package increases the version of all packages in the group. | A bump to any of them versions all of them. |
| **by hand** | Use *manually*.<br><br>Do not edit `CHANGELOG.md` manually. | Never edit it by hand. |
| **carry** (a tag, a value) | Use *have* or *contain*.<br><br>The package has the `headless-nuxt` tag. | The package carries the `headless-nuxt` tag. |
| **e.g.** | Use *for example* in running text. Use *e.g.* only inside parentheses.<br><br>Generate a custom SDK if the API includes custom entities, for example, extended fields.<br><br>Supported formats include image files (e.g., PNG and JPEG). | Generate a custom SDK if the API includes custom entities, e.g. extended fields. |
| **fold** | Use *convert*.<br><br>The SDK converts the nested object into a JSON:API resource. | The nested object is folded recursively. |
| **hold** | Use *contain* or *store*.<br><br>The library stores its configuration at the module level. | The library holds module-level configuration. |
| **judge** | Use *check*.<br><br>The rule checks all other values, including `false` and `0`. | `false` and `0` are judged. |
| **land** | Use *appear*.<br><br>The description that appears in the changelog. | The sentence that lands in the changelog. |
| **live** (under a path or prefix) | Use *be stored* or *use*.<br><br>All Nuxt-specific code is in this module.<br><br>These messages use the `oro.form.` prefix. | Everything Nuxt-specific lives here.<br><br>The messages live under a prefix of their own. |
| **mint** | Use *create*.<br><br>The form creates two errors of its own. | The form mints two errors of its own. |
| **serve** | Use *run*, *provide*, or *make available*.<br><br>The `runtime` image runs the storefront application.<br><br>The module makes the icon assets available under the `baseURL` of the application. | The `runtime` image serves the application.<br><br>The module serves the icon assets. |
| **ship** | Use *include*.<br><br>The application includes a pre-built SDK. | The application ships with a pre-built SDK. |
| **surface** (API surface) | Use *API*.<br><br>Generate a custom SDK if the API of your OroCommerce instance differs from the default API. | Use this option if the OroCommerce instance has a different API surface. |
| **tarball** | Use *package archive* and give the file extension.<br><br>The command packs the module into a package archive (`.tgz` file). | The command packs the tarball. |
| **win** | Use *take precedence*.<br><br>If a rule specifies its own key, this key takes precedence. | A rule naming its own key wins. |

## Images and Screenshots

| Element | Description | Recommended | Not recommended |
|---|---|---|---|
| **Alt Text** | Always provide meaningful alternative text for images. The alt text should describe the image content in a human-readable way. | `.. image:: ../img/entity_management/entity_create1.png`<br>`   :alt: A new entity creation page` | |
| **Screen Size and Cropping** | Include the relevant navigation menu whenever possible so readers can locate the feature.<br><br>Crop the header, right-side widget bar, blank areas, and unrelated elements unless they provide useful context.<br><br>Keep the navigation that helps identify the feature location.<br><br>Remove blank or unrelated interface areas. | ![Coupon details page cropped to the left menu and the highlighted fields](_assets/style-guide/cropping-recommended.png) | ![Full browser window with the application header, search bar, and right-side widget bar around a small coupon details page](_assets/style-guide/cropping-not-recommended.png) |
| **Colors** | Use `#B48C50` (gold) as the primary annotation color.<br><br>Use `#78143C` as an additional color when:<br>• You need to distinguish a second interface element.<br>• Gold is already used for another annotation.<br>• The interface contains many gold elements, and a gold annotation would blend into the UI. | ![Coupon details page with one group of fields framed in gold and a second group framed in dark red](_assets/style-guide/colors-recommended.png) | |
| **Line Thickness** | Adjust the line thickness to the screenshot size:<br>• Screens approximately 600 px wide: 2 px.<br>• Screens 1030 px wide or wider: 4 px or more.<br><br>Make sure that lines remain visible without covering interface elements. | ![Thin gold frame around two coupon fields, leaving the field labels and values readable](_assets/style-guide/line-thickness-recommended.png) | ![Thick gold frame around two coupon fields, covering the surrounding field labels and values](_assets/style-guide/line-thickness-not-recommended.png) |
| **Selection Shape** | Use a square or rectangular selection frame without a shadow. | ![Rectangular gold frame around the Create Account button](_assets/style-guide/selection-shape-recommended.png) | |
| **Arrows** | Use thin, straight arrows. | ![Thin straight gold arrow](_assets/style-guide/arrows-recommended.png) | ![Thin straight gold arrow with a drop shadow](_assets/style-guide/arrows-not-recommended.png) |
| **Element Selection** | Whenever possible, use the interface's native selected, focused, active, or expanded state to highlight an element. | ![Customer grid with two rows highlighted using the native selected-row state and checkboxes](_assets/style-guide/element-selection-recommended.png) | |
| **Shadows** | Do not apply shadows to arrows, selection frames, step indicators, or other screenshot annotations. | | |
| **Annotation Text** | Use Open Sans for text added to screenshots.<br><br>Use a font size of 12 px or 14 px, depending on the screenshot dimensions and the amount of text.<br><br>Keep annotations short and use them only when the screenshot cannot convey the required information on its own. | | |
| **Step Indicators** | Use relatively small step indicators without shadows.<br><br>Keep the indicator close to the related interface element without covering it. | ![Import dialog with four small numbered indicators placed next to the Import file button, file selector, Validate button, and Import file button](_assets/style-guide/step-indicators-recommended.png) | |
| **Filters** | Hide filters when they are not relevant to the documented task and do not affect the displayed result.<br><br>Show filters when the data in the screenshot has been filtered or when the filter configuration is important to the instructions. | ![Open Orders grid with the filter panel collapsed and the applied filters summarized in a single line](_assets/style-guide/filters-hidden-recommended.png)<br><br>**Or**<br><br>![Open Orders grid with the filter panel expanded, showing each applied filter as a separate control](_assets/style-guide/filters-shown-recommended.png) | |
| **Sensitive Data** | Blur all sensitive or identifying data, including instance names, local or private URLs, personal information, and personally identifiable information (PII).<br><br>Verify the entire screenshot before publishing it.<br><br>Do not expose real names, email addresses, account details, internal URLs, credentials, tokens, or other confidential information. | ![OAuth application page with the instance name, owner, client ID, and client secret blurred](_assets/style-guide/sensitive-data-recommended.png) | |


## Testing Documentation

Before submitting documentation changes:

- Review the page for consistency with this style guide.
- Read the page as a first-time reader. If you have to re-read a sentence, rewrite it.
- Check terminology and capitalization.
- Verify UI references and navigation paths.
- Check links and references.
- Search for common style issues before submitting the pull request.
- Check that code examples and commands work.
- Check that versions, file names, and descriptions match across related documents.
