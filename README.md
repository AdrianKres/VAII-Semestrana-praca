# ExploreSlovakia

Adrián Kres

5ZYI36

## Stručný opis projektu
Webová aplikácia AlpineTracker slúži ako osobný digitálny denník pre turistov, horolezcov a milovníkov prírody. Umožňuje používateľom systematicky zaznamenávať absolvované alebo plánované túry, nahrávať GPX súbory s trasami, priraďovať fotografie a interaktívne vizualizovať trasy nad 3D modelom terénu. Hlavným účelom je poskytnúť moderný nástroj na archiváciu horských zážitkov, sledovanie štatistík a vizuálnu prehľadnosť absolvovaných výstupov.

## Role v projekte
* **Návštevník:** Neregistrovaný používateľ, ktorý si môže prezerať verejný zoznam túr, prehľad pohorí a ukážkové 3D mapy.
* **Registrovaný používateľ (Turista):** Prihlásený používateľ, ktorý spravuje vlastné záznamy túr, nahráva GPX súbory, pridáva fotky k výstupom a má plnú kontrolu nad svojím profilom a denníkom.
* **Administrátor:** Špeciálna rola zodpovedná za správu informácií o pohoriach, moderovanie obsahu a celkovú správu aplikácie.

## Prípady použitia podľa rolí
* **Návštevník:**
    * Zobraziť verejný zoznam túr a štatistík.
    * Zobraziť detail vybranej túry vrátane 3D mapy terénu.
* **Registrovaný používateľ:**
    * Zaregistrovať sa do systému a prihlásiť sa do osobnej zóny.
    * Vytvoriť nový záznam túry (zadanie názvu, dátumu, dĺžky, prevýšenia, výber pohoria, upload GPX a fotiek).
    * Upraviť alebo vymazať vlastný záznam túry.
    * Filtrovať vlastný zoznam túr podľa pohoria alebo hodnotenia.
* **Administrátor:**
    * Pridať, upraviť alebo vymazať pohorie.
    * Spravovať používateľov a kontrolovať dáta v systéme.

## Plánované entity
* **User (Používateľ):** Reprezentuje používateľa systému. Atribúty: `id`, `username`, `email`, `password_hash`, `role`. Vzťah: 1:N k entite `Hike`.
* **Mountain (Pohorie):** Číselník pohorí, v ktorých sa túry uskutočňujú. Atribúty: `id`, `name`, `description`. Vzťah: 1:N k entite `Hike`.
* **Hike (Túra):** Hlavná entita reprezentujúca záznam o túre. Atribúty: `id`, `title`, `date`, `distance_km`, `elevation_gain_m`, `duration_minutes`, `gpx_filepath`, `user_id`, `mountain_range_id`. Vzťah: N:1 k `User` a `Mountain`, 1:N k `Photo`.
* **Photo (Fotografia):** Fotografie priradené k uskutočnenej túre. Atribúty: `id`, `filepath`, `caption`, `hike_id`. Vzťah: N:1 k entite `Hike`.

## Vzťahy medzi entitami
* **User 1 : N Hike:** Jeden používateľ môže vytvoriť viacero záznamov túr, pričom každá túra patrí práve jednému používateľovi.
* **Mountain 1 : N Hike:** Jedno pohorie zahŕňa viacero rôznych túr.
* **Hike 1 : N Photo:** Jedna túra môže obsahovať viacero nahraných fotografií z výstupu.

## Hlavné stránky aplikácie
1. **Úvodná stránka (Dashboard / Zoznam túr):** Prehľad verejných túr, štatistík a posledných výstupov komunity.
2. **Detail túry:** Stránka obsahujúca podrobné parametre túry, fotogalériu a interaktívnu 3D vizualizáciu trasy v teréne.
3. **Moje túry (Osobný denník):** Tabuľkový prehľad túr prihláseného používateľa s možnostiami filtrovania a správcovskými akciami.
4. **Formulár pre pridanie / úpravu túry:** Vstupné rozhranie na zadanie údajov o túre, nahranie GPX súboru a priloženie fotiek.
5. **Zoznam pohorí / Administrácia:** Prehľad regiónov a spravovanie číselníkov aplikácie.

## Rozdelenie funkcionality
* **Základné funkcie (MVP):**
    * Autentifikácia a autorizácia používateľov (login, registrácia, ochrana routov).
    * Implementácia MVC architektúry prostredníctvom frameworku VAJKO v PHP.
    * Plné CRUD operácie nad entitami `Hike` (túry) a `Mountain` (pohoria).
    * Správa súborov (upload fotografií a GPX súborov na server).
    * Responzívny dizajn a Docker kontajnerizácia s počiatočným importom vzorových dát.
* **Rozširujúce funkcie (Nadštandard):**
    * Interaktívna 3D vizualizácia terénu a GPX trasy pomocou klientskej JS knižnice (napr. MapLibre GL JS).
    * Asynchrónne AJAX volania (in-place filtrovanie záznamov v tabuľke a rýchle akcie bez reloadu).
    * Pokročilá klientska a serverová validácia formulárov.
