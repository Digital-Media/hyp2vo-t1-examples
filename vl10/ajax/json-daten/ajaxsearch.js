"use strict";

const xhr = new XMLHttpRequest();

/**
 * Send a new asynchronous request to the specified resource.
 */
function sendAJAXRequest() {
    const str = encodeURIComponent(search.value);
    xhr.open("GET", "search.php?search=" + str, true);
    xhr.responseType = "json";
    xhr.setRequestHeader("Accept", "application/json");
    xhr.addEventListener("load", handleResponse);
    xhr.send();
}

function handleResponse() {
    if (xhr.status === 200) {
        const suggestDiv = document.getElementById("suggestions");
        suggestDiv.innerHTML = "";
        const data = xhr.response;

        // Only do something, if data sets actually came back
        if (data.count > 0) {
            for (let i = 0; i < data.count; i++) {
                // Generate the element-DIVs.
                const entry = document.createElement("div");
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

// Set the AJAX function as callback in the keyup-handler
const search = document.getElementById("search");
search.addEventListener("keyup", sendAJAXRequest);
