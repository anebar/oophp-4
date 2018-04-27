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

Här är redovisningstexten



<span id="03"></span>Kmom03
-------------------------

Här är redovisningstexten



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
