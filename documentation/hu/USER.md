# Nebuloo felhasználói dokumentáció

A Nebuloo az egy olyan tananyag megosztó fórum, amely lehetőséget nyújt a tanulni vágyóknak tananyagot keresni, illetve, akikben esetleg valamilyen kérdés merül fel bármely tananyag kapcsán, a Nebuloo lehetőséget nyújt e kérdés feltételéhez.
Ha egy felhasználó úgy érzi, hogy van egy tananyaga, melyet megosztana más felhasználókkal, ezt könnyedén megteheti, illetve ha segíteni szeretne más tanulóknak, kereshet kérdéseket is, melyekre legjobb tudása szerint válaszolhat is..
A létrehozott kérdésekhez, illetve tananyagokhoz más felhasználók hozzá tudnak szólni, illetve tudnak rá szavazni, hogy az adott tartalom hasznos volt-e számukra, vagy nem.
A hozzászólásokra is lehet szavazni, egy felhasználó tartalmaira érkezett szavazatok a felhasználó profilján látszódnak összeadódva, mely alapján kap rangot a felhasználó.
Ha egy felhasználónak bármilyen problémája van az oldallal, vagy az oldalon szereplő bármelyik tartalommal, ezt egy hibajegy segítségével jelentheti az oldal üzelmetetői felé.


## Rendszerkövetelmények

Szükséges alkalmazások, beállítások:
* Docker Desktop, amely letölthető a következő címről: https://docs.docker.com/desktop/ 
* WSL2 használatának engedélyezése
* A számítógép BIOS-ában engedélyezni kell a virtualizációt


Mivel a weboldal dockerizáltan készült, ezért a rendszerkövetelmények megfelelnek a Docker Desktop használatának minimális követelményeinek
* Windows 10 operációs rendszer
* 64 bites processzor
* Legalább 4 GB RAM


## Telepítés:
1. A projekt forráskódját az alábbi parancs terminálban való kiadásával lehet letölteni: git clone https://github.com/FEB-csapat/nebuloo.git 
2. A projekt gyökér könyvtárában start.sh shell script futattása: sh start.sh

Amennyiben a script futtatása sikertelen, a parancsokat manuálisan kell kiadni:
1. Az “.env.example” fájl átnevezése “.env”-re
2. docker compose up
3. A konténerbe való belépéshez az alábbi parancsot adjuk ki: docker compose exec app fish

Az alábbi parancsok a konténeren belül szükséges kiadni:

4. A Laravel-hez kapcsolódó függőségek letöltéséhez a “composer install” parancs kiadása szükséges
5. Az API-hoz szükséges kulcsot a “php artisan key:generate” paranccsal
Az adatbázis migrációk és seederek lefutatásához az alábbi parancsot kell kiadni: “php artisan migrate:fresh --seed”
A Vue-hoz kapcsolódó függőségek letöltéséhez a “npm install” parancs kiadása szükséges
6. A Vite live szerver futtatásához az “npm run dev” parancs kiadása szükséges



## A weboldal működése
Felhasználó számára

### Főoldal
Az oldal főoldalán dönthetjük el, hogyan szeretnénk belépni az oldalra. A belépésre két opciónk van. Beléphetünk fiókkal, vagy vendégként, melyhez nem szükséges felhasználói fiók.

Ha fiókkal szeretnénk belépni, miután rákattintunk a “Fiókkal” feliratú gombra, az oldal átirányít minket a bejelentkező ablakra, ahol beírhatjuk bejelentkezési adatainkat. Miután beírtuk adatainkat, a “Bejelentkezés”   feliratú gombra kattintva, az oldal beléptet minket, majd átirányít a “Tananyagok” oldalra.

Ha nincsen még felhasználói fiókunk, létrehozhatunk egyet a bejelentkezési oldalon a , “Regisztráció” feliratú gombra kattintva, amely átirányít minket a regisztrációs oldalra.

A regisztrációs oldalon egy űrlap vár minket, mely kitöltése után a  “Regisztráció” feliratú gombra kattintva létrehozhatjuk felhasználói fiókunkat. Sikeres regisztráció esetén, az oldal átirányít minket a bejelentkező felületre, ahol a felhasználó bejelentkezhet a frissen létrehozott fiókjával.
