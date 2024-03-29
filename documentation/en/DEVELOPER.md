# Nebuloo developer documentation

## Installation:
1. The source code of the project can be downloaded by running the following command in the terminal: `git clone https://github.com/FEB-csapat/nebuloo.git`
2. Run start.sh shell script in the root directory of the project: `sh start.sh`

If running the script fails, the commands must be runned manually:
1. `copy .env.example .env` rename file “.env.example” to “.env”
2. Run `docker compose up` command to start containers
3. Run `docker compose exec app fish` command to enter the container

Inside the container:

4. Run `composer install` command to download Laravel related dependencies
5. Run `php artisan key:generate` command to generate the key required for the API
6. Run `php artisan migrate:fresh --seed` command to run database migrations and seeders
7. Run the `npm install` command to download Vue-related dependencies

Finally, to run the Vite live server, you need to run the `npm run dev` command, after which the website can be accessed at https://localhost:8881


### Backend is written in Laravel

* API Controllers (app/Http/Controllers directory): Define how to handle each API request, respond to API requests, perform data processing and manipulation, and return the response to the client.
* API Requests (app/Http/Requests directory): Contains the classes used to validate all HTTP requests.
* API Resources (app/Http/Resources directory): This directory is used to prepare data for APIs.
* Policies (app/Policies directory): Allow or deny user interactions within the application as part of the authentication service.
* Models (app/Models directory): Classes that correspond to database tables. Models allow you to handle data, such as querying, modifying, or deleting data from the database.
* Migrations (database/migrations directory): Allow handling database changes and updates.
* Seeders (database/seeders directory): Add data to database tables that can be used for testing or other purposes.
* Factories (database/factories directory): Automatically create test data for database tables and enable fast and efficient generation of large amounts of data in the database.
* Localization (lang directory): Allows the translation of the application text into other languages.
* API Routing (routes/api.php file): Defines all API routes that the application can respond to and the corresponding controller classes.
* E-mail notifications (app/Mail directory): Enable the creation and formatting of emails, as well as sending them to users.
* API Tests (tests directory): API tests allow for automatic testing of the application's API to ensure that requests and responses meet expectations.

### Frontend is written in Vue.js
All the files used by the frontend are located in the resources folder

* Images and styles (resources/assets): Contains the images and styles used by the web client.
* Vue components (resources/components)
* Vue pages (resources/views)
* JavaScript (resources/js)
* Web routing (resources/router/index.js): Contains the views corresponding to the web client's routes.
* Helper classes (resources/utils)
* Web tests (NebulooWebTest directory): Contains automated web tests written using the Selenium framework.


## Database

![Database model](/documentation/demo_database_model.png)

### users table

| Key     | Name             | Data Type        | Description                                     | Restrictions  |
|---------|------------------|------------------|-------------------------------------------------|---------------|
| primary | id               | Unsigned Bigint  | Unique Key                                      | Unique        |
|         | username             | String           | Name of the user                                | Unique        |
|         | display_name     | String           | Display name of the user                        |               |
|         | email            | String           | Email of the user                               | Unique        |
|         | password         | String           | Password of the user                            | Nullable      |
|         | remember_token   | String           | Token used for "remember me" functionality      |               |
|         | bio              | String           | Short bio or description of the user            | Nullable      |
|         | notify_by_email  | Boolean          | Whether the user wants to receive email updates | Default True  |
|         | role             | Enumeration      | Role of the user                                | Default 'user'|
|         | banned           | Boolean          | Whether the user is banned or not               | Default False |
|         | created_at       | Timestamp        | Timestamp for creation                          |               |
|         | updated_at       | Timestamp        | Timestamp for last update                       |               |

migration code:
```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name')->unique();
    $table->string('display_name');
    $table->string('email')->unique();
    $table->string('password')->nullable();
    $table->rememberToken();
    $table->string('bio')->nullable();
    $table->boolean('notify_by_email')->default(true);
    $table->enum('role', ['user', 'moderator', 'admin'])->default('user');
    $table->boolean('banned')->default(false);
    $table->timestamps();
});
```

### subjects table

