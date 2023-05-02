# Nebuloo felhasználói dokumentáció

A Nebuloo egy olyan tananyag megosztó fórum, amely lehetőséget nyújt a tanulni vágyóknak tananyagot keresni, illetve, akikben esetleg valamilyen kérdés merül fel bármely tananyag kapcsán, a Nebuloo lehetőséget nyújt e kérdés feltételéhez.
Ha egy felhasználó úgy érzi, hogy van egy tananyaga, melyet megosztana más felhasználókkal, ezt könnyedén megteheti, illetve ha segíteni szeretne más tanulóknak, kereshet kérdéseket is, melyekre legjobb tudása szerint válaszolhat is.
A létrehozott kérdésekhez, illetve tananyagokhoz más felhasználók hozzá tudnak szólni, illetve tudnak rá szavazni, hogy az adott tartalom hasznos volt-e számukra, vagy nem.
A hozzászólásokra is lehet szavazni, egy felhasználó tartalmaira érkezett szavazatok a felhasználó profilján látszódnak összeadódva, mely alapján kap egy besorolást a felhasználó.
Ha egy felhasználónak bármilyen problémája van az oldallal, vagy az oldalon szereplő bármelyik tartalommal, ezt egy hibajegy formájában továbbíthatja az oldal üzelmetetői felé.


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



# A weboldal működése
## **Felhasználó számára**

### **Főoldal**
Az oldal főoldalán dönthetjük el, hogyan szeretnénk belépni az oldalra. A belépésre két opciónk van. Beléphetünk fiókkal, vagy vendégként, melyhez nem szükséges felhasználói fiók.

Ha fiókkal szeretnénk belépni, miután rákattintunk a “Fiókkal” feliratú gombra, az oldal átirányít minket a bejelentkező ablakra, ahol beírhatjuk bejelentkezési adatainkat. Miután beírtuk adatainkat, a “Bejelentkezés”   feliratú gombra kattintva, az oldal beléptet minket, majd átirányít a “Tananyagok” oldalra.

Ha nincsen még felhasználói fiókunk, létrehozhatunk egyet a bejelentkezési oldalon a , “Regisztráció” feliratú gombra kattintva, amely átirányít minket a regisztrációs oldalra.

A regisztrációs oldalon egy űrlap vár minket, mely kitöltése után a  “Regisztráció” feliratú gombra kattintva létrehozhatjuk felhasználói fiókunkat. Sikeres regisztráció esetén, az oldal átirányít minket a bejelentkező felületre, ahol a felhasználó bejelentkezhet a frissen létrehozott fiókjával.

### **Tananyag oldal**
Ezen az oldalon megtekinthetjük általunk, illetve a többi felhasználó által feltöltött különböző tananyagokat. Alapvetően a legfrissebb dokumentumokat látjuk legelöl, de ezen a 'rendezés' lenyíló listára kattintva változtathatunk és másféle rendezési szempontot válaszhatunk ki.
Ezen felül a megjelenített tananyagokat le is válogathatjuk az általunk preferált tantárgyak, azon belül pedig témakörök kiválasztásával, a bal oldalon található zöld 'tantárgy' lenyíló listára kattinva, illetve miután kiválasztottuk a nekünk megfelelő tantárgyat, a felugró listában a témakört. Amennyiben szeretnék törölni az alkalmazott szűrőket, kattintsunk a 'Szűrők törlése' szövegre.

Minden jegyzet előképe tartalmazza annak tantárgyát és témáját, a feltöltés dátumát, a feltöltő nevét, a sor illetve szó számát a jegyzetnek, a kommentek- és szavazatok számát. Itt lehetőségünk nyílik nekünk is szavazni a lecke hasznosságára, a felfelé nyílra kattinva +1, míg a lefelé nyílra -1 értékelést tudunk adni a jegyzetre. A felhasználó képére kattintva pedig megtudjuk nézni a profilját. 

Egy dokumentumot részletesebben is megtudunk vizsgálni, ehhez kattinsuk rá annak szövegére és az oldal átirányít minket a részletes oldalára. Itt lehetőségünk van hozzászólást is írni az adott jegyzetre.

Az oldal jobb alsó sarkában található lebegő "Új tananyag létrehozása +" gombra kattinva lehetőségünk nyílik nekünk is tartalmat feltölteni az oldalra. 

### **Új tananyag létrehozása**
Ezen az oldalon egy beépített szövegformázó segítségével tudunk tartalmat felvinni. A szövegdoboz felett, megkell adjuk a tantárgyat és azon belül a témakört. Ezután felvihetjük a szöveget és azt tetszésünk szerint megformázhatjuk, illetve képeket is beszúrhatunk. Majd a 'Létrehozás' gombra kattintva felküldhetjük az elkészített jegyzetünket. 

Saját jegyzeteinket továbbá módunkban áll bármikor szerkeszteni a későbbiekben, a 'Szerkesztés' gombra kattinva, illetve törölni a 'Törlés' gombra kattinva. 

### **Kérdések oldal**
Ezen az oldalon megtekinthetjük általunk, illetve a többi felhasználó által feltöltött különböző kérdéseket. Alapvetően a legfrissebb kérdéseket látjuk legelöl, de ezen a 'rendezés' lenyíló listára kattintva változtathatunk és másféle rendezési szempontot válaszhatunk ki.
Ezen felül a megjelenített kérdéseket le is válogathatjuk az általunk preferált tantárgyak, azon belül pedig témakörök kiválasztásával, a bal oldalon található zöld 'tantárgy' lenyíló listára kattinva, illetve miután kiválasztottuk a nekünk megfelelő tantárgyat, a felugró listában a témakört. Amennyiben szeretnék törölni az alkalmazott szűrőket, kattintsunk a 'Szűrők törlése' szövegre.

