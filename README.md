# Nebuloo - Tananyag megosztó fórum

![face](/documentation/face.png)
A Nebuloo egy olyan tananyag megosztó fórum, amely lehetőséget nyújt a tanulni vágyóknak tananyagot keresni, megosztani, kérdéseket feltenni és azokara válaszolni.
A létrehozott kérdésekhez, illetve tananyagokhoz más felhasználók hozzá tudnak szólni, illetve tudnak rá szavazni, hogy az adott tartalom hasznos volt-e számukra, vagy sem.
Egy felhasználó tartalmaira érkezett szavazatok a felhasználó profilján látszódnak összeadódva, mely alapján rangot kap, így ösztökélve őt aktivitásra.


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



## Felhasználói dokumentáció
* [English](/documentation/en/USER.md)
* [Magyar](/documentation/hu/USER.md)

## Fejlesztői dokumentáció
* [English](/documentation/en/DEVELOPER.md)
* [Magyar](/documentation/hu/DEVELOPER.md)

## Tesztelési dokumentáció
* [English](/documentation/en/TEST.md)
* [Magyar](/documentation/hu/TEST.md)

## Készítők
- [Ferencneu](https://github.com/Ferencneu)
- [Ruffel1998](https://github.com/Ruffel1998)
- [indeednt](https://github.com/indeednt)

## Licenc
Ez a projekt a MIT Licenc alatt van - részletekért lásd a [LICENSE](LICENSE) fájlt.