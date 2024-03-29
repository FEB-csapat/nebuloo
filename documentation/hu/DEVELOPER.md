# Nebuloo fejlesztői dokumentáció

## Telepítés:
1. A projekt forráskódját az alábbi parancs terminálban való kiadásával lehet letölteni: `git clone https://github.com/FEB-csapat/nebuloo.git` 
2. A projekt gyökér könyvtárában start.sh shell script futattása: `sh start.sh`

Amennyiben a script futtatása sikertelen, a parancsokat manuálisan kell kiadni:
1. `copy .env.example .env` az “.env.example” fájl átnevezése “.env”-re
2. `docker compose up` parancs kiadása konténerek indításához
3. `docker compose exec app fish` parancs kiadás a konténerbe való belépéshez

A konténeren belül:

4. `composer install` parancs kiadása a Laravel-hez kapcsolódó függőségek letöltéséhez
5. `php artisan key:generate` parancs kiadása az API-hoz szükséges kulcs generálásához
6. `php artisan migrate:fresh --seed` parancs kiadása az adatbázis migrációk és seederek lefutatásához
7. `npm install` parancs kiadása Vue-hoz kapcsolódó függőségek letöltéséhez

Végül a Vite élő szerver futtatásához az `npm run dev` parancs kiadása szükséges, mely után a weboldal a https://localhost:8881 címen érhető el.


### Backend Laravelben lett megírva

* API kontrollerek (app/Http/Controllers könyvtár): Meghatározzák, hogyan kell kezelni az egyes API kéréseket, válaszolnak az API kérésekre, végzik az adatfeldolgozást és adatmanipulációt, majd a választ visszaküldik a kliensnek.
* API Requestek (app/Http/Requests könyvtár): Tartalmazza az összes HTTP kérések validálására szolgáló osztályokat.
* API resource-k (app/Http/Resources könyvtár): Ez a könyvtár az adatok API-k számára történő előkészítésére szolgál.
* Policy-k (app/Policies könyvtár): Az hitelesítés szolgáltatás részeként engedélyezik vagy letiltják a felhasználói interakciókat az alkalmazásban.
* Modellek (app/Models könyvtár): Az adatbázis tábláknak megfelelő osztályok. A modellek lehetővé teszik az adatok kezelését, például az adatok lekérdezését, módosítását vagy törlését az adatbázisból.
* Migrációk (database/migrations könyvtár): Lehetővé teszik az adatbázis változásainak és frissítéseinek kezelését.
* Seederek (database/seeders könyvtár): Adatokat adnak hozzá az adatbázis táblákhoz, amelyek tesztelésre vagy más célokra használhatók.
* Factory-k (database/factories könyvtár): Automatikusan hoznak létre tesztadatokat az adatbázis táblákhoz, és lehetővé teszik az adatbázisban található nagy mennyiségű adat gyors és hatékony generálását.
* Lokalizáció (lang könyvtár): Lehetővé teszi, hogy az alkalmazás szövegét más nyelvekre fordítsuk.
* API routing (routes/api.php fájl): Meghatározza az összes API útvonalat, amelyekre az alkalmazás válaszolni tud és az azokhoz kapcsolódó vezérlő osztályokat.
* E-mail értesítések (app/Mail könyvtár): Lehetővé teszik az e-mailek előállítását és formázását, valamint a felhasználókhoz történő küldését.
* API tesztek (tests könyvtár): Az API tesztek lehetővé teszik az alkalmazás API-jának automatikus tesztelését, hogy megbizonyosodjunk arról, hogy a kérések és válaszok megfelelnek-e az elvártaknak.


### Frontend Vue.js-ben let megírva

A frontend által használt fájlok a `resources` könyvtárban találhatóak.