Minden kérdés előképe tartalmazza annak tantárgyát és témáját, a feltöltés dátumát, a feltöltő nevét, a kommentek- és szavazatok számát. Itt lehetőségünk nyílik nekünk is szavazni a kérdés hasznosságára, a felfelé nyílra kattinva +1, míg a lefelé nyílra -1 értékelést tudunk adni a kérdésre. A felhasználó képére kattintva pedig megtudjuk nézni a profilját. 

Egy kérdést részletesebben is megtudunk vizsgálni, ehhez kattinsuk rá annak szövegére és az oldal átirányít minket a részletes oldalára. Itt lehetőségünk van választ is írni az adott kérdésre.

Az oldal jobb alsó sarkában található lebegő "Új kérdés létrehozása +" gombra kattinva lehetőségünk nyílik nekünk is kérdést feltenni a többi felhasználó számára.

### **Új kérdés létrehozása**
Ezen az oldalon feltehetjük kérdésünket. Elsőként megadjuk a tantárgyat, majd a témakört és ezután a kérdésünk címét. A 'Leírás' részbe, pedig kifejthetjük kérdésünket, hogy a felhasználók könnyedén segíteni tudjanak. Majd a 'Létrehozás' gombra kattintva felküldhetjük az elkészített kérdésünket. 

Saját jegyzeteinket továbbá módunkban áll bármikor szerkeszteni a későbbiekben, a 'Kérdés szerkesztés' gombra kattinva, illetve törölni a 'Kérdés törlése' gombra kattinva. 

### **Profil oldal**
A profil oldalon láthatjuk az vizsgált felhasználó információit, mint például a nevét, rangját, bio-ját és a statisztikáit. Lentebb görgetve látjuk a felhasználó által feltett kérdéseket, feltöltött tananyagokat, megírt kommenteket és válaszokat, illetve benyújtott hibajegyeket. Bármelyiket megnézhetjük részletesen, amennyiben ezeknek a szövegére kattintunk.

Amennyiben a saját profilunkat nézzük, lehetőségünk nyílik ezen felül egyéb opciókra. 
* A 'Profilom szerkesztése' gombra kattintva, átkerülünk egy oldalra, ahol megváltoztathatjuk a megjelenítési nevünket, illetve a bionkat. Ezután kattintsunk az 'Elmentés' gombra, hogy változtatásainkat véglegesítsük. Eztuán visszakerülünk a profilunkra.
* A 'Fiókom törlése' gombra kattinva lehetőségünk van törölni fiókunkat, megnyomása után egy ellenőrző ablak ugrik fel, melyen az 'OK' gombra kattintva véglegesíthetjük a törlést.
* A 'Kijelentkezés' gombra kattintva pedig kijelentkezhetünk a fiókunkból.

Továbbá lehetőségünk van kommentjeink szerkesztésére is, ehhez görgessünk le a "Kommentjeim" szekcióhoz és a változtatni kívánt komment jobb oldalán kattintsunk a 'Szerkesztés' gombra, majd a változtatásaink után a 'Mentés' gombra. Amennyiben kommentünket elszeretnék távolítani, kattintsunk a 'Törlés' gombra.

## **Admin számára**

Az oldal alapkezelése teljesen megegyező számára, mint egy átlag felhasználónak, viszont több funkcióval rendelkezik.

### **Tananyagok és kérdések**
Az admin felhasználónak lehetősége nyílik nem csak saját, de az összes kérdés, tananyag, komment és hibajegy szerkesztésére és törlésére. Ennek folyamata azonos, mint a felhasználónak a saját anyagával való műveleteivel.

### **Felhasználók kezelése**
Amennyiben megnézzük egy felhasználó profilját, megjelenik előttünk az 'Admin panel' (saját profilunkon ezt nem látjuk). Itt az alábbi funkciókat érhetjük el:
* Jogosultság adása a felhasználónak: Egy lenyíló listából kiválaszhatjuk, hogy milyen engedélykört adjunk a felhasználónak. Itt 'moderátor' és 'user' közül válaszhatunk. Majd ezután a 'Mentés' gombra kattintva véglegesíthetjük az engedély adást.
* Profil szerkesztése: Itt akárcsak a saját információnkat, lehetőségünk van az felhasználó megjelenítési nevét és bió-ját megváltoztatni.
* Felhasználó bannolása: A 'Felhasználó bannolása' gombra kattintva felugrik egy ellenőrző ablak, hogy biztos véghez szeretnénk-e vinni a folyamatot, itt az 'OK' gombra kattintva véglegesíthetjük. Ekkor a felhasználó fiókja inaktív állapotba kerül, a felhasználó **nem** fog tudni belépni, de feltöltött tartalmai továbbra is megtekinthetőek, viszont profilján fel lesz tüntetve az érvényben lévő tiltása. A tiltás bármikor feloldható.
* Felhasználó törlése: A 'Felhasználó törlése' gombra kattinva szintén felugrik egy ellenőrző ablak, itt is az 'OK' gombra kattinva véglegesíthetjük. Ebben az esetben a felhasználó fiókja teljesen mértékben törlésre kerül, ezzel együtt az összes általa feltöltött tananyag, kérdés, komment és hibajegy is.

## **Moderátor számára**

Az oldal kezelése teljesen megegyező számára, mint egy átlag felhasználóé, viszont nincs annyi jogosúltsága mint egy adminnak. Amíg egy admin (admin társain kívül) bárkit (köztük moderátorokat is) kitilthat és törölhet, addig egy moderátor csak a felhasználókat kezelheti, moderátor társait nem. Továbbá jogosultságokat sem tud adni felhasználóknak.