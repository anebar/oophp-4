---
...
Redovisning
=========================

<a href="#01">kmom01</a>&nbsp;&nbsp;
<a href="#02">kmom02</a>&nbsp;&nbsp;
<a href="#03">kmom03</a>&nbsp;&nbsp;
<a href="#04">kmom04</a>&nbsp;&nbsp;
<a href="#05">kmom05</a>&nbsp;&nbsp;
<a href="#06">kmom06</a>&nbsp;&nbsp;
<a href="#07-10">kmom07-10</a>&nbsp;&nbsp;

<span id="01"></span>Kmom01
-------------------------

**Hur känns det att hoppa rakt in i objekt och klasser med PHP, gick det bra och kan du relatera till andra objektorienterade språk?**  
Jag kom i kontakt med objektorienterat språk för många år sedan, men har inte direkt arbetat med det. Jag blev bekant med sättet, dvs objekt, metoder mm. Det är super att jag nu kan lära mig mer om det.

**Berätta hur det gick det att utföra uppgiften “Gissa numret” med GET, POST och SESSION?**  
Jag gjorde först den med GET. Det gick lite knackligt att få till det som jag önskade, att visa informationstexter vid rätt tillfällen om antal gissningar kvar och när inga gissningar är kvar samt att disabla inputfältet för gissningar när inga gissningar är kvar. Speciellt den sista, dvs när inga gissningar är kvar. Vid reset av spelet sätts både ett nytt tal att gissa på samt antal gissnngar kvar. (I video-filmen om uppgiften samt i mallen för klassen Guess ser det ut som att endast ett nytt tal ska slumpas fram). Sista momentet var att jag delade på filen så det blev en del med PHP-koden och en del med HTML-koden, den sista i en fil under mappen view. Jag valde dock att även ha kvar filerna med all kod i samma fil för att valideringen skulle fungera (jag hade nog kunnat namngett mina filer på annat sätt så att valideringen hade fungerat ändå).

POST gick på en handvändning, bara att byta GET till POST.

För att använda SESSION behövde jag tänka om lite. Jag ändrade inte klassen. I filen i view-mappen (game-session.php) tog jag bort fälten som hade attributet hidden. I filen index-session-with-view.php (php-delen av index_session.php) tilldelade jag hela game-objektet i sessionen. Jag hamnade lite fel när jag försökte följa videon för den innehåll en klass Session, men det behövde vi inte i denna uppgift. Jag fick arbeta en del med att dumpa variabler för att se att värdena blev rätt.

Jag stylade inputfält och knappar.

**Har du några inledande reflektioner kring me-sidan och dess struktur?**  
Jag har svårt att inte börja styla så det blev det första. När jag ändrade till font-size 12px för p och la in en hr på sidan index och mer text under den hamnade footer-delen för högt upp och överlappade main-delen. Det gick att fixa med clear för footern. Men om jag tog bort font-sizen så försvann också problemet, alternativt tog bort hr och den extra texten. Jag sökte inte vidare varför font-size för p kunde påverka det så, men lite mysko var det. Jag fixade bara problemet.

