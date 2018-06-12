"use strict";

let request = new XMLHttpRequest();

function sendAJAXRequest(event) {
    request.open("GET", "laender.php?index=" + event.target.selectedIndex, true);
    request.addEventListener("load", handleResponse);
    request.send(null);
}

function handleResponse(event) {
    if (request.status === 200) {
        document.getElementById("stadt").textContent = request.responseText;
    }
    else {
        document.getElementById("stadt").textContent = "Es gab ein Problem mit der Anfrage der Hauptstadt.";
    }
}

document.addEventListener("DOMContentLoaded", function () {
    let select = document.getElementById("bundesland");
    select.addEventListener("change", sendAJAXRequest);
});
