/**
 * Die folgenden globalen Variablen werden in mehreren Funktionen benötigt
 */

// Das zu erratende Wort (String)
var word;
// Eine Liste auf bereits ricthig geratenen Buchstaben (String)
var answerLetters;
// Die Anzahl der Fehlversuche (int)
var guesses;
// Das Hangman Bild (jQuery-Objekt)
var image;
// Das <div>-Element mit der Antwort (jQuery-Objekt)
var answer;
// Das <div>-Element mit den Buchstaben (jQuery-Objekt)
var characters;


/**
 * Diese Funktion wird genau 1x beim Laden der Seite aufgerufen und enthält einmalige Initialisierungen
 */
function init() {
    // Neustart Link bekommt einen Event-Handler zugewiesen, bei dem das Spiel zurückgesetzt wird
    // Performance-Tipp: $("#newgame").find("a") ist schneller als $("#newgame a")
    $("#newgame").find("a").click(function(event) {
        resetGame();
        event.preventDefault();
    });
}

/**
 * Diese Funktion beginnt ein neues Spiel. Sie wird von "ready"-Event bzw. beim Klick auf "Neustart" aufgerufen,
 * d.h. sie kann auch ohne Neu-Laden öfters aufgerufen werden
 */
function resetGame() {
    // Einlesen der Wortliste via AJAX-Call
    // Inhalt der Datei wird an die Callback-Funktion setupGame() übergeben
    $.get("words.txt", setupGame, "text");
}

/**
 * Initialisiert den Spielzustand. Nach der Initialisierung wird gewartet, bis der/die UserIn einen Event auslöst.
 * Durch Klick auf einen Buchstaben wird guess() aufgerufen
 * @param wordlist Der Inhalt der Datei words.txt (eingelesen in resetGame())
 */
function setupGame(wordlist) {
    // Noch keine Buchstaben wurden erraten
    answerLetters = "";
    // Die Anzahl der Fehlversuche beträgt zu Beginn 0
    guesses = 0;

    // wordlist ist ein durch \n getrennter String (in jeder Zeile steht ein Wort)
    // Durch split() werden die Zeilen/Wörter in einem Array (words) gespeichert
    // Parameter /\n/: Regular-Expression Literal!
    var words = wordlist.split(/\n/);

    // Math.random() liefert eine Zufallszahl zwischen [0,1) (inkl. 0, exkl. 1)
    // words.length enthält die Anzahl der Elemente im Array words
    // bei 4 Elementen liegt das Ergebnis zwischen [0,4) (inkl. 0, exkl. 4), z.B. 2.1345
    // Math.floor() rundet ab, z.B. 2.1345 -> 2, daher ensteht eine Zufallszahl zwischen 0 und 3,
    // ideal für den Array-Zugriff. word ist daher ein zufällig ausgewähltes Wort aus dem Array
    word = words[Math.floor(Math.random() * words.length)].toUpperCase();

    // Antwortbereich wird initialisiert. Für jeden Buchstaben im Lösungswort wird "_" eingesetzt
    // z.B. "Test" wird zu "____"
    // Parameter /./g: Regular-Expression Literal (Punkt = beliebiges Zeichen, Slash = Begrenzung)
    // g bedeutet alle Vorkommen (globally) von /./ ersetzen
    // Performance-Tipp: Wird ein Element öfter benötigt, dann in einer globalen Variable merken -> spart extra Abfragen
    answer = $("#answer").text(word.replace(/./g, "_"));

    // Die Buchstabenliste wird initialisiert. Zuerst wird der dafür vorgesehene <div>-Container geleert:
    // Performance-Tipp: Wird ein Element öfter benötigt, dann in einer globalen Variable merken -> spart extra Abfragen
    characters = $("#characters").empty();

    // Dann werden die verfügbaren Buchstaben als Array angelegt
    var charList = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "Ä", "Ö", "Ü"];

    // Nun wird über die Buchstaben mit dem jQuery Iterator $.each() iteriert
    // Für jeden Buchstaben wird ein <li>-Element mit enthaltenem Link angelegt
    // Performance-Tipp: <li>-Elemente zunächst in einen einzigen String hängen und dann 1x mit append/appendTo anfügen
    // statt 29x einzeln append/appendTo aufrufen
    // Performance-Tipp: for-Schleife wäre nochmals schneller als $.each (aber nicht so komfortabel).
    var characterListItems = "";
    $.each(charList, function(index, value) {
        characterListItems += '<li id="' + value + '"><a href="' + value + '">' + value + '</a></li>';
    });

    // Eine unsortierte Liste wird erzeugt und der String mit den <li>/<a>-Elementen wird angehängt
    // Die unsortierte Liste wiederum wird ins <div> mit der ID characters gehängt
    // Schließlich bekommt die Liste einen Klick-Handler mit "on". Dieser fängt Klicks auf die <a>-Elemente innerhalb ab
    // Performance-Tipp: 1 Klick-Handler mit "on" auf das übergeordnete Element, der "Event-Bubbling" unterstützt, ist
    // effizienter, als 29 einzelne Klick-Handler auf die jeweiligen <a>-Elemente
    $("<ul></ul>").append(characterListItems).appendTo(characters).on("click", "a", function(event) {
        guess($(this).attr("href"));
        event.preventDefault();
    });

    // Schließlich wird das aktuelle Bild auf 0.png (leeres Startbild) gesetzt und der globalen Variable zugewiesen
    // Performance-Tipp: Wird ein Element öfter benötigt, dann in einer globalen Variable merken -> spart extra Abfragen
    image = $("#image").attr("src", "images/0.png");

    // Die Meldung über Sieg oder Niederlage muss präventiv entfernt werden (siehe später)
    $("#message").remove();
}