* Képek és stílus (resources/assets): Tartalmazza a web kliens által használt képeket és stílust.
* Vue komponensek (resources/components)
* Vue oldalak (resources/views)
* Javascript (resources/js)
* Web routing(resources/router/index.js): Tartalmazza a web kliens által használt útvonalakhoz tartozó view-kat
* Segéd osztályok (resources/utils)
* Web tesztek (NebulooWebTest könyvtár): Selenium framework segítségével megírt automatizált web teszteket tartalmaz.

## Adatbázis

![Database model](/documentation/demo_database_model.png)

### users tábla

| Kulcs      | Név              | Adattípus        | Leírás                                      | Megkötések    |
|------------|------------------|------------------|---------------------------------------------|---------------|
| elsődleges | id               | Unsigned Bigint  | Egyedi Kulcs                                | Egyedi        |
|            | username             | Szöveg           | Felhasználónév                              | Egyedi        |
|            | display_name     | Szöveg           | Felhasználó megjelentített neve             |               |
|            | email            | Szöveg           | Felhasználó email címe                      | Egyedi        |
|            | password         | Szöveg           | Felhasználó jelszava                        | Nullable      |
|            | remember_token   | Szöveg           | Token az "emlékezz rám" funkcióhoz          |               |
|            | bio              | Szöveg           | Felhasználó rövid leírása                   | Nullable      |
|            | notify_by_email  | Logikai          | Akar-e a felhasználó email értesítést kapni | Alapértelmezett Igaz  |
|            | role             | Enum             | Felhasználó jogosultsága                    | Alapértelmezett 'user'|
|            | banned           | Logikai          | Felhasználó ki van-e tiltva                 | Alapértelmezett Hamis |
|            | created_at       | Időbélyeg        | Létrehozás időbélyege                       |               |
|            | updated_at       | Időbélyeg        | Módosítás időbélyege                        |               |

migráció kód:
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

### subjects tábla

| Kulcs      | Név               | Adattípus       | Leírás                     | Megkötések |
|------------|-------------------|-----------------|----------------------------|------------|
| elsődleges | id                | Unsigned Bigint | Egyedi Kulcs               | Egyedi     |
|            | creator_user_id   | Unsigned Bigint | Létrehozó idegen kulcsa    | Nullable   |
|            | name              | Szöveg          | Tantárgy neve              |            |
|            | created_at        | Időbélyeg       | Létrehozás időbélyege      |            |
|            | updated_at        | Időbélyeg       | Módosítás időbélyege       |            |

migráció kód:
```php
Schema::create('subjects', function (Blueprint $table) {
    $table->id();
    $table->foreignId('creator_user_id')->nullable()
        ->references('id')->on('users')->cascadeOnDelete();
    $table->string('name');
    $table->timestamps();
});
```

### topics tábla

| Kulcs      | Név               | Adattípus       | Leírás                     | Megkötések   |
|------------|-------------------|-----------------|----------------------------|--------------|
| elsődleges | id                | Unsigned Bigint | Egyedi Kulcs               | Egyedi       |
|            | subject_id        | Unsigned Bigint | Tantárgy idegen kulcsa     | Nullable     |
|            | creator_user_id   | Unsigned Bigint | Létrehozó idegen kulcsa    | Nullable     |
|            | name              | Szöveg          | Téma neve                  |              |
|            | created_at        | Időbélyeg       | Létrehozás időbélyege      |              |
|            | updated_at        | Időbélyeg       | Módosítás időbélyege       |              |