| Key     | Name              | Data Type       | Description                     | Restrictions |
|---------|-------------------|-----------------|---------------------------------|--------------|
| primary | id                | Unsigned Bigint | Unique Key                      | Unique       |
|         | creator_user_id   | Unsigned Bigint | Foreign key of the creator      | Nullable     |
|         | name              | String          | Name of the subject             |              |
|         | created_at        | Timestamp       | Timestamp for creation          |              |
|         | updated_at        | Timestamp       | Timestamp for last update       |              |

migration code:
```php
Schema::create('subjects', function (Blueprint $table) {
    $table->id();
    $table->foreignId('creator_user_id')->nullable()
        ->references('id')->on('users')->cascadeOnDelete();
    $table->string('name');
    $table->timestamps();
});
```

### topics table

| Key     | Name              | Data Type       | Description                     | Restrictions |
|---------|-------------------|-----------------|---------------------------------|--------------|
| primary | id                | Unsigned Bigint | Unique Key                      | Unique       |
|         | subject_id        | Unsigned Bigint | Foreign key of the subject      | Nullable     |
|         | creator_user_id   | Unsigned Bigint | Foreign key of the creator      | Nullable     |
|         | name              | String          | Name of the topic               |              |
|         | created_at        | Timestamp       | Timestamp for creation          |              |
|         | updated_at        | Timestamp       | Timestamp for last update       |              |

migration code:
```php
Schema::create('topics', function (Blueprint $table) {
    $table->id();
    $table->foreignId('subject_id')->nullable()
        ->references('id')->on('subjects')->cascadeOnDelete();
    $table->foreignId('creator_user_id')->nullable()
        ->references('id')->on('users')->cascadeOnDelete();
    $table->string('name');
    $table->timestamps();
});
```

### contents table

| Key     | Name              | Data Type       | Description                 | Restrictions |
|---------|-------------------|-----------------|-----------------------------|--------------|
| primary | id                | Unsigned Bigint | Unique Key                  | Unique       |
|         | creator_user_id   | Unsigned Bigint | Foreign key of the creator  |              |
|         | body              | LongText        | Body of the content         |              |
|         | subject_id        | Unsigned Bigint | Foreign key of the subject  | Nullable     |
|         | topic_id          | Unsigned Bigint | Foreign key of the topic    | Nullable     |
|         | created_at        | Timestamp       | Timestamp for creation      |              |
|         | updated_at        | Timestamp       | Timestamp for last update   |              |

migration code:
```php
Schema::create('contents', function (Blueprint $table) {
    $table->id();
    $table->foreignId('creator_user_id')->references('id')->on('users')->cascadeOnDelete();
    $table->longText('body');
    $table->foreignId('subject_id')->nullable()->references('id')->on('subjects')->cascadeOnDelete();
    $table->foreignId('topic_id')->nullable()->references('id')->on('topics')->cascadeOnDelete();
    $table->timestamps();
});
```

### questions table

| Key     | Name              | Data Type       | Description                     | Restrictions |
|---------|-------------------|-----------------|---------------------------------|--------------|
| primary | id                | Unsigned Bigint | Unique Key                      | Unique       |
|         | creator_user_id   | Unsigned Bigint | Foreign key of the creator      |              |
|         | title             | String          | Title of the question           |              |
|         | body              | LongText        | Body of the question            | Nullable     |
|         | subject_id        | Unsigned Bigint | Foreign key of the subject      | Nullable     |
|         | topic_id          | Unsigned Bigint | Foreign key of the topic        | Nullable     |

migration code:
```php
Schema::create('questions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('creator_user_id')->references('id')->on('users')->cascadeOnDelete();
    $table->string('title');
    $table->longText('body')->nullable();
    $table->foreignId('subject_id')->nullable()
        ->references('id')->on('subjects')->cascadeOnDelete();
    $table->foreignId('topic_id')->nullable()
        ->references('id')->on('topics')->cascadeOnDelete();
    $table->timestamps();
});
```

### votes table

| Key     | Name               | Data Type       | Description                             | Restrictions                 |
|---------|--------------------|-----------------|-----------------------------------------|------------------------------|
| primary | id                 | Unsigned Bigint | Unique Key                              | Unique                       |
|         | creator_user_id      | Unsigned Bigint | Foreign key to the user who created it  | Required                     |
|         | reciever_user_id   | Unsigned Bigint | Foreign key to the user who received it | Required                     |
|         | votable_id         | Unsigned Bigint | Morphed key to the type of the vote     | Required                     |
|         | votable_type       | String          | Morphed type of the vote                | Required                     |
|         | direction          | Enum            | Direction of the vote, 'up' or 'down'   | Required                     |
|         | created_at         | Timestamp       | Timestamp for creation                  |                              |
|         | updated_at         | Timestamp       | Timestamp for last update               |                              |

