$.fn.select2.defaults.set(

    "theme", "bootstrap"

);

$(document).ready(function(e) {

    $("#examiner").select2({

        placeholder: "--- PRÜFER AUSSUCHEN ---",

        allowClear: true,

    });

});

$(document).ready(function(e) {

    $("#fach").select2({

        placeholder: "--- FACH AUSSUCHEN (optional) ---",

        allowClear: false,

    });

});