migráció kód:
```phpMegkötések
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

### contents tábla

| Kulcs      | Név               | Adattípus       | Leírás                    | Megkötések   |
|------------|-------------------|-----------------|---------------------------|--------------|
| elsődleges | id                | Unsigned Bigint | Egyedi Kulcs              | Egyedi       |
|            | creator_user_id   | Unsigned Bigint | Létrehozó idegen kulcsa   |              |
|            | body              | Hosszú szöveg   | Tananyag tartalma         |              |
|            | subject_id        | Unsigned Bigint | Tantárgy idegen kulcsa    | Nullable     |
|            | topic_id          | Unsigned Bigint | Téma idegen kulcsa        | Nullable     |
|            | created_at        | Időbélyeg       | Létrehozás időbélyege     |              |
|            | updated_at        | Időbélyeg       | Módosítás időbélyege      |              |

migráció kód:
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

### questions tábla

| Kulcs      | Név               | Adattípus       | Leírás                     | Megkötések   |
|------------|-------------------|-----------------|----------------------------|--------------|
| elsődleges | id                | Unsigned Bigint | Egyedi Kulcs               | Egyedi       |
|            | creator_user_id   | Unsigned Bigint | Létrehozó idegen kulcsa    |              |
|            | title             | Szöveg          | Kérdés címe                |              |
|            | body              | Hosszú szöveg   | Kérdés tartalma            | Nullable     |
|            | subject_id        | Unsigned Bigint | Idegen key of the subject  | Nullable     |
|            | topic_id          | Unsigned Bigint | Idegen key of the topic    | Nullable     |

migráció kód:
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

### votes tábla

| Kulcs       | Név               | Adattípus       | Leírás                                 | Megkötések |
|------------|--------------------|-----------------|----------------------------------------|------------|
| elsődleges | id                 | Unsigned Bigint | Egyedi Kulcs                           | Egyedi     |
|            | creator_user_id      | Unsigned Bigint | Létrehozó idegen kulcsa                |            |
|            | reciever_user_id   | Unsigned Bigint | Címhzett idegen kulcsa                 |            |
|            | votable_id         | Unsigned Bigint | Szavazható idegen kulcsa               |            |
|            | votable_type       | Szöveg          | Szavazható típusa                      |            |
|            | direction          | Enum            | Szavazás státusza 'up' vagy 'down'     |            |
|            | created_at         | Időbélyeg       | Létrehozás időbélyege                  |            |
|            | updated_at         | Időbélyeg       | Módosítás időbélyege                   |            |

migráció kód:
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

### comments tábla

| Kulcs      | Név                  | Adattípus       | Leírás                      | Megkötések |
|------------|----------------------|-----------------|-----------------------------|------------|
| elsődleges | id                   | Unsigned Bigint | Egyedi Kulcs                | Egyedi     |
|            | creator_user_id      | Unsigned Bigint | Létrehozó idegen kulcsa     |            |
|            | commentable_id       | Unsigned Bigint | Kommentelhető idegen kulcsa |            |
|            | commentable_type     | Szöveg          | Kommentelhető típusa        |            |
|            | message              | Hosszú szöveg   | Komment tartalma            |            |
|            | created_at           | Időbélyeg       | Létrehozás időbélyege       |            |
|            | updated_at           | Időbélyeg       | Módosítás időbélyege        |            |

migráció kód:
```php
Schema::create('comments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('creator_user_id')->references('id')->on('users')->cascadeOnDelete();
    $table->morphs('commentable');
    $table->longText('message');
    $table->timestamps();
});
```

### images tábla

| Kulcs      | Név               | Adattípus       | Leírás                      | Megkötések |
|------------|-------------------|-----------------|-----------------------------|------------|
| elsődleges | id                | Unsigned Bigint | Egyedi Kulcs                | Egyedi     |
|            | path              | Szöveg          | Kép elérési útvonala        |            |
|            | creator_user_id   | Unsigned Bigint | Létrehozó idegen kulcsa     |            |
|            | created_at        | Időbélyeg       | Létrehozás időbélyege       |            |
|            | updated_at        | Időbélyeg       | Módosítás időbélyege        |            |


```php
Schema::create('images', function (Blueprint $table) {
    $table->id();
    $table->string('path');
    $table->foreignId('creator_user_id')->references('id')->on('users');
    $table->timestamps();
});
```

### tickets tábla

| Kulcs      | Név              | Adattípus       | Leírás                    | Megkötések |
|------------|------------------|-----------------|---------------------------|------------|
| elsődleges | id               | Unsigned Bigint | Egyedi Kulcs              | Egyedi     |
|            | creator_user_id  | Unsigned Bigint | Létrehozó idegen kulcsa   |            |
|            | body             | Hosszú szöveg   | Hibajegy tartalma         |            |
|            | state            | Logikai         | Hibajegy státusza         |            |
|            | created_at       | Időbélyeg       | Létrehozás időbélyege     |            |
|            | updated_at       | Időbélyeg       | Módosítás időbélyege      |            |

```php
Schema::create('tickets', function (Blueprint $table) {
    $table->id();
    $table->foreignId('creator_user_id')->references('id')->on('users')->cascadeOnDelete();
    $table->longText('body');
    $table->boolean('state');
    $table->timestamps();
});
```

### ranks tábla

| Kulcs      | Név      | Adattípus       | Leírás                                                         | Megkötések |
|------------|----------|-----------------|----------------------------------------------------------------|------------|
| elsődleges | id       | Unsigned Bigint | Egyedi Kulcs                                                   | Egyedi     |
|            | name     | Enum            | Rang neve                                                      |            |
|            |          |                 | Lehetséges értékek: zöldfülű, okostojás, zseni, lángész, bölcs |   |

migráció kód:
```php
Schema::create('ranks', function (Blueprint $table) {
    $table->id();
    $table->enum('name', ['zöldfülű', 'okostojás', 'zseni', 'lángész', 'bölcs']);
    $table->timestamps();
});
```


## Rest API
[Postman collection](/documentation/NebulooAPI.postman_collection.json) elérhető json formátumban.

### Alap URL: `https://localhost:8881/api/`


