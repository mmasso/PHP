window.addEventListener("pageshow", function(event) {
    var historyTraversal = event.persisted ||
        (typeof window.performance != "undefined" &&
            window.performance.navigation.type === 2);
    if (historyTraversal) {
        // Handle page restore.
        window.location.reload();
    }
});

$(document).ready(function() {
    $("#entradaUserNum").hide();
    $('#entradaData').change(function() {
        if ($(this).val() == "arrayManual") {
            $("#entradaUserNum").show();
        } else {
            $("#entradaUserNum").hide();
        }
    });
});

$(document).ready(function() {
    $("#entradaUserNumOrdenacion").hide();
    $('#entradaDataOrdenacion').change(function() {
        if ($(this).val() == "arrayManualOr") {
            $("#entradaUserNumOrdenacion").show();
        } else {
            $("#entradaUserNumOrdenacion").hide();
        }
    });
});

$(document).ready(function() {
    $("#entradaUserRandomArray").hide();
    $('#entradaData').change(function() {
        if ($(this).val() == "arrayRandom") {
            $("#entradaUserRandomArray").show();
        } else {
            $("#entradaUserRandomArray").hide();
        }
    });
});

$(document).ready(function() {
    $("#entradaUserRandomArrayOrdenacion").hide();
    $('#entradaDataOrdenacion').change(function() {
        if ($(this).val() == "arrayRandomOr") {
            $("#entradaUserRandomArrayOrdenacion").show();
        } else {
            $("#entradaUserRandomArrayOrdenacion").hide();
        }
    });
});