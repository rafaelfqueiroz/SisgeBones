    $(window).resize(function() {
        if ($(window).width() < 980) {
            $("aside").hide();
        } else {
            $("aside").show();
        }
    });
