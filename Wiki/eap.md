# EAP: Architecture Specification and Prototype

Scrumbled fosters an environment where agile project management is approachable and straightforward while enabling teams to adopt and master the Scrum methodology with ease. Improving team collaboration is key, with each sprint serving as an opportunity for effective, transparent, and targeted advancement.

## A7: Web Resources Specification

This section provides an overview of the entire web application to be implemented, using the OpenAPI specification.

### 1. Overview

<table>
<tr>
<td>M01 - Auth</td>
<td>Web resources associated with user authentication, including features like login/logout and registration.</td>
</tr>
<tr>
<td>M02 - Profile</td>
<td>Web resources associated with user profiles, including features like user profile search, edit and visualization.</td>
</tr>
<tr>
<td>M03 - Project</td>
<td>Web resources associated with projects, including features like project creation and visualization. More specific features include adding users to a project, viewing the project backlog and searching for a task.</td>
</tr>
<tr>
<td>M04 - Sprint</td>
<td>Web resources associated with project sprints, including features like sprint creation, editing, closing and visualization.</td>
</tr>
<tr>
<td>M05 - Task</td>
<td>Web resources associated with tasks, including features like task creation, detail visualization, editing, assigning, starting, completing and accepting.</td>
</tr>
<tr>
<td>M06 - Admin</td>
<td>Web resources associated with admins, including features like searching, viewing and editing user accounts.</td>
</tr>
</table>

### 2. Permissions

The following permissions were used to establish resource access conditions:

<table>
<tr>
<td>

**PUB**
</td>
<td>Public</td>
<td>Users without privileges.</td>
</tr>
<tr>
<td>

**USR**
</td>
<td>User</td>
<td>Autheticated users.</td>
</tr>
<tr>
<td>

**OWN**
</td>
<td>Owner</td>
<td>Owners of information (for example, own profile).</td>
</tr>
<tr>
<td>

**ADM**
</td>
<td>Administrator</td>
<td>System administrators.</td>
</tr>
</table>

### 3. OpenAPI Specification

The following section includes the complete OpenAPI specification in YAML:

```yaml
openapi: 3.0.0

info:
  version: '1.0'
  title: 'Scrumbled Web API'
  description: 'Web Resources Specification (A7) for Scrumbled'

servers:
- url: http://lbaw.fe.up.pt
  description: Production server

externalDocs:
  description: Find more info here.
  url: https://gitlab.up.pt/lbaw/lbaw2425/lbaw24113/-/wikis/home

tags:
  - name : 'M01 - Auth'
  - name : 'M02 - Profile'
  - name : 'M03 - Project'
  - name : 'M04 - Sprint'
  - name : 'M05 - Task'
  - name : 'M06 - Admin'
  - name : 'M07 - Inbox'
  - name : 'M08 - API'

paths:
  /login:
    get:
      operationId: R101
      summary: 'R101: Login UI'
      description: 'Get the Login Page UI. Access: PUB.'
      tags:
        - 'M01 - Auth'
      responses:
        '200':
          description: 'Ok. Show Login UI'
    post:
      operationId: R102
      summary: 'R102: Login Action'
      description: 'Processes the login form submission. Access: PUB.'
      tags:
        - 'M01 - Auth'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                email:
                  type: string
                password:
                  type: string
              required:
                - email
                - password
      responses:
        '302':
          description: 'Redirect occurs after processing the login credentials.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful authentication. Redirect to user profile.'
                  value: '/users/{username}'
        '401':
              description: 'Failed authentication, incorrect password.'
        '404':
              description: 'Failed, user not found.'
  /register:
    get:
      operationId: R103
      summary: 'R103: Register UI'
      description: 'Get the Registration Page UI. Access: PUB.'
      tags:
        - 'M01 - Auth'
      responses:
        '200':
          description: 'Ok. Show Register UI.'
    post:
      operationId: R104
      summary: 'R104: Register Action'
      description: 'Processes the Register Form submission. Access: PUB.'
      tags:
        - 'M01 - Auth'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                username:
                  type: string
                bio:
                  type: string
                fullname:
                  type: string
                email:
                  type: string
                password:
                  type: string
                picture:
                  type: string
                  format: binary
              required:
                - username
                - email
                - password
      responses:
        '302':
          description: 'Redirect occurs after processing the login credentials. Access: PUB.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Account created successfully. Redirecting to projects.'
                  value: '/projects'
                302Error:
                  description: 'Failure while creating account.'
                  value: '/register'
  /logout:
    post:
      operationId: R105
      summary: 'R105: Logout Action'
      description: 'Logout the current authenticated used. Access: USR.'
      tags:
        - 'M01 - Auth'
      responses:
        '302':
          description: 'Redirect after processing logout.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful logout. Redirect to Login UI.'
                  value: '/login'
                302Error:
                  description: 'Unsuccessful logout. Redirect to projects.'
                  value: '/projects'
        '403':
          description: 'Access denied.'
  /login/forgot-password:
    get:
      operationId: R106
      summary: 'R106: Forgot Password UI'
      description: 'Get the Forgot Password Page UI. Access: PUB.'
      tags:
        - 'M01 - Auth'
      responses:
        '200':
          description: 'Ok. Show Forgot Password UI.'
  /login/reset-password:
    post:
      operationId: R107
      summary: 'R107: Reset Password Action'
      description: 'Reset the password of the user. Access: PUB.'
      tags:
        - 'M01 - Auth'
      responses:
        '302':
          description: 'Redirect after processing password reset.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully reset password. Redirect to Login UI.'
                  value: '/login'
                302Error:
                  description: 'Unsuccessful password reset. Redirect to Login UI.'
                  value: '/login'
        '403':
          description: 'Access denied.'

  /profiles:
    get:
      operationId: R201
      summary: 'R201: View profiles page'
      description: 'Show the profiles page. Access: PUB.'
      tags:
        - 'M02 - Profile'
      responses:
        '200':
          description: 'Success. Show Profiles UI'
        '404':
          description: 'User was not found.'
        '403':
          description: Access Denied
  /profiles/{username}:
    get:
      operationId: R202
      summary: 'R202: User Profile UI'
      description: 'Get the user profile. Access: PUB.'
      tags:
        - 'M02 - Profile'
      responses:
        '200':
          description: 'Ok. Show user profile.'
        '404':
          description: 'User was not found.'
      parameters:
        - in: path
          name: username
          schema:
            type: string
          required: true
  /profiles/{username}/edit:
    get:
      operationId: R203
      summary: 'R203: Edit User Profile'
      description: 'Get page for user profile editing. Access: OWN.'
      tags:
        - 'M02 - Profile'
      parameters:
        - in: path
          name : username
          schema:
            type: string
          required: true
      responses:
        '200':
          description: 'Ok. Show the page for editing the user profile.'
        '403':
          description: 'Access Denied.'
        '404':
          description: 'User was not found.'
    post:
      operationId: R204
      summary: 'R204: Edit User Profile Action'
      description: 'Processes the Edit User Profile Form submission. Access: OWN.'
      tags:
        - 'M02 - Profile'
      parameters:
        - in: path
          name: username
          schema:
            type: string
          required: true
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id:
                  type: integer
                username:
                  type: string
                bio:
                  type: string
                fullname:
                  type: string
                email:
                  type: string
                password:
                  type: string
                picture:
                  type: string
              required:
                - id
      responses:
        '302':
          description: 'Redirect after user profile edit.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Profile has been edited successfully. Redirecting to profile'
                  value: '/profiles/{username}'
                302Error:
                  description: 'Failure while updating profile.'
                  value: '/profiles/{username}/edit'
        '403':
          description: Access Denied
        '404':
          description: 'User was not found.' 
  /api/profiles/search:
    get:
      operationId: R205
      summary: 'R205: Search Profiles'
      description: 'Does an exact-match search on user profiles. Access: PUB.'
      tags:
        - 'M02 - Profile'
      parameters:
        - in: query
          name : username
          schema:
            type: string
          required: true
      responses:
        '200':
          description: Success
          content:
            application/json:
              schema:
                type: array
                items:
                  type: object
                  properties:
                    id:
                      type: integer
                    username:
                      type: string
                    full_name:
                      type: string
                    email:
                      type: string
                    picture:
                      type: string
                  example:
                    - id: 1
                      username: "johndoe"
                      full_name: "John Doe"
                      email: "johndoe@example.com"
                      picture: "https://example.com/profiles/johndoe.jpg"
  /api/profiles/changeProfileVisibility:
    post:
      operationId: R206
      summary: 'R206: Change Profile Visibility Action'
      description: 'Change the visibility of a user profile. Access: USR.'
      tags:
        - 'M02 - Profile'
      responses:
        '302':
          description: 'Redirect after processing visibility change.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful visibility change. Redirect to profile.'
                  value: '/profiles'
                302Error:
                  description: 'Unsuccessful logout. Redirect to profile.'
                  value: '/profiles'
        '403':
          description: 'Access denied.'
  /profiles/{username}/settings:
    get:
      operationId: R207
      summary: 'R207: Get User Settings'
      description: 'Get page for user settings. Access: OWN.'
      tags:
        - 'M02 - Profile'
      parameters:
        - in: path
          name : username
          schema:
            type: string
          required: true
      responses:
        '200':
          description: 'Ok. Show the page for user settings.'
        '403':
          description: 'Access Denied.'
        '404':
          description: 'User was not found.'

  /projects:
    get:
      operationId: R301
      summary: 'R301: Projects page'
      description: 'Returns all public projects, with optional filters for search. Access: PUB.'
      tags:
        - 'M03 - Project'
      parameters:
        - in: query
          name: type
          description: Filter projects by type (Public, MyProjects, Favorites, Archive).
          schema:
            type: string
            default: Public
          required: true
      responses:
        '200':
          description: Success
          content:
            application/json:
              schema:
                type: array
                items:
                  type: object
                  properties:
                    title:
                      type: string
                    slug:
                      type: string
                    description:
                      type: string
                    favorite:
                      type: boolean
                  example:
                    - title: Test Project
                      slug: test_project
                      description: "This is a test project for demonstration purposes."
                      favorite: false
  /projects/new:
    get:
      operationId: R302
      summary: 'R302: Project create UI'
      description: 'Get the Project creation form. Access: USR.'
      tags:
        - 'M03 - Project'
      responses:
        '200':
          description: 'Ok. Show Project Create UI'
        '302':
          description: Login Required.
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Redirecting to login.'
                  value: '/login'
    post:
      operationId: R303
      summary: 'R303: Create a new project'
      description: 'Creates a new project with the specified details. Access: USR.'
      tags:
        - 'M03 - Project'
      requestBody:
        description: The details of the project to be created.
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                title:
                  type: string
                description:
                  type: string
                is_public:
                  type: boolean
                  default: false
                is_archived:
                  type: boolean
                  default: false
              required:
                - title
              example:
                title: "New Project X"
                description: "We would do things here"
                is_public: true
                is_archived: false
      responses:
        '302':
          description: 'Redirect after creating the new project'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully created a new project. Redict to the new project.'
                  value: '/projects/{slug}'
                302Failure:
                  description: 'Error while creating the project. Redirect to projects page.'
                  value: '/projects'
        '403':
          description: Access Denied
  /projects/{slug}:
    get:
      operationId: R304
      summary: 'R304: View project page'
      description: 'Show the individual project page. Access: PUB.'
      tags:
        - 'M03 - Project'
      parameters:
        - in: path
          name: slug
          schema:
            type: string
          required: true
      responses:
        '200':
          description: 'Success. Show Project Page UI'
        '403':
          description: Access Denied
        '404':
          description: 'Project was not found.'
  /projects/{slug}/favorite:
    post:
      operationId: R305
      summary: 'R305: Favorite/Unfavorite a project'
      description: 'Favorites/Unfavorites a project. Access: USR.'
      tags:
        - 'M03 - Project'
      responses:
        '200':
          description: Successfully favorited/unfavorited the project
        '400':
          description: Bad request
        '401':
          description: Unauthorized
  /projects/{slug}/invite:
    get:
      operationId: R306
      summary: 'R306: Add user to Project UI'
      description: 'Get the Add user to Project form. Access: OWN.'
      tags:
        - 'M03 - Project'
      responses:
        '200':
          description: 'Ok. Show Add User UI'
        '403':
          description: Access Denied
        '404':
          description: 'Project was not found.'
    post:
      operationId: R307
      summary: 'R307: Add User to Project'
      description: 'Adds a user to the project Access: OWN.'
      tags:
        - 'M03 - Project'
      parameters:
        - in: path
          name: slug
          schema:
            type: string
          required: true
      requestBody:
        description: The details of the user to add to the project.
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                username:
                  type: string
                id:
                  type: integer
                email:
                  type: string
              oneOf:
                - required: [username]
                - required: [user_id]
                - required: [email]
      responses:
        '200':
          description: User successfully added to the project.
        '404':
          description: 'Project was not found.'
        '403':
          description: Access Denied.
  /projects/{slug}/backlog:
    get:
      operationId: R308
      summary: 'R308: View project backlog page'
      description: 'Show the individual project backlog. Access: PUB.'
      tags:
        - 'M03 - Project'
      parameters:
        - in: path
          name: slug
          schema:
            type: string
          required: true
      responses:
        '200':
          description: 'Success. Show Project Backlog UI'
        '404':
          description: 'Project was not found.'
        '403':
          description: Access Denied
  /projects/{slug}/team:
    get:
      operationId: R309
      summary: 'R309: View project team page'
      description: 'Show the project team page. Access: PUB.'
      tags:
        - 'M03 - Project'
      parameters:
        - in: path
          name: slug
          schema:
            type: string
          required: true
      responses:
        '200':
          description: 'Success. Show Project Team UI'
        '404':
          description: 'Project was not found.'
        '403':
          description: Access Denied
  /projects/{slug}/settings/general:
    get:
      operationId: R310
      summary: 'R310: General Project Settings UI'
      description: 'Show the general project settings page. Access: USR.'
      tags:
        - 'M03 - Project'
      parameters:
        - in: path
          name: slug
          schema:
            type: string
          required: true
      responses:
        '200':
          description: 'Success. Show General Project Settings UI'
        '403':
          description: Access Denied
        '404':
          description: 'Project was not found.'
  /projects/{slug}/settings/team:
    get:
      operationId: R311
      summary: 'R311: Team Project Settings UI'
      description: 'Show the team project settings page. Access: USR.'
      tags:
        - 'M03 - Project'
      parameters:
        - in: path
          name: slug
          schema:
            type: string
          required: true
      responses:
        '200':
          description: 'Success. Show Team Project Settings UI'
        '403':
          description: Access Denied
        '404':
          description: 'Project was not found.'
  /projects/{slug}/leave:
    post:
      operationId: R312
      summary: 'R312: Leave a project'
      description: 'Leave a project. Access: USR.'
      tags:
        - 'M03 - Project'
      responses:
        '200':
          description: Successfully left the project
        '400':
          description: Bad request
        '401':
          description: Unauthorized
  /projects/{slug}/remove/{username}:
    post:
      operationId: R313
      summary: 'R313: Remove a user from a project'
      description: 'Removes a user from a project. Access: OWN.'
      tags:
        - 'M03 - Project'
      responses:
        '200':
          description: Successfully removed user from the project
        '400':
          description: Bad request
        '401':
          description: Unauthorized

  /projects/{slug}/sprints:
      get:
        operationId: R401
        summary: 'R401: List all sprints for a project'
        description: 'Retrieve a list of all sprints belonging to a project. Access: USR.'
        tags:
          - 'M04 - Sprint'
        parameters:
          - in: path
            name: slug
            description: Project identifier for which to list sprints
            schema:
              type: string
            required: true
        responses:
          '200':
            description: 'Ok. List of sprints retrieved successfully.'
            content:
              application/json:
                schema:
                  type: array
                  items:
                    type: object
                    properties:
                      id:
                        type: integer
                      name:
                        type: string
                      start_date:
                        type: string
                        format: date
                      end_date:
                        type: string
                        format: date
                      is_open:
                        type: boolean
          '404':
            description: 'Project not found.'
          '403':
            description: 'Access Denied.'
          '302':
            description: Login Required.
            headers:
              Location:
                schema:
                  type: string
                examples:
                  302Success:
                    description: 'Redirecting to login.'
                    value: '/login'
  /projects/{slug}/sprints/new:
    get:
      operationId: R402
      summary: 'R402: Create a new Sprint UI'
      description: 'Get the Create Sprint form. Access: USR.'
      tags:
        - 'M04 - Sprint'
      parameters:
        - in: path
          name: slug
          description: Project where I'm creating a sprint
          schema:
            type: string
          required: true
      responses:
        '200':
          description: 'Ok. Show Create Sprint UI'
        '302':
          description: Login Required.
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Redirecting to login.'
                  value: '/login'
        '403':
          description: Access Denied
        
    post:
      operationId: R403
      summary: 'R403: Create a new Sprint'
      description: 'Creates a new sprint with the specified details. Access: USR.'
      tags:
        - 'M04 - Sprint'
      parameters:
        - in: path
          name: slug
          description: Project where I'm creating a sprint
          schema:
            type: string
          required: true
      requestBody:
        description: The details of the sprint to add to the project.
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                name:
                  type: string
                start_date:
                  type: string
                  format: date
                end_date:
                  type: string
                  format: date
                is_open:
                  type: boolean
      responses:
        '200':
          description: Sprint created successfully.
        '404':
          description: Project not found.
        '403':
          description: Access Denied
        '302':
          description: Login Required.
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Redirecting to login.'
                  value: '/login'
                302Error:
                  description: 'Failure while creating a sprint.'
                  value: '/project/{slug}/backlog'
  /sprints/{id}/edit:
    get:
      operationId: R404
      summary: 'R404: Edit sprint UI'
      description: 'Get the Edit Sprint form. Access: USR.'
      tags:
        - 'M04 - Sprint'
      responses:
        '200':
          description: 'Ok. Show Edit Sprint UI'
    post:
      operationId: R405
      summary: 'R405: Edit sprint details'
      description: 'Edits the details of a sprint. Access: USR.'
      tags:
        - 'M04 - Sprint'
      parameters:
        - in: path
          name: id
          description: Sprint identifier
          schema:
            type: integer
          required: true
      requestBody:
        required: true
        content:
          application/x-www-form-urlenconded:
            schema:
              type: object
              properties:
                name:
                  type: string
                start_date:
                  type: integer
                end_date:
                  type: integer
      responses:
        '200':
          description: 'Ok. Task details edited'
        '404':
          description: 'Task not found.'
        '403':
          description: 'Access denied.'
  /sprints/{id}/close:
    post:
      operationId: R406
      summary: 'R406 - Close a sprint'
      description: 'Mark the sprint as closed. Access: USR.'
      tags:
        - 'M04 - Sprint'
      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true
      responses:
        '200':
          description: Task successfully accepted.
        '403':
          description: Access denied.
        '404':
          description: Task not found. 
  /sprints/{id}:
    get:
      operationId: R407
      summary: 'R407: View sprint details'
      description: 'Retrieve the details of a specific sprint. Access: USR.'
      tags:
        - 'M04 - Sprint'
      parameters:
        - in: path
          name: id
          description: Sprint identifier
          schema:
            type: integer
          required: true
      responses:
        '200':
          description: 'Ok. Sprint details retrieved successfully.'
          content:
            application/json:
              schema:
                type: object
                properties:
                  id:
                    type: integer
                  name:
                    type: string
                  start_date:
                    type: string
                    format: date
                  end_date:
                    type: string
                    format: date
                  is_open:
                    type: boolean
                  tasks:
                    type: array
                    items:
                      type: object
                      properties:
                        id:
                          type: integer
                        name:
                          type: string
                        status:
                          type: string
        '404':
          description: 'Sprint not found.'
        '403':
          description: 'Access Denied.'
        '302':
          description: Login Required.
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Redirecting to login.'
                  value: '/login'
  /sprints/{id}/show:
    get:
      operationId: R408
      summary: 'R408: Sprint UI'
      description: 'Show sprint page. Access: PUB.'
      tags:
        - 'M04 - Sprint'
      parameters:
        - in: path
          name: slug
          schema:
            type: string
          required: true
      responses:
        '200':
          description: 'Success. Show Sprint UI'
        '403':
          description: Access Denied
        '404':
          description: 'Sprint was not found.'

  /projects/{slug}/tasks/new:
    get:
      operationId: R501
      summary: 'R501: Create task UI'
      description: 'Get the Create Task form. Access: USR.'
      tags:
        - 'M05 - Task'
      parameters:
        - in: path
          name: slug
          description: Project where I'm creating a task
          schema:
            type: string
          required: true
      responses:
        '200':
          description: 'Ok. Show Create Task UI'
        '302':
          description: Login Required.
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Redirecting to login.'
                  value: '/login'
        '403':
          description: Access Denied
    post:
      operationId: R502
      summary: 'R502: Create a new Task'
      description: 'Creates a new task with the specified details. Access: USR.'
      tags:
        - 'M05 - Task'
      parameters:
        - in: path
          name: slug
          description: Project where I'm creating a task
          schema:
            type: string
          required: true
      requestBody:
        description: The details of the user to add to the project.
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                title:
                  type: string
                description:
                  type: string
                value:
                  type: string
                  enum: ['must_have', 'should_have', 'could_have', 'will_not_have']
                effort:
                  type: integer
              required:
                - title
      responses:
        '200':
          description: Task created successfully.
        '404':
          description: Project not found.
        '403':
          description: Access Denied
        '302':
          description: Login Required.
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Redirecting to login.'
                  value: '/login'
                302Error:
                  description: 'Failure while creating a task.'
                  value: '/project/{slug}/backlog'     
  /tasks/{id}:
    get:
      operationId: R503
      summary: 'R503: View task details'
      description: 'Show the task details. Access: PUB.'
      tags:
        - 'M05 - Task'
      parameters:
        - in: path
          name: slug
          description: project slug
          schema:
            type: string
          required: true
        - in: path
          name: id
          description: Task identifier
          schema:
            type: integer
          required: true
      responses:
        '200':
          description: 'Ok. Show task details.'
        '403':
          description: 'Access Denied'
        '404':
          description: 'Task not found.'
  /projects/{slug}/tasks/{id}/edit:
    get:
      operationId: R504
      summary: 'R504: Edit task UI'
      description: 'Get the Edit Task form. Access: USR.'
      tags:
        - 'M05 - Task'
      responses:
        '200':
          description: 'Ok. Show Edit Task UI'
    post:
      operationId: R505
      summary: 'R505: Edit task (in backlog) details'
      description: 'Edits the details of a task. Access: USR.'
      tags:
        - 'M05 - Task'
      parameters:
        - in: path
          name: slug
          description: project slug
          schema:
            type: string
          required: true
        - in: path
          name: task_id
          description: Task identifier
          schema:
            type: integer
          required: true
      requestBody:
        required: true
        content:
          application/x-www-form-urlenconded:
            schema:
              type: object
              properties:
                title:
                  type: string
                description:
                  type: string
                assigned_to:
                  type: string
                value:
                  type: string
                  enum: [must-have, should-have, could-have, will-not-have]
                effort:
                  type: integer
                  enum: [1, 2, 3, 5, 8, 13]
                state:
                  type: string
                  enum: [backlog, sprint-backlog, in-progress, done, accepted]
              required:
                - title
                - state
      responses:
        '200':
          description: 'Ok. Task details edited'
        '404':
          description: 'Task not found.'
        '403':
          description: 'Access denied.'
  /tasks/{id}/state:
    post:
      operationId: R506
      summary: 'R506 - Update task state'
      description: 'Update the task state. Access: USR.'
      tags:
        - 'M05 - Task'
      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true
      requestBody:
        description: The task to be updated.
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id:
                  type: integer
                state:
                  type: string
                  enum: [backlog, sprint-backlog, in-progress, done, accepted]
              required:
                - id
                - state
      responses:
        '200':
          description: Successfully assigned to task.
        '403':
          description: Access denied.
        '404':
          description: Task not found.
  /api/projects/{slug}/tasks/search:
    get:
      operationId: R507
      summary: 'R507: Search Tasks'
      description: 'Does an full-text search on tasks. Access: PUB.'
      tags:
        - 'M05 - Task'
      parameters:
        - in: query
          name: slug
          schema:
            type: string
          required: true
      responses:
        '200':
          description: Success
          content:
            application/json:
              schema:
                type: array
                items:
                  type: object
                  properties:
                    id:
                      type: integer
                    title:
                      type: string
                    description:
                      type: string
                    value:
                      type: string
                      enum: ['must_have', 'should_have', 'could_have', 'will_not_have']
                    state:
                      type: string
                      enum: [backlog, sprint-backlog, in-progress, done, accepted]
                    effort:
                      type: integer
                      enum: [1, 2, 3, 5, 8, 13]
  /tasks/{id}/assign:
    post:
      operationId: R508
      summary: 'R508: Assign a task to a user'
      description: 'Assigns the specified task to a user. Access: USR.'
      tags:
        - 'M05 - Task'
      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true
          description: Task identifier to assign
      requestBody:
        description: The user ID to whom the task is being assigned
        required: true
        content:
          application/json:
            schema:
              type: object
              properties:
                user_id:
                  type: integer
                  description: The ID of the user to assign the task to
                  example: 42
      responses:
        '200':
          description: 'Task assigned successfully.'
        '404':
          description: 'Task or user not found.'
        '403':
          description: 'Access Denied.'
        '422':
          description: 'Validation failed (e.g., user cannot be assigned this task).'
        '302':
          description: Login Required.
          headers:
            Location:
              schema:
                type: string
              examples:
                302Redirect:
                  description: 'Redirecting to login.'
                  value: '/login'
  /projects/{slug}/tasks:
    get:
      operationId: R509
      summary: 'R509: View project tasks page'
      description: 'Show the project tasks page. Access: PUB.'
      tags:
        - 'M05 - Task'
      parameters:
        - in: path
          name: slug
          schema:
            type: string
          required: true
      responses:
        '200':
          description: 'Success. Show Project Tasks UI'
        '404':
          description: 'Project was not found.'
        '403':
          description: Access Denied
  /projects/{slug}/tasks/{id}/delete:
    post:
      operationId: R510
      summary: 'R510: Delete a task'
      description: 'Deletes a task. Access: USR.'
      tags:
        - 'M05 - Task'
      responses:
        '200':
          description: Successfully deleted the task
        '400':
          description: Bad request
        '401':
          description: Unauthorized
  /tasks/{id}/comment:
    post:
      operationId: R511
      summary: 'R511: Create a new task comment'
      description: 'Creates a new task comment. Access: USR.'
      tags:
        - 'M05 - Task'
      parameters:
        - in: path
          name: id
          description: Task where I'm creating a comment
          schema:
            type: integer
          required: true
      requestBody:
        description: The details of the comment 
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                description:
                  type: string
              required:
                - description
      responses:
        '200':
          description: Comment created successfully.
        '404':
          description: Task not found.
        '403':
          description: Access Denied
        '302':
          description: Login Required.
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Redirecting to login.'
                  value: '/login'
                302Error:
                  description: 'Failure while creating a comment.'
                  value: '/project/{slug}/tasks/{id}'
  /tasks/{id}/comments/{id}:
    post:
      operationId: R512
      summary: 'R512: Delete a task comment'
      description: 'Deletes a task comment. Access: USR.'
      tags:
        - 'M05 - Task'
      parameters:
        - in: path
          name: id
          description: Task where I'm deleting a comment
          schema:
            type: integer
          required: true
      responses:
        '200':
          description: Comment deleted successfully.
        '404':
          description: Task not found.
        '403':
          description: Access Denied
        '302':
          description: Login Required.
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Redirecting to login.'
                  value: '/login'
                302Error:
                  description: 'Failure while deleting a comment.'
                  value: '/project/{slug}/tasks/{id}'
  /tasks/{id}/comments/{id}/edit:
    post:
      operationId: R513
      summary: 'R513: Edit a task comment'
      description: 'Edits a task comment. Access: USR.'
      tags:
        - 'M05 - Task'
      parameters:
        - in: path
          name: id
          description: Task where I'm editing a comment
          schema:
            type: integer
          required: true
      requestBody:
        description: The details of the comment 
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                description:
                  type: string
              required:
                - description
      responses:
        '200':
          description: Comment edited successfully.
        '404':
          description: Task not found.
        '403':
          description: Access Denied
        '302':
          description: Login Required.
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Redirecting to login.'
                  value: '/login'
                302Error:
                  description: 'Failure while editing a comment.'
                  value: '/project/{slug}/tasks/{id}'

  /admin/users:
    get:
      operationId: R601
      summary: 'R601: Search user accounts'
      description: 'Retrieve list of user accounts with filtering. Access: ADM.'
      tags:
        - 'M06 - Admin'
      parameters:
        - in: query
          name: query
          description: 'String to search for user accounts'
          schema:
            type: string
          required: false
        - in: query
          name: status
          description: 'Filter user accounts by status'
          schema:
            type: string
            enum: [needs-confirmation, banned, active]
          required: false
      responses:
        '200':
          description: 'Ok. List of user accounts returned.'
          content:
            application/x-www-form-urlencoded:
              schema:
                type: array
                items:
                  type: object
                  properties:
                    username:
                      type: string
                    full_name:
                      type: string
                    picture:
                      type: string
                    email:
                      type: string
                    status:
                      type: string
        '400':
          description: 'User account not found.'
  /admin/users/{username}/edit:
    get:
      operationId: R602
      summary: 'R602: View user account details for editing'
      description: 'Gets the deetails of the user account to be edited. Access: ADM.'
      tags:
        - 'M06 - Admin'
      parameters:
        - in: path
          name: username
          description: 'Username of the account to view'
          schema:
            type: string
          required: true
      responses:
        '200':
          description: 'Ok. User account details returned'
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  username:
                    type: string
                  full_name:
                    type: string
                  picture:
                    type: string
                  bio:
                    type: string
                  email:
                    type: string
                  status:
                    type: string
        '400':
          description: 'User account not found.'
    post:
      operationId: R603
      summary: 'R603 - Edit user account'
      description: 'Edits a user account. Access: ADM.'
      tags:
        - 'M06 - Admin'
      parameters:
        - in: path
          name: username
          description: 'Username of the account to edit.'
          schema:
            type: string
          required: true
      requestBody:
        required: true
        content:
          application/json:
            schema:
              type: object
              properties:
                username:
                  type: string
                  description: 'Edited username for the user account.'
                full-name:
                  type: string
                  description: 'Edited full name for the user account.'
                bio:
                  type: string
                  description: 'Edited bio for the user account.'
                picture:
                  type: string
                  description: 'Edited picture path for the user account.'
                email:
                  type: string
                  format: email
                  description: 'Edited email address for the user account.'
                password:
                  type: string
                  format: password
                  description: 'Edited password for the user account.'
                status:
                  type: string
                  enum: [needs-confirmation, banned, active]
                  description: 'Edited status for the user account.'
      responses:
        '200':
          description: 'Ok. User account edited'
        '400':
          description: 'User account not found or Editing invalid.'
  /admin/users/{username}/ban:
    post:
      operationId: R604
      summary: 'R604 - Ban user account'
      description: 'Bans a user account. Access: ADM.'
      tags:
        - 'M06 - Admin'
      parameters:
        - in: path
          name: username
          description: 'Username of the account to edit.'
          schema:
            type: string
          required: true
      requestBody:
        required: true
        content:
          application/json:
            schema:
              type: object
              properties:
                username:
                  type: string
                  description: 'Edited username for the user account.'
                full-name:
                  type: string
                  description: 'Edited full name for the user account.'
                bio:
                  type: string
                  description: 'Edited bio for the user account.'
                picture:
                  type: string
                  description: 'Edited picture path for the user account.'
                email:
                  type: string
                  format: email
                  description: 'Edited email address for the user account.'
                password:
                  type: string
                  format: password
                  description: 'Edited password for the user account.'
                status:
                  type: string
                  enum: [needs-confirmation, banned, active]
                  description: 'Edited status for the user account.'
      responses:
        '200':
          description: 'Ok. User account banned'
        '400':
          description: 'User account not found or ban invalid.'
  /admin/users/{username}/unban:
    post:
      operationId: R605
      summary: 'R605 - Unban user account'
      description: 'Unbans a user account. Access: ADM.'
      tags:
        - 'M06 - Admin'
      parameters:
        - in: path
          name: username
          description: 'Username of the account to edit.'
          schema:
            type: string
          required: true
      requestBody:
        required: true
        content:
          application/json:
            schema:
              type: object
              properties:
                username:
                  type: string
                  description: 'Edited username for the user account.'
                full-name:
                  type: string
                  description: 'Edited full name for the user account.'
                bio:
                  type: string
                  description: 'Edited bio for the user account.'
                picture:
                  type: string
                  description: 'Edited picture path for the user account.'
                email:
                  type: string
                  format: email
                  description: 'Edited email address for the user account.'
                password:
                  type: string
                  format: password
                  description: 'Edited password for the user account.'
                status:
                  type: string
                  enum: [needs-confirmation, banned, active]
                  description: 'Edited status for the user account.'
      responses:
        '200':
          description: 'Ok. User account unbanned'
        '400':
          description: 'User account not found or unban invalid.'
  /admin/users/{username}:
    get:
      operationId: R606
      summary: 'R606: View user account details'
      description: 'Gets the user account. Access: ADM.'
      tags:
        - 'M06 - Admin'
      parameters:
        - in: path
          name: username
          description: 'Username of the account to view'
          schema:
            type: string
          required: true
      responses:
        '200':
          description: 'Ok. User account details returned'
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  username:
                    type: string
                  full_name:
                    type: string
                  picture:
                    type: string
                  bio:
                    type: string
                  email:
                    type: string
                  status:
                    type: string
        '400':
          description: 'User account not found.'
  /admin/login:
    get:
      operationId: R607
      summary: 'R607: Admin Login UI'
      description: 'Get the Admin Login Page UI. Access: ADM.'
      tags:
        - 'M06 - Admin'
      responses:
        '200':
          description: 'Ok. Show Admin Login UI'
    post:
      operationId: R608
      summary: 'R608: Admin Login Action'
      description: 'Processes the admin login form submission. Access: ADM.'
      tags:
        - 'M06 - Admin'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                email:
                  type: string
                password:
                  type: string
              required:
                - email
                - password
      responses:
        '302':
          description: 'Redirect occurs after processing the login credentials.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful authentication. Redirect to users list.'
                  value: '/admin/users'
        '401':
              description: 'Failed authentication, incorrect password.'
        '404':
              description: 'Failed, admin not found.'
  /admin/users/create:
    get:
        operationId: R609
        summary: 'R609: Admin user creation UI'
        description: 'Get the Admin user creation page UI. Access: ADM.'
        tags:
          - 'M06 - Admin'
        responses:
          '200':
            description: 'Ok. Show Admin user creation UI'
    post:
        operationId: R610
        summary: 'R610: Admin user creation Action'
        description: 'Creates a new user. Access: ADM.'
        tags:
          - 'M06 - Admin'
        requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  email:
                    type: string
                  password:
                    type: string
                required:
                  - email
                  - password
        responses:
          '302':
            description: 'Redirect occurs after creating a user.'
            headers:
              Location:
                schema:
                  type: string
                examples:
                  302Success:
                    description: 'Successful user creation. Redirect to users list.'
                    value: '/admin/users'
          '401':
                description: 'Failed user creation.'
          '404':
                description: 'Failed, admin not found.'
  /admin/users/delete:
    post:
      operationId: R611
      summary: 'R611: Delete a user'
      description: 'Lets an admin delete a user. Access: ADM.'
      tags:
        - 'M06 - Admin'
      requestBody:
        description: The details of the user to be deleted.
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id:
                  type: integer
      responses:
        '200':
          description: User deleted successfully.
        '404':
          description: User not found.
        '403':
          description: Access Denied.
  /admin/logout:
    post:
      operationId: R612
      summary: 'R612: Admin Logout Action'
      description: 'Logout the current admin. Access: ADM.'
      tags:
        - 'M06 - Admin'
      responses:
        '302':
          description: 'Redirect after processing logout.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful logout. Redirect to Main Page UI.'
                  value: '/'
                302Error:
                  description: 'Unsuccessful logout. Redirect to users list.'
                  value: '/admin/users'
        '403':
          description: 'Access denied.'
  /admin/projects:
    get:
      operationId: R613
      summary: 'R613: Projects Page UI'
      description: 'Retrieve list of projects with filtering. Access: ADM.'
      tags:
        - 'M06 - Admin'
      parameters:
        - in: query
          name: query
          description: 'String to search for projects'
          schema:
            type: string
          required: false
        - in: query
          name: status
          description: 'Filter projects by visibility'
          schema:
            type: string
            enum: [needs-confirmation, banned, active]
          required: false
        - in: query
          name: is_archived
          description: 'Filter projects by archival status. True for archived, false for active.'
          required: false
          schema:
            type: boolean
      responses:
        '200':
          description: 'Ok. List of projects returned.'
          content:
            application/x-www-form-urlencoded:
              schema:
                type: array
                items:
                  type: object
                  properties:
                    title:
                      type: string
                    description:
                      type: string
                    slug:
                      type: string
                    is_archived:
                      type: boolean
                    is_public:
                      type: boolean

  /inbox:
    get:
      operationId: R701
      summary: 'R701: Inbox UI'
      description: 'Get the Inbox UI. Access: USR.'
      tags:
        - 'M07 - Inbox'
      responses:
        '200':
          description: 'Ok. Show Inbox UI'
  /inbox/invitations:
    get:
      operationId: R702
      summary: 'R702: Inbox Invitations UI'
      description: 'Get the Inbox Invitations UI. Access: USR.'
      tags:
        - 'M07 - Inbox'
      responses:
        '200':
          description: 'Ok. Show Inbox Invitiations UI'
  /inbox/acceptInvitation:
    post:
      operationId: R703
      summary: 'R703: Accept an invitation to a project'
      description: 'Accepts an invitation to a project. Access: USR.'
      tags:
        - 'M07 - Inbox'
      responses:
        '200':
          description: Successfully accpeted the project invitation
        '400':
          description: Bad request
        '401':
          description: Unauthorized
  /inbox/declineInvitation:
    post:
      operationId: R704
      summary: 'R704: Decline an invitation to a project'
      description: 'Declines an invitation to a project. Access: USR.'
      tags:
        - 'M07 - Inbox'
      responses:
        '200':
          description: Successfully declined the project invitation
        '400':
          description: Bad request
        '401':
          description: Unauthorized
  /inbox/delete:
    post:
      operationId: R705
      summary: 'R705: Delete selected notifications'
      description: 'Deletes notifications that are selected in the inbox. Access: USR.'
      tags:
        - 'M07 - Inbox'
      responses:
        '200':
          description: Successfully deleted the notifications
        '400':
          description: Bad request
        '401':
          description: Unauthorized
  
  /api/projects/changeVisibility:
    post:
      operationId: R801
      summary: 'R801: Change project visibility'
      description: 'Changes project visibility. Access: OWN.'
      tags:
        - 'M08 - API'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                slug:
                  type: string
              required:
                - slug
      responses:
        '302':
          description: 'Redirect occurs after changing project visibility.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully changed project visibility. Redirect to project settings.'
                  value: '/projects/{slug}/settings/general'
        '401':
              description: 'Failed changing project visibility.'
        '404':
              description: 'Failed, project not found.'
  /api/projects/transferProject:
    post:
      operationId: R802
      summary: 'R802: Transfer project ownership'
      description: 'Transfers project ownership. Access: OWN.'
      tags:
        - 'M08 - API'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                slug:
                  type: string
                user_id:
                  type: integer
                sm_loss:
                  type: boolean
                dev_loss:
                  type: boolean
              required:
                - slug
                - user_id
                - sm_loss
                - dev_loss
      responses:
        '302':
          description: 'Redirect occurs after transfering project ownership.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully tranferred project ownership. Redirect to project settings.'
                  value: '/projects/{slug}/settings/general'
        '401':
              description: 'Failed transfering project ownership.'
        '404':
              description: 'Failed, project not found.'
  /api/projects/transferProject/search:
    post:
      operationId: R803
      summary: 'R803: Search Users when Transfering Project'
      description: 'Searches userse when transfering a project. Access: OWN.'
      tags:
        - 'M08 - API'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                search:
                  type: string
                slug:
                  type: string
              required:
                - search
                - slug
      responses:
        '200':
              description: 'Ok. Show searched users.'
        '401':
              description: 'Failed retrieving searched users.'
        '404':
              description: 'Failed, project not found.'
  /api/projects/team/setScrumMaster:
    post:
      operationId: R804
      summary: 'R804: Set Project Scrum Master'
      description: 'Sets a user as scrum master of a project. Access: OWN.'
      tags:
        - 'M08 - API'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                slug:
                  type: string
                userId:
                  type: integer
              required:
                - slug
                - userId
      responses:
        '302':
          description: 'Redirect occurs after setting user as scrum master.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully set Scrum Master. Redirect to project settings.'
                  value: '/projects/{slug}/settings/general'
        '401':
              description: 'Failed setting Scrum Master.'
        '404':
              description: 'Failed, project not found.'
  /api/projects/team/removeScrumMaster:
    post:
      operationId: R805
      summary: 'R805: Remove Project Scrum Master'
      description: 'Removes scrum master of a project. Access: OWN.'
      tags:
        - 'M08 - API'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                slug:
                  type: string
                userId:
                  type: integer
              required:
                - slug
                - userId
      responses:
        '302':
          description: 'Redirect occurs after removing scrum master.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully removed Scrum Master. Redirect to project settings.'
                  value: '/projects/{slug}/settings/general'
        '401':
              description: 'Failed removing Scrum Master.'
        '404':
              description: 'Failed, project not found.'
  /api/projects/team/removeDeveloper:
    post:
      operationId: R806
      summary: 'R806: Removes Developer from Project'
      description: 'Removes a developer from a project. Access: OWN.'
      tags:
        - 'M08 - API'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                slug:
                  type: string
                userId:
                  type: integer
              required:
                - slug
                - userId
      responses:
        '302':
          description: 'Redirect occurs after removing developer from project.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully removed developer. Redirect to project settings.'
                  value: '/projects/{slug}/settings/general'
        '401':
              description: 'Failed removing developer.'
        '404':
              description: 'Failed, project not found.'
  /api/projects/leaveProject:
    post:
      operationId: R807
      summary: 'R807: Leave Project'
      description: 'Leave a project. Access: USR.'
      tags:
        - 'M08 - API'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                slug:
                  type: string
                userId:
                  type: integer
              required:
                - slug
                - userId
      responses:
        '302':
          description: 'Redirect occurs after leaving project.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully left project. Redirect to projects page.'
                  value: '/projects'
        '401':
              description: 'Failed leaving project.'
        '404':
              description: 'Failed, project not found.'
  /api/projects/archiveProject:
    post:
      operationId: R808
      summary: 'R808: Archive a project'
      description: 'Archives a project. Access: OWN.'
      tags:
        - 'M08 - API'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                slug:
                  type: string
              required:
                - slug
      responses:
        '302':
          description: 'Redirect occurs after archiving a project.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully archived project. Redirect to project settings.'
                  value: '/projects/{slug}/settings/general'
        '401':
              description: 'Failed archiving project.'
        '404':
              description: 'Failed, project not found.'
  /api/projects/deleteProject:
    post:
      operationId: R809
      summary: 'R809: Delete a project'
      description: 'Deletes a project. Access: OWN.'
      tags:
        - 'M08 - API'
      requestBody:
        description: The details of the project to be deleted.
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                slug:
                  type: string
      responses:
        '200':
          description: Project deleted successfully.
        '404':
          description: Project not found.
        '403':
          description: Access Denied.
  /api/projects/changeProjectTitle:
    post:
      operationId: R810
      summary: 'R810: Changes Project Title'
      description: 'Changes the title of a project. Access: OWN.'
      tags:
        - 'M08 - API'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                slug:
                  type: string
                title:
                  type: string
              required:
                - slug
                - title
      responses:
        '302':
          description: 'Redirect occurs after changing project title.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully changed project title. Redirect to project settings.'
                  value: '/projects/{slug}/settings/general'
        '401':
              description: 'Failed changing project title.'
        '404':
              description: 'Failed, project not found.'
  /api/projects/changeProjectDescription:
    post:
      operationId: R811
      summary: 'R811: Changes Project Description'
      description: 'Changes the description of a project. Access: OWN.'
      tags:
        - 'M08 - API'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                slug:
                  type: string
                description:
                  type: string
              required:
                - slug
                - description
      responses:
        '302':
          description: 'Redirect occurs after changing project description.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully changed project description. Redirect to project settings.'
                  value: '/projects/{slug}/settings/general'
        '401':
              description: 'Failed changing project description.'
        '404':
              description: 'Failed, project not found.'
  /api/projects/search:
    post:
      operationId: R812
      summary: 'R812: Search Projects'
      description: 'Searches project. Access: USR.'
      tags:
        - 'M08 - API'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                search:
                  type: string
                statusVisibility:
                  type: boolean
                statusArchival:
                  type: boolean
              required:
                - search
                - statusVisibility
                - statusArchival
      responses:
        '200':
              description: 'Ok. Show searched projets.'
        '401':
              description: 'Failed retriving searched projects.'
        '404':
              description: 'Failed, user not found.'
  /api/profiles/changeUsername:
    post:
      operationId: R813
      summary: 'R813: Change username'
      description: 'Changes a username. Access: OWN.'
      tags:
        - 'M08 - API'
      requestBody:
        description: The details of the user to be changed.
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id:
                  type: integer
                username:
                  type: string
      responses:
        '200':
          description: Username changed successfully.
        '404':
          description: User not found.
        '403':
          description: Access Denied.
  /api/profiles/changeEmail:
    post:
      operationId: R814
      summary: 'R814: Change email'
      description: 'Changes an email. Access: OWN.'
      tags:
        - 'M08 - API'
      requestBody:
        description: The details of the user to be changed.
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id:
                  type: integer
                email:
                  type: string
      responses:
        '200':
          description: Email changed successfully.
        '404':
          description: User not found.
        '403':
          description: Access Denied.
  /api/profiles/changeFullName:
    post:
      operationId: R815
      summary: 'R815: Change Full Name'
      description: 'Changes full name of a user. Access: OWN.'
      tags:
        - 'M08 - API'
      requestBody:
        description: The details of the user to be changed.
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id:
                  type: integer
                full_name:
                  type: string
      responses:
        '200':
          description: Full name changed successfully.
        '404':
          description: User not found.
        '403':
          description: Access Denied.
  /api/profiles/changeBio:
    post:
      operationId: R816
      summary: 'R816: Change Bio'
      description: 'Changes the bio of a user. Access: OWN.'
      tags:
        - 'M08 - API'
      requestBody:
        description: The details of the user to be changed.
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id:
                  type: integer
                bio:
                  type: string
      responses:
        '200':
          description: Bio changed successfully.
        '404':
          description: User not found.
        '403':
          description: Access Denied.
  /api/profiles/changeProfilePicture:
    post:
      operationId: R817
      summary: 'R817: Change Profile Picture'
      description: 'Changes the profile picture of a user. Access: OWN.'
      tags:
        - 'M08 - API'
      requestBody:
        description: The details of the user to be changed.
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id:
                  type: integer
                profile_picture:
                  type: string
      responses:
        '200':
          description: Profile picture changed successfully.
        '404':
          description: User not found.
        '403':
          description: Access Denied.
  /api/users/delete:
    post:
      operationId: R618
      summary: 'R618: Delete a user'
      description: 'Lets an admin delete a user. Access: ADM.'
      tags:
        - 'M08 - API'
      requestBody:
        description: The details of the user to be deleted.
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id:
                  type: integer
      responses:
        '200':
          description: User deleted successfully.
        '404':
          description: User not found.
        '403':
          description: Access Denied.
```

