$(document).ready(function() {
    $("#bundesland").change(function(event) {
        $.get("laender.php", {index: event.target.selectedIndex}, function(data) {
            $("#stadt").text(data);
        });
    });
});