### Felhasználó:
* Modell: User
* Kontroller: AuthController
* Requestek: LoginUserRequest, RegisterUserRequest

| Név          | Metódus  | URL         | Akció      | Leírás                        | Minimum jogosultság      |
|---------------|---------|-------------|------------|-------------------------------|--------------------------|
| auth.register | POST    | /register   | register   | Új felhasználó regisztrációja | Vendég                   |
| auth.login    | POST    | /login      | meIndex    | Beléptet egy felhasználót     | Vendég                   |
---

* Kontroller: UserController
* Policy: UserPolicy
* Requestek: UpdateUserRequest

| Név               | Metódus | URL                 | Akció      | Leírás                            | Minimum jogosultság |
|-------------------|---------|---------------------|------------|-----------------------------------|---------------------|
| users.index       | GET     | /users              | index      | Össze felhasználó                 | Vendég              |
| users.show        | GET     | /users/`{id}`       | show       | Flehasználó id szerint            | Vendég              |
| users.showMe      | GET     | /me                 | showMe     | Én adataim                        | Felhasználó         |
| users.update      | PUT     | /users/`{id}`       | update     | Felhasználó módosítás             | Moderátor           |
| users.updateMe    | PUT     | /me                 | updateMe   | Én adataim módosítás              | Felhasználó         |
| users.updateRole  | PUT     | /users/`{id}`/role  | updateRole | Felhasználó jogosultság módosítás | Admin               |
| users.destroy     | DELETE  | /users/`{id}`       | destroy    | Felhasználó törlése               | Admin               |
| users.destroyMe   | DELETE  | /me                 | destroyMe  | Én fiókom törlése                 | Felhasználó         |
| users.ban         | PUT     | /users/`{id}`/ban   | ban        | Felhasználó tiltása               | Moderátor           |
| users.unban       | PUT     | /users/`{id}`/unban | unban      | Felhasználó tiltás feloldása      | Moderátor           |
---

### Tananyag:
* Modell: Content
* Kontroller: ContentController
* Policy: ContentPolicy
* Requestek: StoreContentRequest, UpdateContentRequest

