# PA: Product and Presentation

Scrumbled fosters an environment where agile project management is approachable and straightforward while enabling teams to adopt and master the Scrum methodology with ease. Improving team collaboration is key, with each sprint serving as an opportunity for effective, transparent, and targeted advancement.

## A9: Product

Scrumbled is a project management website, designed to use the Scrum Framework. It is easy to use and helps users follow Scrum practices to ensure a good team collaboration.

### 1. Installation

The final version of the Docker image can be found [here](https://gitlab.up.pt/lbaw/lbaw2425/lbaw24113/container_registry/104). This needs to be used with the command below.

To run it use this bash command:
```bash
$ docker run -d --name lbaw2425 -p 8001:80 gitlab.up.pt:5050/lbaw/lbaw2425/lbaw24113
```

### Using Mailtrap
In order to view the emails sent to Mailtrap, we have created a test account.
Note that Mailtrap has a limit of 100 monthly emails for the free version.

The Gmail account for mailtrap has the following credentials:
- Email: ``scrumbledTest@gmail.com`` 
- Password: ``Scrum6L3dT35t`` 

The ``.env`` that we published in repository is linked to this account in Mailtrap. Using it with a different account will not work without changing the ``.env`` file.

### 2. Usage

#### 2.1. Administration Credentials

In order to access the admin page, append ``/admin`` to the base URL.  

| Username        | Password |
| --------------- | -------- |
| admin@email.com | password |

#### 2.2. User Credentials

| Type                       | Username          | Password |
| -------------------------- | ----------------- | -------- |
| Product Owner of Jira      | up202207919@up.pt | password |
| Product Owner of Scrumbled | up202205469@up.pt | password |
| Scrum Master of Jira       | up202205794@up.pt | password |
| Developer in Jira          | up202206370@up.pt | password |

### 3. Application Help

Our website provides help in the pages "About Us", "Contact Us" and "FAQ": 

#### Contact Us
- URL path: **/contact**

On this page, you can send us a message for additional support. This feature allows you to directly get in touch with our team for further help.

![image](uploads/62488027b33dd9705f38fa3e58a8e0f4/image.png){width=1211 height=587}

#### FAQ
- URL path: **/faq**

In the FAQ page, you can find answers to common questions and helpful information about our website. If you have any further inquiries, feel free to reach out to us directly, in the "Contact Us" page.

![image](uploads/a38d0ac6c4bd5e71917269ca6f9fdfdc/image.png){width=1212 height=569}

#### About Us
- URL path: **/about**

This page provides more information about our team.

![image](uploads/204d446417beeccf1238490020407022/image.png){width=936 height=723}
![image](uploads/9f1e0e12e190b82c20b43ae20e4897da/image.png){width=922 height=408}
 

### 4. Input Validation

#### Server-side Validation
For the back-end, we use requests from *Illuminate\Http\Request*. To validate the request we use $request->validate(). Here is an example of how we validate data  when registering a new user:

![image](uploads/3475ebf1a8899c1559b7dbba2b3ab99b/image.png){width=527 height=264}

#### Client-side Validation
For the front-end, we use JavaScript to validate the inputs. For example, when editing a project: description

![image](uploads/82b766a5ae9bdb666fdaa621cfbaeb4c/image.png){width=509 height=287}


### 5. Check Accessibility and Usability

Accessibility: https://ux.sapo.pt/checklists/acessibilidade/ (16/18)

The results are in the docs folder of the repository and can be accessed [here](https://gitlab.up.pt/lbaw/lbaw2425/lbaw24113/-/blob/207577d50d5086733f3c2cc261a9dc56383fdd0d/docs/accessibilityTest.pdf)

Usability: https://ux.sapo.pt/checklists/usabilidade/ (27/28)

The results are in the docs folder of the repository and can be accessed [here](https://gitlab.up.pt/lbaw/lbaw2425/lbaw24113/-/blob/207577d50d5086733f3c2cc261a9dc56383fdd0d/docs/usabilityTest.pdf)

### 6. HTML & CSS Validation

We did HTML and CSS validation with [https://validator.w3.org/nu/ and https://jigsaw.w3.org/css-validator/] respectively.

The result of HTML is inside: [here](https://gitlab.up.pt/lbaw/lbaw2425/lbaw24113/-/blob/61a0dfdb5f110fc1e3e95d3317d53749cbb37de7/docs/w3Validator.pdf)

The result of CSS is inside: [here](https://gitlab.up.pt/lbaw/lbaw2425/lbaw24113/-/blob/61a0dfdb5f110fc1e3e95d3317d53749cbb37de7/docs/css.pdf)

### 7. Revisions to the Project

The most prominent changes made to the project were made and documented in the 22nd of December 2024. All sections (user stories, database and the project itself) were changed and revised.

### 8. Implementation Details

#### 8.1. Libraries Used

These are the libraries that make up the Scrumbled project.

| Framework/Library                    | Description                                               |
| ------------------------------------ | --------------------------------------------------------- |
| [Laravel](https://laravel.com/)      | Used for back-end.                                        |
| [Tailwind](https://tailwindcss.com/) | Used for front-end design.                                |
| [Pusher](https://pusher.com/)        | Used for real-time notifications and toast notifications. |
| [Mailtrap](https://mailtrap.io/)     | Used for sending and receiving emails.                    |  

#### 8.2 User Stories

This section includes all high, medium and low priority user stories, sorted by order of implementation.

| Identifier | Name                               | Module | Priority | Team Members      | State |
|------------|------------------------------------|--------|----------|-------------------|-------|
| US33       | Logout                             | M01    | High     | **Simão**         | 100%  |
| US11       | Login                              | M01    | High     | **Simão**         | 100%  |
| US12       | Register                           | M01    | High     | **Vanessa**       | 100%  |
| US810      | Administrator Accounts             | M06    | Medium   | **João**          | 100%  |
| US21       | See User Profile                   | M01    | High     | **Vanessa**       | 100%  |
| US34       | Edit Authenticated User's Profile  | M01    | High     | **Vanessa**       | 100%  |
| US36       | User's Profile Picture             | M01    | Medium   | **António**       | 100%  |
| US32       | View My Projects                   | M03    | High     | **João**          | 100%  |
| US31       | Create Project                     | M03    | High     | **António**       | 100%  |
| US48       | View Project Board                 | M03    | Low      | **João**          | 100%  |
| US611      | Manage Members Permissions         | M03    | Low      | **António**       | 100%  |
| US89       | View Project Details               | M03    | Medium   | **António**       | 100%  |
| US52       | Assigned to Task                   | M05    | Medium   | **João**          | 100%  |
| US53       | Assign Tasks                       | M05    | Medium   | **João**          | 100%  |
| US51       | Complete an Assigned Task          | M05    | High     | **João**          | 100%  |
| US65       | Accept a Completed Task            | M05    | High     | **António**       | 100%  |
| US82       | View User Accounts                 | M06    | High     | **Vanessa**       | 100%  |
| US83       | Edit User Accounts                 | M06    | High     | **António**       | 100%  |
| US71       | Edit Project Details               | M03    | Medium   | **Simão**         | 100%  |
| US66       | Add User to Project                | M03    | High     | **João**          | 100%  |
| US22       | Exact Match Search                 | M02    | High     | **Vanessa**       | 100%  |
| US24       | Search Filters                     | M04    | High     | **António**       | 100%  |
| US81       | Search User Accounts               | M06    | High     | **Simão**         | 100%  |
| US69       | Archive Project                    | M03    | Medium   | **Vanessa**       | 100%  |
| US613      | Add task to sprint                 | M04    | Low      | **António**       | 100%  |
| US44       | View Project Team                  | M03    | Medium   | **João**          | 100%  |
| US46       | View Team Members Profiles         | M02    | Medium   | **Vanessa**       | 100%  |
| US23       | Full-text Search                   | M05    | High     | **Simão**         | 100%  |
| US41       | Search Tasks                       | M05    | High     | **António**       | 100%  |
| US42       | Search over Multiple Attributes    | M05    | High     | **João**          | 100%  |
| US61       | Create Task                        | M05    | High     | **Vanessa**       | 100%  |
| US63       | Manage Task Labels                 | M05    | High     | **Simão**         | 100%  |
| US62       | Manage Task Priority               | M05    | High     | **João**          | 100%  |
| US84       | Create User Accounts               | M06    | High     | **João**          | 100%  |
| US29       | Placeholders in Form Inputs        | M01    | Medium   | **Vanessa**       | 100%  |
| US43       | Leave Project                      | M03    | Medium   | **António**       | 100%  |
| US612      | Manage Project Invitation          | M03    | Low      | **João**          | 100%  |
| US39       | Manage Project Invitation          | M03    | Low      | **Vanessa**       | 100%  |
| US45       | Change in Product Owner            | M03    | Medium   | **Simão**         | 100%  |
| US68       | Remove Project Member              | M03    | Medium   | **Simão**         | 100%  |
| US38       | Mark Project as Favorite           | M03    | Medium   | **Vanessa**       | 100%  |
| US25       | About US                           | M01    | Medium   | **Vanessa**       | 100%  |
| US26       | Product's Main Features            | M01    | Medium   | **António**       | 100%  |
| US27       | Contact Information                | M01    | Medium   | **João**          | 100%  |
| US37       | Authenticated User's Notifications | M01    | Medium   | **João**          | 100%  |
| US610      | Completed Task in Project Managed  | M03    | Medium   | **António**       | 100%  |
| US67       | Assign New Coordinator             | M03    | Medium   | **João**          | 100%  |
| US615      | Private Projects                   | M03    | Low      | **António**       | 100%  |
| US614      | Delete My Project                  | M03    | Low      | **Simão**         | 100%  |
| US88       | Browse Projects                    | M06    | Medium   | **Vanessa**       | 100%  |
| US811      | Delete Projects                    | M06    | Low      | **Simão**         | 100%  |
| US311      | Private Profile                    | M02    | Low      | **Simão**         | 100%  |
| US47       | Comment on Task                    | M05    | Medium   | **Simão**         | 100%  |
| US49       | Edit Comment                       | M05    | Low      | **Simão**         | 100%  |
| US410      | Delete Comment                     | M05    | Low      | **Vanessa**       | 100%  |
| US35       | Delete Account                     | M02    | Medium   | **Vanessa**       | 100%  |
| US85       | Block User Accounts                | M06    | Medium   | **António**       | 100%  |
| US86       | Unblock User Accounts              | M06    | Medium   | **João**          | 100%  |
| US87       | Delete User Accounts               | M06    | Medium   | **Simão**         | 100%  |
| US13       | Recover Password                   | M01    | Medium   | **Simão**         | 100%  |
| US28       | Accept Email Invitation            | M01    | Medium   | **Simão**         | 100%  |
| US72       | Accepted Invitation to Project     | M01    | Medium   | **Vanessa**       | 100%  |
| US210      | Contextual Error Messages          | M01    | Medium   | **António**       | 100%  |
| US211      | Contextual Help                    | M01    | Medium   | **João**          | 100%  |
---


## A10: Presentation
 
This artifact corresponds to the presentation of the product.

### 1. Product presentation

Scrumbled is a project management website, designed to streamline Agile workflows, focusing on two key features: creating Scrum projects and managing Scrum roles. Users can easily organize their work into Sprints, allowing teams to focus on specific goals and track progress efficiently. The Sprint feature provides tools for setting clear objectives, assigning tasks and ensuring that teams stay on track and meet deadlines.

In addition, the website helps define and manage Scrum roles within the team. It supports the essential Scrum framework by allowing users to assign roles such as Scrum Master, Product Owner, and Developer. This ensures everyone knows their responsibilities, facilitating smooth communication and collaboration throughout the project lifecycle. 

### 2. Video presentation

The video presentation can be found in the repository's docs folder. You can access it by clicking [here](https://youtu.be/VGcjVdjjPG8).

![image](uploads/cedabae328d91db02b5d411c8dbaf37f/image.png){width=1234 height=659}

---


## Revision history

No revision history yet.

---

GROUP24113, 25/11/2024

* António Santos, up202205469@up.pt
* Vanessa Queirós, up202207919@up.pt
* João Santos, up202205794@up.pt (Editor)
* Simão Neri, up202206370@up.pt