The OpenAPI specification in the repository can be accessed through the following link:

[OpenAPI Specification](https://gitlab.up.pt/lbaw/lbaw2425/lbaw24113/-/blob/main/docs/a7_openapi.yaml?ref_type=heads)

---

## A8: Vertical prototype

The Vertical Prototype focuses on high-priority features and covers all solution layers (UI, business logic and data access), featuring pages for viewing, adding, editing and deleting data, access control and the presentation of error and success messages.

### 1. Implemented Features

#### 1.1. Implemented User Stories

The implemented user stories are described in the following table:

| User Story reference | Name | Priority | Responsible | Description |
|----------------------|------|----------|-------------|-------------|
| US11 | Login | High | Simão | As a _Visitor_, I want to log into the system, so that I can have access to more information. |
| US12 | Register | High | Vanessa | As a _Visitor_, I want to register for an account, so that I can access it in the future. |
| US21 | See User Profile | High | Vanessa | As a _User_, I would like to have access to profiles, so that I can check people’s information. |
| US22 | Exact Match Search | High | Vanessa | As a _User_, I want to be able to search for an exact string so that I quickly get to a User Profile or a Project. |
| US23 | Full-text Search | High | Simão | As a _User_, I want to be able to perform full-text search so that I can find important topics in the middle of texts that I consider big. |
| US24 | Search Filters | High | António | As an _User_, I want to use search filters (such as who the _Product Owner_ is) when searching for Projects so that I can find the project easily. |
| US31 | Create Project | High | António | As an _Authenticated User_, I want to create a new Scrum project, so that I can set up a workspace for managing sprints, backlogs, and team members. |
| US32 | View My Projects | High | João | As an _Authenticated User_, I want to view all my Scrum projects, so that I can track the progress of multiple projects and access the necessary project information. |
| US33 | Logout | High | Simão | As an _Authenticated user_, I want to log out of the system, so that I can prevent unauthorized access. |
| US34 | Edit Authenticated User's Profile | High | Vanessa | As an _Authenticated User_, I would like to change my profile, so that I can keep my information up to date. |
| US41 | Search Tasks | High | António | As a _Project Member_, I want to be able to search for tasks, so that I can easily find any task created in my projects. |
| US42 | Search over Multiple Attributes | High | João | As a _Project Member_, I want to search over multiple attributes when searching for tasks (such as Name, Priority and Developers that are assigned to it) so that I can narrow my search and be able to see less results. |
| US51 | Complete an Assigned Task | High | João | As a _Developer_, I want to check an assigned task as possibly complete, so that I can organize myself better and inform others of the possibly completed task. |
| US52 | View Task Details | High | Simão | As a _Developer_, I want to view the task details, so that I know exactly what I have to do. |
| US61 | Create Task | High | Vanessa | As a _Product Owner_, I want to be able to add new tasks to the backlog, so that all work is organized and ready for the next or current sprint. |
| US62 | Manage Task Priority | High | João | As a _Product Owner_, I want to be able to change each task priority, so that all of them are organized and the assignment of tasks can be done efficiently. |
| US63 | Manage Task Labels | High | Simão | As a _Product Owner_, I want to be able to change each task label, so that every team member can clearly understand what is expected to be done in each task. |
| US64 | Mange Task Due Date | High | Vanessa | As a _Product Owner_, I want to be able to change each task due date, so that the assignment of tasks can be done with deadlines in mind. |
| US65 | Accept a Completed Task | High | António | As a _Product Owner_, I want to be able to accept the completion of a task, so that the Developers that are assigned know that the given task was accepted. |
| US66 | Add User to Project | High | João | As a _Product Owner_, I want to add a user to a project, so that the whole scrum team can join. |
| US81 | Search User Accounts | High | Simão | As an _Admin_, I want to be able to search for specific user accounts, so that I can easily find the users I want to act on. |
| US82 | View User Accounts | High | Vanessa | As an _Admin_, I want to be able to view user accounts, so that I can know the projects he is involved, the role he has and the comments he is making. |
| US83 | Edit User Accounts | High | António | As an _Admin_, I want to be able to edit user accounts, so that I can elevate or lower its privileges. |
| US84 | Create User Accounts | High | João | As an _Admin_, I want to be to create user accounts, so that I can test the way different roles interact with the platform. |

#### 1.2. Implemented Web Resources

The implemented web resources are described in the following table:

##### Module M01: Authentication

| Web Resource Reference | URL            |
|------------------------|----------------|
| R101: Login UI         | GET /login     |
| R102: Login Action     | POST /login    |
| R103: Register UI      | GET /register  |
| R104: Register Action  | POST /register |
| R105: Logout Action    | POST /logout   |

##### Module M02: Profile

| Web Resource Reference         | URL                            |
|------------------------------- |--------------------------------|
| R201: View profiles page       | GET /profiles                  |
| R202: User Profie UI           | GET /profile/{username}        |
| R203: Edit User Profile        | GET /profile/{username}/edit   |
| R204: Edit User Profile Action | POST /profiles/{username}/edit |
| R205: Search Profiles          | GET /api/profiles/search       |

##### Module M03: Project

| Web Resource Reference          | URL                                     |
|---------------------------------|-----------------------------------------|
| R301: Projects page             | GET /projects                           |
| R302: Project create UI         | GET /projects/new                       |
| R303: Create a new project      | POST /projects/new                      |
| R304: View project page         | GET /projects/{slug}                    |
| R305: Add user to project UI    | GET /projects/{slug}/invite             |
| R306: Add user to project       | POST /projects/{slug}/invite            |
| R307: View project backlog page | GET /projects/{slug}/backlog            |
| R308: Search for task           | GET /projects/{slug}/team               |

##### Module M04: Sprint

| Web Resource Reference               | URL                               |
|--------------------------------------|-----------------------------------|
| R401: List all sprints for a project | GET /projects/{slug}/sprints      |
| R402: Create a new sprint UI         | GET /projects/{slug}/sprints/new  |
| R403: Create a new sprint            | POST /projects/{slug}/sprints/new |
| R404: Edit sprint UI                 | GET /sprints/{id}/edit            |
| R405: Edit sprint details            | POST /sprints/{id}/edit           |
| R406: Close a sprint                 | POST /sprints/{id}/close          |
| R407: View sprint details            | GET /sprints/{id}                 |

##### Module M05: Task

| Web Resource Reference               | URL                                   |
|--------------------------------------|---------------------------------------|
| R501: Create task UI                 | GET /projects/{slug}/tasks/new        |
| R502: Create a new task              | POST /projects/{slug}/tasks/new       |
| R503: View task details              | GET /tasks/{id}                       |
| R504: Edit task UI                   | GET /tasks/{id}/edit                  |
| R505: Edit task (in backlog) details | POST /tasks/{id}/edit                 |
| R506: Update task state              | POST /tasks/{id}/state                |
| R507: Search tasks                   | GET /api/projects/{slug}/tasks/search | 
| R508: Assign a task to a user        | POST /tasks/{id}/assign               |
| R509: View project tasks page        | GET /projects/{slug}/tasks            |

##### Module M06: Admin

| Web Resource Reference                      | URL                                |
|---------------------------------------------|------------------------------------|
| R601: Search user accounts                  | GET /admin/users                   |
| R602: View user account details for editing | GET /admin/users/{username}/edit   |
| R603: Edit user accounts                    | POST /admin/users/{username}/edit  |
| R604: Ban user account                      | POST /admin/users/{username}/ban   |
| R605: Unban user account                    | POST /admin/users/{username}/unban |
| R606: View user account details             | GET /admin/users/{username}        |
| R607: Admin Login UI                        | GET /admin/login                   |
| R608: Admin Login Action                    | POST /admin/login                  |
| R609: Admin user creation UI                | GET /admin/users/create            |
| R610: Admin user creation action            | POST /admin/users/create           |

### 2. Prototype

We tried to run the provided bash script. However, the VPN services and GitLab servers (gitlab.up.pt:5050...) were not working correctly. We decided to find an alternative.
The docker image can be found in Deploy > Releases.
```bash
docker save -o ~/Desktop/lbaw24113.dockerbuild sha256:fae633d56d6bf4c927e2afd86f0e00109eb4ef4474a0c20c412ca8d700e4ebb2
```
In order to run the application, the following command should work:
```bash
docker load -i <path to image tar file>
```

Credentials:
- admin: admin@email.com/password
- user1: up202207919@up.pt/password
- user2: up202205469@up.pt/password (Product Owner of Project "Scrumbled")

The source code can be viewed through the following link:
[GitLab Repository Source Code](https://gitlab.up.pt/lbaw/lbaw2425/lbaw24113)

---

## Revision history
#### 22/12/2024:
Corrected A7 - Vanessa Queirós

---

GROUP24113, 25/11/2024

* António Santos, up202205469@up.pt
* Vanessa Queirós, up202207919@up.pt (Editor)
* João Santos, up202205794@up.pt
* Simão Neri, up202206370@up.pt