migration code:
```php
Schema::create('votes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('creator_user_id')->references('id')->on('users')->cascadeOnDelete();
    $table->foreignId('reciever_user_id')->references('id')->on('users')->cascadeOnDelete();
    $table->morphs('votable');
    $table->enum('direction', ['up', 'down']);
    $table->timestamps();
});
```

### comments table

| Key     | Name                 | Data Type       | Description                                | Restrictions |
|---------|----------------------|-----------------|--------------------------------------------|--------------|
| primary | id                   | Unsigned Bigint | Unique Key                                 | Unique       |
|         | creator_user_id      | Unsigned Bigint | Foreign key of the creator                 |              |
|         | commentable_id       | Unsigned Bigint | Morphed key to the type of the commentable |              |
|         | commentable_type     | String          | Morphed type of the commentable            |              |
|         | message              | Longtext        | The comment message content                |              |
|         | created_at           | Timestamp       | Timestamp for creation                     |              |
|         | updated_at           | Timestamp       | Timestamp for last update                  |              |

migration code:
```php
Schema::create('comments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('creator_user_id')->references('id')->on('users')->cascadeOnDelete();
    $table->morphs('commentable');
    $table->longText('message');
    $table->timestamps();
});
```

### images table

| Key     | Name              | Data Type       | Description                      | Restrictions |
|---------|-------------------|-----------------|----------------------------------|--------------|
| primary | id                | Unsigned Bigint | Unique Key                       | Unique       |
|         | path              | String          | Path of the image                |              |
|         | creator_user_id   | Unsigned Bigint | Foreign key of the creator       |              |
|         | created_at        | Timestamp       | Timestamp for creation creation  |              |
|         | updated_at        | Timestamp       | Timestamp for last update update |              |


```php
Schema::create('images', function (Blueprint $table) {
    $table->id();
    $table->string('path');
    $table->foreignId('creator_user_id')->references('id')->on('users');
    $table->timestamps();
});
```

### tickets table

| Key     | Name              | Data Type       | Description                     | Restrictions |
|---------|-------------------|-----------------|---------------------------------|--------------|
| primary | id                | Unsigned Bigint | Unique Key                      | Unique       |
|         | creator_user_id   | Unsigned Bigint | Foreign key of the creator      |              |
|         | body              | Longtext        | Body of ticket                  |              |
|         | state             | Boolean         | Current state of ticket         |              |
|         | created_at        | Timestamp       | Timestamp for creation time     |              |
|         | updated_at        | Timestamp       | Timestamp for last update time  |              |

```php
Schema::create('tickets', function (Blueprint $table) {
    $table->id();
    $table->foreignId('creator_user_id')->references('id')->on('users')->cascadeOnDelete();
    $table->longText('body');
    $table->boolean('state');
    $table->timestamps();
});
```

### ranks table

| Key     | Name     | Data Type       | Description                                                 | Restrictions |
|---------|----------|-----------------|-------------------------------------------------------------|--------------|
| primary | id       | Unsigned Bigint | Unique Key                                                  | Unique       |
|         | name     | Enum            | Name of the rank                                            |              |
|         |          |                 | Possible values: zöldfülű, okostojás, zseni, lángész, bölcs |              |
|         |          |                 |                                                             |              |

migration code:
```php
Schema::create('ranks', function (Blueprint $table) {
    $table->id();
    $table->enum('name', ['zöldfülű', 'okostojás', 'zseni', 'lángész', 'bölcs']);
    $table->timestamps();
});
```


## Rest API
[Postman collection](/documentation/NebulooAPI.postman_collection.json) is available in json format.


### Base URL: `https://localhost:8881/api/`

### User:
* Model: User
* Controller: AuthController
* Requests: LoginUserRequest, RegisterUserRequest

| Name          | Method  | URL         | Action     | Description          | Minimum role requirement |
|---------------|---------|-------------|------------|----------------------|--------------------------|
| auth.register | POST    | /register   | register   | Registers a new user | Guest                    |
| auth.login    | POST    | /login      | meIndex    | Logs in a user       | Guest                    |
---

