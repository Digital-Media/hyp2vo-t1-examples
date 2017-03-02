// Workaround für IE 5, 5.5 and 6. Ist XMLHttpRequest nicht vorhanden, wird versucht, die beste ActiveXObject-Variante zu verwenden
if (typeof XMLHttpRequest === "undefined") {
    XMLHttpRequest = function () {
        try {
            return new ActiveXObject("Msxml2.XMLHTTP.6.0");
        }
        catch (e) {
        }
        try {
            return new ActiveXObject("Msxml2.XMLHTTP.3.0");
        }
        catch (e) {
        }
        try {
            return new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (e) {
        }
        throw new Error("Entschuldige, Dein Browser ist nicht kompatibel.");
    };
}

var request = new XMLHttpRequest();

function sendAJAXRequest(event) {
    if (request.readyState === 0 || request.readyState === 4) {
        request.open("GET", "laender.php?index=" + event.target.selectedIndex, true);
        request.onreadystatechange = handleResponse;
        request.send(null);
    }
}

function handleResponse() {
    if (request.readyState === 4) {
        document.getElementById("stadt").textContent = request.responseText;
    }
}

window.onload = function () {
    var select = document.getElementById("bundesland");
    select.onchange = sendAJAXRequest;
};