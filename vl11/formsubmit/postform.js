"use strict";

let request = new XMLHttpRequest();
let form;

function sendAJAXRequest(event) {
    let formData = new FormData(form);

    request.open("POST", "details.php", true);
    request.addEventListener("load", handleResponse);
    request.send(formData);
    event.preventDefault();
}

function handleResponse() {
    let ul = document.getElementById("logindetails");
    if (request.status === 200) {
        let data = request.responseText.split("\n");
        for (let i = 0; i < data.length; i++) {
            let entry = document.createElement("li");
            entry.textContent = data[i];
            ul.appendChild(entry);
        }
    }
    else {
        let error = document.createElement("li");
        error.textContent = "Ein Fehler ist aufgetreten!";
        ul.appendChild(error);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    form = document.getElementById("registerform");
    form.addEventListener("submit", sendAJAXRequest);
});