* Controller: UserController
* Policy: UserPolicy
* Requests: UpdateUserRequest

| Name              | Method  | URL                 | Action     | Description               | Minimum role requirement |
|-------------------|---------|---------------------|------------|---------------------------|--------------------------|
| users.index       | GET     | /users              | index      | Gets all users            | Guest                    |
| users.show        | GET     | /users/`{id}`       | show       | Gets a user by id         | Guest                    |
| users.showMe      | GET     | /me                 | showMe     | Gets the user themself    | User                     |
| users.update      | PUT     | /users/`{id}`       | update     | Updates a user            | Moderator                |
| users.updateMe    | PUT     | /me                 | updateMe   | Updates the user themself | User                     |
| users.updateRole  | PUT     | /users/`{id}`/role  | updateRole | Updates the user's role   | Admin                    |
| users.destroy     | DELETE  | /users/`{id}`       | destroy    | Deletes a user            | Admin                    |
| users.destroyMe   | DELETE  | /me                 | destroyMe  | Deletes the user themself | User                     |
| users.ban         | PUT     | /users/`{id}`/ban   | ban        | Bans a user               | Moderator                |
| users.unban       | PUT     | /users/`{id}`/unban | unban      | Unbans a user             | Moderator                |
---

### Content:
* Model: Content
* Controller: ContentController
* Policy: ContentPolicy
* Requests: StoreContentRequest, UpdateContentRequest

| Name                 | Method  | URL               | Action     | Description            | Minimum role requirement |
|----------------------|---------|-------------------|------------|------------------------|--------------------------|
| contents.index       | GET     | /contents         | index      | Gets all contents      | Guest                    |
| contents.meIndex     | GET     | /contents/me      | meIndex    | Gets all my contents   | User                     |
| contents.show        | GET     | /contents/`{id}`  | show       | Gets a content by id   | Guest                    |
| contents.store       | CREATE  | /contents         | store      | Creates a content      | User                     |
| contents.update      | PUT     | /contents/`{id}`  | update     | Updates a content      | User                     |
| contents.destroy     | DELETE  | /contents/`{id}`  | destroy    | Deletes a content      | User                     |
---

### Question:
* Model: Question
* Controller: QuestionController
* Policy: QuestionPolicy
* Requests: StoreQuestionRequest, UpdateQuestionRequest

| Name                  | Method  | URL                | Action     | Description            | Minimum role requirement |
|-----------------------|---------|--------------------|------------|------------------------|--------------------------|
| questions.index       | GET     | /questions         | index      | Gets all questions     | Guest                    |
| questions.meIndex     | GET     | /questions/me      | meIndex    | Gets all my questions  | User                     |
| questions.show        | GET     | /questions/`{id}`  | show       | Gets a question by id  | Guest                    |
| questions.store       | CREATE  | /questions         | store      | Creates a question     | User                     |
| questions.update      | PUT     | /questions/`{id}`  | update     | Updates a question     | User                     |
| questions.destroy     | DELETE  | /questions/`{id}`  | destroy    | Deletes a question     | User                     |
---

### Comment:
* Model: Comment
* Controller: CommentController
* Policy: CommentPolicy
* Requests: StoreCommentRequest, UpdateCommentRequest

| Name                 | Method  | URL                              | Action     | Description           | Minimum role requirement |
|----------------------|---------|----------------------------------|------------|-----------------------|--------------------------|
| comments.index       | GET     | /comments                        | index      | Gets all comments     | Guest                    |
| comments.meIndex     | GET     | /comments/me                     | meIndex    | Gets all my comments  | User                     |
| comments.show        | GET     | /comments/`{id}`                 | show       | Gets a comment by id  | Guest                    |
| comments.store       | CREATE  | /`{commentable}`/`{id}`/comments | store      | Creates a comment     | User                     |
| comments.update      | PUT     | /comments/`{id}`                 | update     | Updates a comment     | User                     |
| comments.destroy     | DELETE  | /comments/`{id}`                 | destroy    | Deletes a comment     | User                     |
---

### Vote:
* Model: Vote
* Controller: VoteController
* Policy: CommentPolicy
* Requests: StoreVoteRequest, UpdateVoteRequest