| Név                  | Metódus | URL               | Akció      | Leírás              | Minimum jogosultság |
|----------------------|---------|-------------------|------------|---------------------|---------------------|
| contents.index       | GET     | /contents         | index      | Összes tananyag     | Vendég              |
| contents.meIndex     | GET     | /contents/me      | meIndex    | Összes tananyagom   | Felhasználó         |
| contents.show        | GET     | /contents/`{id}`  | show       | Tananyag id szerint | Vendég              |
| contents.store       | CREATE  | /contents         | store      | Tananyag létrehozás | Felhasználó         |
| contents.update      | PUT     | /contents/`{id}`  | update     | Tananyag módosítás  | Felhasználó         |
| contents.destroy     | DELETE  | /contents/`{id}`  | destroy    | Tananyag törlése    | Felhasználó         |
---

### Kérdés:
* Modell: Question
* Kontroller: QuestionController
* Policy: QuestionPolicy
* Requestek: StoreQuestionRequest, UpdateQuestionRequest

| Név                   | Metódus | URL                | Akció      | Leírás             | Minimum jogosultság |
|-----------------------|---------|--------------------|------------|--------------------|---------------------|
| questions.index       | GET     | /questions         | index      | Összes kérdés      | Vendég              |
| questions.meIndex     | GET     | /questions/me      | meIndex    | Összes kérdésem    | Felhasználó         |
| questions.show        | GET     | /questions/`{id}`  | show       | Kérdés id szerint  | Vendég              |
| questions.store       | CREATE  | /questions         | store      | Kérdés létrehozás  | Felhasználó         |
| questions.update      | PUT     | /questions/`{id}`  | update     | Updates a question | Felhasználó         |
| questions.destroy     | DELETE  | /questions/`{id}`  | destroy    | Deletes a question | Felhasználó         |
---

### Hozzászólás:
* Modell: Comment
* Kontroller: CommentController
* Policy: CommentPolicy
* Requestek: StoreCommentRequest, UpdateCommentRequest

| Név                  | Metódus | URL                              | Akció      | Leírás             | Minimum jogosultság |
|----------------------|---------|----------------------------------|------------|------------------- |---------------------|
| comments.index       | GET     | /comments                        | index      | Összes komment     | Vendég              |
| comments.meIndex     | GET     | /comments/me                     | meIndex    | Összes kommentem   | Felhasználó         |
| comments.show        | GET     | /comments/`{id}`                 | show       | Komment id szerint | Vendég              |
| comments.store       | CREATE  | /`{commentable}`/`{id}`/comments | store      | Komment létrehozás | Felhasználó         |
| comments.update      | PUT     | /comments/`{id}`                 | update     | Updates a comment  | Felhasználó         |
| comments.destroy     | DELETE  | /comments/`{id}`                 | destroy    | Deletes a comment  | Felhasználó         |
---

### Szavazás:
* Modell: Vote
* Kontroller: VoteController
* Policy: CommentPolicy
* Requestek: StoreVoteRequest, UpdateVoteRequest

| Név                      | Metódus | URL                       | Akció              | Leírás                              | Minimum jogosultság |
|--------------------------|---------|---------------------------|--------------------|-------------------------------------|---------------------|
| votes.meIndex            | GET     | /votes/me                 | meIndex            | Összes szavazásom                   | Felhasználó         |
| votes.store              | CREATE  | /`{votable}`/`{id}`/votes | store              | Szavazás létrehozás                 | Felhasználó         |
| votes.update             | PUT     | /votes/`{id}`             | update             | Szavazás módosítás                  | Felhasználó         |
| votes.destroy            | DELETE  | /votes/`{id}`             | destroy            | Szavazás törlése id szerint         | Felhasználó         |
| votes.destroyByVotableId | DELETE  | /`{votable}`/`{id}`/votes | destroyByVotableId | Szavazás törlése votable id szerint | Felhasználó         |
---