/**
 * Wird beim Klicken auf einen Buchstaben vom Event-Handler aufgerufen und stellt einen Ratevorgang dar
 * @param character Der angeklickte/gedrückte Buchstabe
 */
function guess(character) {
    // Falls der Buchstabe im Wort vorkommt...
    if (word.indexOf(character) !== -1) {
        // Buchstabe an die Liste der richtig geratenen anhängen
        answerLetters += character;

        // Antwortbereich updaten (richtige Buchstaben eintragen)
        refreshCharList();
    }
    // Falls Buchstabe nicht im Wort vorkommt...
    else {
        // Anzahl der Fehlversuche erhöhen
        guesses++;

        // Nächstes Hangman-Bild anzeigen
        incrementHangman();
    }
    // Geratenen Buchstaben deaktivieren, d.h. Link entfernen und nur mehr Buchstaben eintragen
    $("#" + character).text(character);

    // Überprüfen auf Spielende (Sieg oder Niederlage)
    checkWinning();
}

/**
 * Updated den Antwortbereich. Angenommen, das gesuchte Wort lautet "TEST", so wird die Anzeige von
 * "____" auf "T__T" aktualisiert
 */
function refreshCharList() {
    // Anzeige zunächst leer initialisieren
    var updatedAnswer = "";
    // Gesuchtes Wort buchstabenweise durchlaufen
    for (var i = 0; i < word.length; i++) {
        // Falls der aktuelle Buchstabe des gesuchten Wortes in der richtig geratenen Wortmenge vorkommt...
        if (answerLetters.indexOf(word.charAt(i)) !== -1) {
            // Füge den Buchstaben dem Antwortbereich hinzu
            updatedAnswer += word.charAt(i);
        }
        // Falls der aktuelle Buchstabe noch nicht erraten wurde...
        else {
            // Füge _ an den Antwortbereich
            updatedAnswer += "_";
        }
    }

    // setze die neu berechnete Antwortanzeige ein
    answer.text(updatedAnswer);
}

/**
 * Zeigt das nächste Bild an. Der aktuelle Bildname entspricht der Anzahl der Fehlversuche (0.png, 1.png, etc.)
 */
function incrementHangman() {
    // Bildquelle austauschen (src Attribut)
    image.attr("src", "images/" + guesses + ".png");
}

/**
 * Deaktiviert alle Buchstaben, sodass nur noch ein Klick auf "Neustart" möglich ist
 */
function deactivateCharacters() {
    // Suche alle Links im <div>-Element mit der ID characters, greife auf deren Inhalt zu (der Text) und entferne
    // dessen Elternelement (<a>-Element)
    characters.find("a").contents().unwrap();
}

/**
 * Überprüfung auf ein mögliches Spielende (Sieg oder Niederlage)
 */
function checkWinning() {
    // Falls kein "_" mehr im Antwortbereich vorhanden ist, wurden alle Buchstaben erraten -> Sieg
    if (answer.text().indexOf("_") === -1) {
        // Gewinn-Bild einblenden
        image.attr("src", "images/victory.png");
        // Meldung über Sieg ausgeben
        showResult("win");
        // Alle Buchstaben deaktivieren
        deactivateCharacters();
    }
    // Falls zu viele Fehlversuche getätigt wurden -> Niederlage
    else if (guesses >= 8) {
        // Niederlage-Bild einblenden
        image.attr("src", "images/defeat.png");
        // Meldung über Niederlage ausgeben
        showResult("lose");

        // Gesuchtes Wort im Antwortbereich einblenden
        answer.text(word);
        // Alle Buchstaben deaktivieren
        deactivateCharacters();
    }
}

/**
 * Gibt eine Meldung aus, dass gewonnen oder verloren wurde
 * @param outcome Ein String, der Sieg oder Niederlage enthalten kann.
 */
function showResult(outcome) {
    $('<div id="message">You ' + outcome + '!</div>').prependTo("#content");
}

/**
 * Document-Ready Handler: Ruft die Initilisierungsmethode auf und startet ein neues Spiel
 */
$(document).ready(function () {
    init();
    resetGame();
});