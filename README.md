Importium
=========

## Vize

Importium je aplikace pro správu souborů. Umožňuje přihlášenému uživateli přidávat a spravovat soubory. Soubory může pro přehlednost také organizovat do složek. Obyčejný návštěvník může jen prohlížet složky, kde jsou soubory uloženy, a případně soubory stahovat.

* [Živá ukázka aplikace](http://importium.macoszek.cz/)

## Analýza

### Případy užití

![Soubory](https://github.com/peruginni/Importium/raw/master/docs/usecase-files)
![Složky](https://github.com/peruginni/Importium/raw/master/docs/usecase-folders)

## Návrh 

### Arhitektura

Aplikace je rozvrstvená do tří důsledně oddělených vrstev. Vrstvy vzájemně komunikují 
prostřednictvím rozhraní. Instance tříd, které implementují tyto rozhraní se neinstancují 
přímo v každé vrstvě, ale jsou úsporně vkládány pomocí principu dependency injection, 
takže lze kdykoli kteroukoli z těchto tříd implementovat jinak, jednoduše nastavit 
konfiguraci na novou třídu, a okamžitě je tato nová třída vsouvána na všechna místa 
jako její předchůdce. Webový framework Nette používám pro vytvoření prezentační vrstvy 
a pro správu objektů pro dependency injection. Framework Doctrine pro objektově-relační 
mapování mi pomáhá s uchováváním dat. 


### Business vrstva

Řeší hlavní logiku projektu. Většina byznys objektů hojně využívá objektů 
persistenční vrstvy, ale obvykle přidává také další chování nezbytné k úplnosti 
byznys procesu (např. vložení nového souboru neznamená jen uložení informací 
o souboru do databáze, ale i fyzické uložení souboru na filesystém). Často také 
spojuje činnosti více persistenčních objektů dohromady (např. uložení informací 
o souboru, ale také uložení informace o zařazení souboru pod určitou složku). 
V budoucnu také prostor pro ověřování práv 
uživatele k provedení příslušné akce.



### Persistenční vrstva

Má za cíl abstrahovat ostatní vrstvy od rutinních a často dosti specifických 
procesů doprovázející ukládání dat. Hlavním stavebním kamenem je Doctrine, 
které poskytuje podpůrné nástroje pro definování entit a dotazování do databáze. 
Přestože používání Doctrine velmi odlehčí provázání kódu na databázi, pro interní 
účely jsou příkazy Doctrine navíc obaleny DAO objekty. DAO objekty umožňují  
zmírnit provázání byznys vrstvy s Doctrine - výsledkem jsou přehlednější operace 
v byznys vrstvě. Každé DAO má navrženo vlastní rozhraní. 

Všechny DAO objekty vycházejí ze společného obecného DAO předka. Ten obstarává 
přístup k Entity manageru Doctrine, Cache managera, dále rutinní činnosti pro 
ukládání a mazání entit, stejně jako základních způsobů jak entity získávat 
(pomocí id nebo všechny bez užšího výběru). Zajišťuje také metody pro vytváření 
QueryBuilderu a nastavení stránkování.

Musím říct, že jsem hrdý na řešení stránkování. Po dlouhém koumání, kreslení a přepisování tříd, 
jsem našel pěkný způsob jak zprovoznit fungování DAO a byznys objektů, tak aby 
v případě potřeby bylo co nejjednodušší stránkování implementovat. Vše se točí 
kolem rozhrání IPaginator, jejíž implementace je instancovaná a předána např. 
už v Business vrstvě metodě která požaduje určitý výpis položek, tato metoda 
vnitřně volá ještě DAO, které je IPaginator opět předán - uvnitř metody DAO 
objektu se pomocí QueryBuilderu sestaví požadovaný dotaz, a jakmile je hotový 
předá se ještě metodě setupPaginator, kde se ze sestaveného dotazu odvodí tvar 
dotazu pro úsporné dotázání do databáze jen na počet položek á lá "COUNT(e.id)" 
(tj. ne na celé řádky databáze) a podle získaných informací o tom kolik položek 
by mohl dotaz maximálně vrátit se příslušně nastaví objekt IPaginator, který od 
této chvíle přesně ví kolik bude maximálně stránek, zda budou předchozí nebo 
následující stránky, atd. Po skončení metody setupPaginator se dotaz na řádky 
databáze ještě dodatečně omezí tak, aby vrátil počet entit menší nebo roven 
hodnotě pro maximální počet položek na stránku nastavené v IPaginator. Používání 
IPaginator ve výsledku znamená předání pouze jediného argumentu metodě DAO/Business 
objektu pro výpis položek, navíc předání IPaginatoru není povinné, takže pokud není 
předán, pak se vrátí maximální počet entit.

V Nette je pravděpodobně nejčastěji vidět persistenci řešenou pomocí dibi 
(které např. problém stránkování řeší pomocí DibiDataSource). Určitě by nebyl 
problém vyměnit Doctrine za dibi(+ objekty entit). Ovšem vždy se mi velmi líbil způsob, 
jakým v javě funguje JPA, takže když jsem hledal něco podobného v php a narazil 
na Doctrine, neváhal jsem ji vyzkoušet. 

> Aktualizace: S odstupem času dospívám k názoru, že příště by bylo dobré vrstvu DAO 
sloučit přímo s byznys vrstvou, protože jejich oddělení zde nepřináší výrazný užitek. 
Čas věnovaný oddělování by bylo příště lepší využít pro unit testy. Také adresářová 
struktura rozdělující zvlášť dao, business a entity objekty mi příjde zbytečná 
a příště bych soubory nechal ve společné složce.


### Prezentační vrstva

Je tvořena především podpůrnými (případně rozšířenými) třídami webového frameworku Nette. 
Obstarává přijetí a zpracování požadavku od návštěvníka. Na základě požadavků a nastaveného 
routování je spuštěna odpovídající třída a metoda presenteru (objekt pro specifičtější 
rozhodnutí o zpracování požadavku uživatele) a odpovídající šablona (view/pohled pro 
vykreslení odpovědi na požadavek). 

Ohromně nadšený jsem z fungování routování. Umožňuje na jediném místě nakonfigurovat 
obecný formát URL. Později v šablonách se pak zapisují pouze akce (presenter + metoda akce), které se mají spustit 
(případně se doplní o argumenty), a ve finále je vykreslena plná URL přesně podle 
dříve definovaného obecného formátu.

Příjemnou součástí je rozšíření Latte filter, které umožňuje oprostit 
se od překážejících <?php a ?> značek, stejně jako 
od rutinního ošetřování výstupu pomocí htmlspecialchars(). Navíc šetrně zabezpečí 
výstup podle kontextu, do kterého je vypisován - tj. speciální escapování pro javascript a HTML argumenty tagů.

Příjemné jsou také nástroje na formuláře a ajax. Všechno lze výborně přizpůsobit. 



### Dependency Injection

Princip dependency injection tkví v tom, že vyžadovaný objekt je úsporně 
uchováván v nějakém repozitáři (obvykle lze nastavit okruh platnosti, 
request, session, sigleton...) a v případě, že je objekt požadován 
na určitém místě kódu, pak je na toto místo automaticky podsunut, 
takže tento místní kód může počítat s instancí objektu.

V Nette je možné DI vyřešit pomocí služeb. Služby lze nastavit jednoduše 
v konfiguračním souboru (nadefinuje se název služby a třída která se má spustit). 
V projektu Importium jsem to vyřešil tak, že jako název služby jsem zvolil 
interface třídy a jako třídu která se má instancovat jsem vybral třídu 
implementující příslušný interface.




### Zamezení přístupu nepřihlášeným

Je elegantně řešeno díky hierarchii presenterů. Totiž všechny presentery 
administrační části webu jsou potomky AdminPresenter, ve které je zamezen 
přístup nepřihlášeným do všech akcí kromě těch na whitelistu definovaným 
vlastností $publicActions. Tato proměnná je pole a je nastavena jako protected, 
takže kterýkoli potomek třídy AdminPresenter může v případě potřeby do whitelistu 
přidat další veřejné akce.



### Principy fungování Doctrine

Doctrine je objektově-relační mapovací framework, umožňuje vývojáři soustředit 
se na vývoj kódu a oprostit se od přímého nastavování/dotazování databáze. 
Takže například vůbec nemusí ručně vytvářet tabulky pomocí PhpMyAdmin, apod. 

Doctrine očekává nadefinované entity reprezentující strukturu a vztahy 
mezi ukládanými daty. Framework je schopen na základě těchto entit vytvořit 
kompletní schéma databáze. Tyto entity usnadňují uchopení dat v kódu aplikace 
(versus bez použití ORM často odlišný styl zápisu sloupců v databázích a v aplikaci).

Disponuje také nástroji pro dotazování, ukládání a mazání entit. 
Rovněž obsahuje prostředky pro vytvoření libovolného (klidně i hodně divokého) 
databázového dotazu. V případě potřeby používá také cachování.