### Tantárgy:
* Modell: Subject
* Kontroller: SubjectController
* Kontroller: SubjectController
* Policy: SubjectPolicy
* Requestek: StoreSubjectRequest, UpdateSubjectRequest

| Név              | Metódus | URL               | Akció    | Leírás                | Minimum jogosultság |
|------------------|---------|-------------------|----------|-----------------------|---------------------|
| subjects.index   | GET     | /subjects         | index    | Összes tantárgy       | Vendég              |
| subjects.show    | GET     | /subjects/`{id}`  | show     | Tantárgy id szerint   | Vendég              |
| subjects.store   | CREATE  | /subjects         | store    | Tantárgy létrehozás   | Felhasználó         |
| subjects.update  | PUT     | /subjects/`{id}`  | update   | Tantárgy módosítás    | Moderátor           |
| subjects.destroy | DELETE  | /subjects/`{id}`  | destroy  | Tantárgy törlése      | Moderátor           |
---

### Téma:
* Modell: Topic
* Kontroller: TopicController
* Policy: TopicPolicy
* Requestek: StoreTopicRequest, UpdateTopicRequest

| Név            | Metódus | URL             | Akció    | Leírás              | Minimum jogosultság |
|----------------|---------|-----------------|----------|---------------------|---------------------|
| topics.index   | GET     | /topics         | index    | Összes téma         | Vendég              |
| topics.show    | GET     | /topics/`{id}`  | show     | Téma id szerint     | Vendég              |
| topics.store   | CREATE  | /topics         | store    | Téma létrehozás     | Felhasználó         |
| topics.update  | PUT     | /topics/`{id}`  | update   | Téma módosítás      | Moderátor           |
| topics.destroy | DELETE  | /topics/`{id}`  | destroy  | Téma törlése        | Moderátor           |
---

### Hibajegy:
* Modell: Ticket
* Kontroller: TicketController
* Policy: TicketPolicy
* Requestek: StoreTicketRequest, UpdateTicketRequest

| Név             | Metódus | URL              | Akció    | Leírás                | Minimum jogosultság |
|-----------------|---------|------------------|----------|-----------------------|---------------------|
| tickets.index   | GET     | /tickets         | index    | Összes hibajegy       | Felhasználó         |
| tickets.meIndex | GET     | /tickets/me      | meIndex  | Összes hibajegyeim    | Felhasználó         |
| tickets.show    | GET     | /tickets/`{id}`  | show     | Hibajegy id szerint   | Felhasználó         |
| tickets.store   | CREATE  | /tickets         | store    | Hibajegy létrehozása  | Felhasználó         |
| tickets.update  | PUT     | /tickets/`{id}`  | update   | Hibajegy módosítás    | Felhasználó         |
| tickets.destroy | DELETE  | /tickets/`{id}`  | destroy  | Hibajegy törlése      | Felhasználó         |
---

### Rang:
* Modell: Rank
* Kontroller: RankController
* Policy: RankPolicy

| Név             | Metódus | URL           | Akció   | Leírás          | Minimum jogosultság |
|-----------------|---------|---------------|---------|-----------------|---------------------|
| ranks.index     | GET     | /ranks        | index   | Összes rang     | Vendég              |
| ranks.show      | GET     | /ranks/`{id}` | show    | Rang id szerint | Vendég              |
---

### Kép:
* Modell: Image
* Kontroller: ImageController
* Policy: ImagePolicy

| Név              | Metódus | URL            | Akció      | Leírás            | Minimum jogosultság |
|------------------|---------|----------------|------------|-------------------|---------------------|
| images.store     | CREATE  | /images        | store      | Kép feltöltés     | Felhasználó         |
| images.show      | PUT     | /images/`{id}` | update     | Kép rang szerint  | Felhasználó         |
| images.destroy   | DELETE  | /images/`{id}` | destroy    | Kép törlése       | Felhasználó         |
---