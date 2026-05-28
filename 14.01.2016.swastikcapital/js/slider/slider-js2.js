 var i = 0;
        $(document).ready(function () {
            $('#slides').slidesjs({
                width: 700,
                height: 304,
                pagination: false,
                effect: {
                    fade: {
                        speed: 1000,
                        crossfade: !0
                    }
                },
                navigation: {
                    active: !0,
                    effect: "fade"
                },
                play: {
                    active: false,
                    auto: true,
                    interval: 7000,
                    swap: true,
                    effect: "fade"
                }
            });


            $("#slides").mouseenter(function () {
                i = 1;
            }).mouseleave(function () {
                i = 0;
            });


        });
        function timeout_trigger() {

            if ($(".slidesjs-play").css("display") == "block") {
                if (i != 0)
                    timeout_init();

                else
                    $(".slidesjs-play").click();
            }
        }

        function timeout_init() {
            setTimeout('timeout_trigger()', 10000);
        }

        function call_dynamic() {
            if ($(".slidesjs-play").css("display") == "block") {
                $(".playchange").html("click here to play");
            }
            else {
                $(".playchange").html("click here to pause");
            }
        }