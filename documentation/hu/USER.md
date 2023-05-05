# Nebuloo felhasználói dokumentáció

A Nebuloo egy olyan tananyag megosztó fórum, amely lehetőséget nyújt a tanulni vágyóknak tananyagot keresni, megosztani, kérdéseket feltenni és azokara válaszolni.
A létrehozott kérdésekhez, illetve tananyagokhoz más felhasználók hozzá tudnak szólni, illetve tudnak rá szavazni, hogy az adott tartalom hasznos volt-e számukra, vagy nem.
Egy felhasználó tartalmaira érkezett szavazatok a felhasználó profilján látszódnak összeadódva, mely alapján rangot kap, így ösztökélve őt aktivitásra.
Ha egy felhasználónak bármilyen problémája van az oldallal kapcsolatban, vagy az oldalon szereplő bármelyik tartalommal, ezt hibajegy formájában továbbíthatja az oldal üzelmetetői felé.


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
1. A projekt forráskódját az alábbi parancs terminálban való kiadásával lehet letölteni: `git clone https://github.com/FEB-csapat/nebuloo.git` 
2. A projekt gyökér könyvtárában start.sh shell script futattása: sh start.sh

Amennyiben a script futtatása sikertelen, a parancsokat manuálisan kell kiadni:
1. Az “.env.example” fájl átnevezése “.env”-re
2. `docker compose up` parancs kiadása konténerek indításához
3. `docker compose exec app fish` parancs kiadás a konténerbe való belépéshez

A konténeren belül:

4. `composer install` parancs kiadása a Laravel-hez kapcsolódó függőségek letöltéséhez
5. `php artisan key:generate` parancs kiadása az API-hoz szükséges kulcs generálásához
6. `php artisan migrate:fresh --seed` parancs kiadása az adatbázis migrációk és seederek lefutatásához
7. `npm install` parancs kiadása Vue-hoz kapcsolódó függőségek letöltéséhez

Végül a Vite élő szerver futtatásához az `npm run dev` parancs kiadása szükséges, mely után az alkalmazás használhatóvá válik.

A weboldal a `https://localhost:8881/api/` címen érhető el.


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

### **Hibajegy küldése oldal**
Ha bármi hibát találunk az oldalon, vagy esetleg bármi olyan tartalmat látunk amely kifogásolható számunkra, ezt egy hibajegy küldésével jelenthetjük az oldal üzemeltetői felé. A hibajegy küldése oldalra, a láblécben található "Jelentés küldése" feliratű hivatkozásra kattintva juthatunk el, ahol az űrlap kitöltése után, a "Létrehozás" címkéjű gombra kattintva küldhetjük el hibajegyünket.

Miután elküldtük hibajegyünket, a saját profilunk oldalán nyomon követhetjük az adott hibajegy állapotát.

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

### **Hibajegyek oldal**
Az admin felhasználónak lehetősége van megtekinteni az összes hibajegyet, a hibajegyek oldalon. Egy hibajegyen látható, hogy melyik felhasználó küldte az adott hibajegyet, illetve, hogy mi a hibajegy üzenete. A hibajegyek alapértelmezett állapota "Várakozik", de ha úgy gondolja az adminisztrátor, hogy az adott hiba javítva van, akkor ezt a "Megjelölés mint: "Javítva"" címkéjű gombra kattintva megváltoztathatja "Javítva" állapotra.

Ha valamilyen okból kifolyólag újra kell nyitni egy hibajegyet, ezt a "Hibajegy újranyitása" címkéjű gombra kattintva megteheti az adminisztrátor. Így a hibajegy állapota, visszaváltozik "Várakozik" állapotra.

Továbbá az adminnak lehetősége van törölni egy adott hibajegyet az "Elutasítás" címkéjű gombra kattintva.

## **Moderátor számára**

Az oldal kezelése teljesen megegyező számára, mint egy átlag felhasználóé, viszont nincs annyi jogosúltsága mint egy adminnak. Amíg egy admin (admin társain kívül) bárkit (köztük moderátorokat is) kitilthat és törölhet, addig egy moderátor csak a felhasználókat kezelheti, moderátor társait nem, illetve hibajegyeket kezelni is ugyanannyi jogosultsága van mint az adminisztrátornak.

Továbbá jogosultságokat sem tud adni felhasználóknak.
