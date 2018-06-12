$(document).ready(function () {
    $("#bundesland").change(function (event) {
        $.get("laender1.php", {index: event.target.selectedIndex}, function (data) {
            $("#stadt").text(data);
        }).fail(function () {
            $("#stadt").text("Es gab ein Problem mit der Anfrage der Hauptstadt.");
        });
    });
});