Jag tog samma style jag hade i design-kursen för figure och justerade den något. Vi använde ju LESS-kod i den kursen och det saknar jag (hittade inte vad som behövs för att kompilera LESS, hittade sidan https://dbwebb.se/kunskap/bygg-ett-tema-till-anax-flat, men den bygger på något tidigare). Det blev mer komprimerad och tydligare kod. Nu behövde jag skriva om den till vanlig CSS. Jag la in bootstraps stylesheet också, stylade om den en del samt la egen bild och logga.

Jag hade stora problem att få till så push till Git-repot skulle fungera. Efter mycket raderade och omstart av repo och nycklar på både datorn i Github så lyckades jag få till det. Inte heller VIM editorn fungerade som den skulle. Läste om andra på nätet med samma problem och med Windows/Cygwin.

Make check och make test fungerar inte, det var flera olika fel. Jag har skapat en forumtråd om detta [https://dbwebb.se/forum/viewtopic.php?f=37&t=7391](https://dbwebb.se/forum/viewtopic.php?f=37&t=7391) och väntar på hjälp. Försökte även på gitter. En sak berodde på att en fil inte fungerar annat än med Linux så då installerade jag bash, men där fungerade inte composer. Det har blivit många timmar för att försöka ordna detta.

**Vilken är din TIL för detta kmom?**  
*TIL är en akronym för “Today I Learned” vilket leksamt anspelar på att det finns alltid nya saker att lära sig, varje dag. Man brukar lyfta upp saker man lärt sig och där man kanske hajade till lite extra över dess nyttighet eller enkelhet, eller så var det bara en ny lärdom för dagen som man vill notera.*

Det var nytt för mig att använda exceptions. Det var riktigt kul att få en bra känsla för hur det fungerar.

**[Länk till min me-sida](http://www.student.bth.se/~anbp17/dbwebb-kurser/oophp/me/redovisa/htdocs)**


<span id="02"></span>Kmom02
-------------------------

**Hur gick det att överföra spelet “Gissa mitt nummer” in i din me-sida?**  
Det var inga problem att lägga in spelet “Gissa mitt nummer” på min me-sida.

**Berätta om hur du löste uppgiften med Tärningsspelet 100, hur du tänkte, planerade och utförde uppgiften samt hur du organiserade din kod?**  
Jag började att skissa på UML:en. Därefter kopierade jag klasserna om tärningar som jag gjort från guiden “Kom igång med Objektorienterad programmering i PHP” - ["Arv och Komposition"](https://dbwebb.se/guide/kom-igang-med-objektorienterad-programmering-i-php/arv-och-komposition) till ramverket under mappen redovisa. Jag definierade ett par till klasser: Game och Player. Ett spel har flera spelare (i detta fall är två spelare hårdkodat: den som använder spelet och datorn) och spelare har flera spelomgångar. Jag valde att lägga hela spelet i sessionen. Sessionen skapas i htdocs/index.php. För att även det tidigare sessionsspelet "Guess my number" skulle fungera så behövde jag byta namn på sessionsvariabeln som också var "game" (det går inte att definiera flera sessionsvariabler med samma namn).

Jag byggde tyvärr spelet först så att om spelaren fick minst en etta i ett kast så räknades inte det kastet, men poäng från tidigare kast i omgången räknades. Då jag i princip var klar läste jag igenom allt igen för att se att jag täckt alla delar, men tyvärr var jag inte  "hemma". Jag behövde bygga in ett mellanläge, att se till att det inte blir poäng alls för hela omgången om det finns en etta. Så... en hel del refaktorisering, ["refactoring är en variant av att “gör om – gör rätt”](https://dbwebb.se/guide/kom-igang-med-objektorienterad-programmering-i-php/refactoring-av-klasser)", av det slag att jag såg nya krav. Det blev en hel del brydderi, eftersom hela tidigare logiken var klar. Efter mycket testande och en hel del if-satser fungerade det som det skulle, sedan blev det städning av kod. Då fick jag bort mycket genom att exempelvis dra ihop flera villkor samt ta bort metoder och variabler som inte användes. Koden är nu väl strukturerad och fördelad i router, klasser och views samt css:er.

Extrauppgiften "Gör det flexibelt så man kan använda valbart antal tärningar när man spelar spelet" byggde jag in från början.

**Berätta om din syn på modellering likt UML jämfört med verktyg som phpDocumentor. Fördelar, nackdelar, användningsområde? Vad tycker du om konceptet make doc?**  
Svårt att säga eftersom jag får så många fel vid `make doc`, dessa kunde dock ignoreras enligt tråden ["make doc ger massor med felrader"](https://dbwebb.se/forum/viewtopic.php?f=37&t=7424&p=60111#p60111). Blev därför inte så triggad av det. Däremot såg det bra ut i en video för kursen. UML:en ger en bra översikt programmet med dess klasser och relationer och översikter tycker jag är viktiga för att få en god känsla över vad som gälelr som helhet.

**Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och nackdelar med de olika sätten?**  
Det är bra och tydligt att använda routes mm för att fördela koden tydligt efter vad som ska hanteras, det blir dock fler filer att underhålla. Jag föredrar ändå att använda ramverket nu när man använt det en del.

**Vilken är din TIL för detta kmom?**  
Oj! Jag har haft så mycket trubbel med olika saker som inte alls har med kodningen att göra så kodningen blev nästan en bisyssla denna gång, tyvärr. Det blev massor med fel både för `make check`, `make test` och `make doc` samt en mysko dubbel request i FF (finns som dokumenterat fel för FF). Därefter försvann mitt repo för oophp och istället fanns en kopia av kursrepot. `git push` fungerade inte som det skulle, jag behövde ordna nycklar för varje push. Jag tror att jag har lyckats få de flesta fel som kan möjligen uppstå med labbmiljön, trots att den fungerade fint i en tidigare kurs. Stort tack för all hjälp jag har fått för att fixa detta! Så TIL...? Jag har blivit, hoppas jag, lite klokare på Git. Det andra är att jag behöver läsa kraven ännu mer i början, eller scanna av lite mitt i arbetet. Eftersom det är så mycket information scannar jag ofta av texten i början och försöker hitta det viktiga att börja med och sätter sedan igång, taggad att koda.

**[Länk till min me-sida](http://www.student.bth.se/~anbp17/dbwebb-kurser/oophp/me/redovisa/htdocs)**


<span id="03"></span>Kmom03
-------------------------

**Har du tidigare erfarenheter av att skriva kod som testar annan kod?**  
Vi hade en workshop på jobbet för ett par år sedan där vi testade Cucumber.

**Hur ser du på begreppen enhetstestning och att skriva testbar kod?**  
Det är en nödvändighet ur testperspektiv och när man har större system/applikationer. Man kan inte testa ett helt system manuellt varje gång man förändrar eller skapar en ny del.

**Förklara kort begreppen white/grey/black box testing samt positiva och negativa tester, med dina egna ord.**  
Det är white box testing när man har källkoden som man testar och kan se att testfallen exekverar alla delar av koden. Enhetstester är white box testing. Enhetstester innebär att man testar varje  del/enhet/klass för sig själv. För black-box tester har man inte koden. Man testar en systemfunktion och inte hur det kodmässigt är uppbyggd. Funktionstester är black-box tester. Grey box testing testar delvis både kodstruktur och systemfunktion.

Positiva tester undersöker om mjukvaran fungerar som tänkt och utför de funktioner som man förväntar sig. Negativa tester används för att få fram fel med felaktig indata, för att se att koden hantera det på rätt sätt. Det kan vara att kasta ett exception eller att programmet avslutas med en viss felkod.

**Hur gick det att genomföra uppgifterna med enhetstester, använde du egna klasser som bas för din testning?**  
Jag utgick från koden i exempelmappen. Det gick bra att genomföra det mesta. Det var dock inte så enkelt att hitta hur man skulle göra med GuessException. Det skiljde sig i sätt från de övriga testerna och dokumentation gav mig bara en liten ledtråd på väg. Jag hittade annan hjälp på nätet som beskrev det lite bättre tyckte jag.

**Vilken är din TIL för detta kmom?**  
Det var intressant att se och förstå en liten del av vad enhetstestning handlar om. Jag har hört mycket om det, men inte använt det själv.

**[Länk till min me-sida](http://www.student.bth.se/~anbp17/dbwebb-kurser/oophp/me/redovisa/htdocs)**


<span id="04"></span>Kmom04
-------------------------

Här är redovisningstexten



<span id="05"></span>Kmom05
-------------------------

Här är redovisningstexten



<span id="06"></span>Kmom06
-------------------------

Här är redovisningstexten



<span id="07-10"></span>Kmom07-10
-------------------------

Här är redovisningstexten
