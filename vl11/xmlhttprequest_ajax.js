let request = new XMLHttpRequest();

function sendAJAXRequest(event) {
    if (request.readyState === XMLHttpRequest.UNSENT || request.readyState === XMLHttpRequest.DONE) {
        request.open("GET", "laender.php?index=" + event.target.selectedIndex, true);
        request.addEventListener("readystatechange", handleResponse);
        request.send(null);
    }
}

function handleResponse() {
    if (request.readyState === XMLHttpRequest.DONE) {
        document.getElementById("stadt").textContent = request.responseText;
    }
}

window.addEventListener("load", function () {
    let select = document.getElementById("bundesland");
    select.addEventListener("change", sendAJAXRequest);
});
