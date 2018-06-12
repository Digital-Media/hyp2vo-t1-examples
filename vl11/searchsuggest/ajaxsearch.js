"use strict";

let xhr = new XMLHttpRequest();

function sendAJAXRequest() {
    let str = encodeURIComponent(search.value);
    xhr.open("GET", "search.php?search=" + str, true);
    xhr.responseType = "json";
    xhr.setRequestHeader("Accept", "application/json");
    xhr.addEventListener("load", handleResponse);
    xhr.send(null);
}

function handleResponse() {
    if (xhr.status === 200) {
        let suggestDiv = document.getElementById("suggestions");
        suggestDiv.innerHTML = "";
        let data;
        // If parsing as JSON worked, we can use the response directly
        if (xhr.responseType === "json") {
            data = xhr.response;
        }
        // otherwise we have to parse it ourselves
        else {
            data = JSON.parse(xhr.responseText);
        }
        // Only do something, if data sets actually came back
        if (data.count > 0) {
            for (let i = 0; i < data.count; i++) {
                // Generate the element-DIVs.
                let entry = document.createElement("div");
                // Change class onmouseover
                entry.addEventListener("mouseover", function () {
                    this.classList.add("suggestlinkover");
                });
                // Change back class onmouseout
                entry.addEventListener("mouseout", function () {
                    this.classList.remove("suggestlinkover");
                });
                // Set the search value on click
                entry.addEventListener("click", function () {
                    search.value = this.textContent;
                    suggestDiv.innerHTML = "";
                });
                entry.classList.add("suggestlink");
                entry.textContent = data.words[i];
                suggestDiv.appendChild(entry);
            }
        }
    }
}

// When the DOM content is fully loaded, set the AJAX function as callback in the keyup-handler
document.addEventListener("DOMContentLoaded", function () {
    let search = document.getElementById("search");
    search.addEventListener("keyup", sendAJAXRequest);
});