| Name                     | Method  | URL                       | Action             | Description               | Minimum role requirement |
|--------------------------|---------|---------------------------|--------------------|---------------------------|--------------------------|
| votes.meIndex            | GET     | /votes/me                 | meIndex            | Gets all my votes         | User                     |
| votes.store              | CREATE  | /`{votable}`/`{id}`/votes | store              | Creates a vote            | User                     |
| votes.update             | PUT     | /votes/`{id}`             | update             | Updates a vote            | User                     |
| votes.destroy            | DELETE  | /votes/`{id}`             | destroy            | Deletes a vote by id      | User                     |
| votes.destroyByVotableId | DELETE  | /`{votable}`/`{id}`/votes | destroyByVotableId | Deletes a vote votable id | User                     |
---

### Subject:
* Model: Subject
* Controller: SubjectController
* Controller: SubjectController
* Policy: SubjectPolicy
* Requests: StoreSubjectRequest, UpdateSubjectRequest

| Name             | Method  | URL               | Action   | Description           | Minimum role requirement |
|------------------|---------|-------------------|----------|-----------------------|--------------------------|
| subjects.index   | GET     | /subjects         | index    | Gets all subjects     | Guest                    |
| subjects.show    | GET     | /subjects/`{id}`  | show     | Gets a subject by id  | Guest                    |
| subjects.store   | CREATE  | /subjects         | store    | Creates a subject     | User                     |
| subjects.update  | PUT     | /subjects/`{id}`  | update   | Updates a subject     | Moderator                |
| subjects.destroy | DELETE  | /subjects/`{id}`  | destroy  | Deletes a subject     | Moderator                |
---

### Topic:
* Model: Topic
* Controller: TopicController
* Policy: TopicPolicy
* Requests: StoreTopicRequest, UpdateTopicRequest

| Name           | Method  | URL             | Action   | Description         | Minimum role requirement |
|----------------|---------|-----------------|----------|---------------------|--------------------------|
| topics.index   | GET     | /topics         | index    | Gets all topics     | Guest                    |
| topics.show    | GET     | /topics/`{id}`  | show     | Gets a topic by id  | Guest                    |
| topics.store   | CREATE  | /topics         | store    | Creates a topic     | User                     |
| topics.update  | PUT     | /topics/`{id}`  | update   | Updates a topic     | Moderator                |
| topics.destroy | DELETE  | /topics/`{id}`  | destroy  | Deletes a topic     | Moderator                |
---

### Ticket:
* Model: Ticket
* Controller: TicketController
* Policy: TicketPolicy
* Requests: StoreTicketRequest, UpdateTicketRequest

| Name            | Method  | URL              | Action   | Description           | Minimum role requirement |
|-----------------|---------|------------------|----------|-----------------------|--------------------------|
| tickets.index   | GET     | /tickets         | index    | Gets all tickets      | User                     |
| tickets.meIndex | GET     | /tickets/me      | meIndex  | Gets all my tickets   | User                     |
| tickets.show    | GET     | /tickets/`{id}`  | show     | Gets a ticket by id   | User                     |
| tickets.store   | CREATE  | /tickets         | store    | Creates a ticket      | User                     |
| tickets.update  | PUT     | /tickets/`{id}`  | update   | Updates a ticket      | User                     |
| tickets.destroy | DELETE  | /tickets/`{id}`  | destroy  | Deletes a ticket      | User                     |
---

### Rank:
* Model: Rank
* Controller: RankController
* Policy: RankPolicy

| Name            | Method  | URL           | Action  | Description       | Minimum role requirement |
|-----------------|---------|---------------|---------|-------------------|--------------------------|
| ranks.index     | GET     | /ranks        | index   | Gets all ranks    | Guest                    |
| ranks.show      | GET     | /ranks/`{id}` | show    | Gets a rank       | Guest                    |
---

### Image:
* Model: Image
* Controller: ImageController
* Policy: ImagePolicy

| Name             | Method  | URL            | Action     | Description       | Minimum role requirement |
|------------------|---------|----------------|------------|-------------------|--------------------------|
| images.store     | CREATE  | /images        | store      | Uploads an image  | User                     |
| images.show      | PUT     | /images/`{id}` | update     | Gets an image     | User                     |
| images.destroy   | DELETE  | /images/`{id}` | destroy    | Deletes an image  | User                     |
---