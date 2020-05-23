"use strict";

const request = new XMLHttpRequest();
const form = document.getElementById("registerform");
form.addEventListener("submit", sendAJAXRequest);

function sendAJAXRequest(event) {
    const formData = new FormData(form);
    request.open("POST", "details.php", true);
    request.addEventListener("load", handleResponse);
    request.send(formData);
    event.preventDefault();
}

function handleResponse() {
    const ul = document.getElementById("logindetails");
    if (request.status === 200) {
        const data = request.responseText.split("\n");
        for (let i = 0; i < data.length; i++) {
            const entry = document.createElement("li");
            entry.textContent = data[i];
            ul.appendChild(entry);
        }
    } else {
        const error = document.createElement("li");
        error.textContent = "Ein Fehler ist aufgetreten!";
        ul.appendChild(error);
    }
}
