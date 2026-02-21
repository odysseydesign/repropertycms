var getUrlParam = function(p) {
    var url = new URL(window.location.href);
    return url.searchParams.get(p);
}
var bsBreakpoint = function () {
    var bp = "xs";
    if (window.matchMedia("(min-width: 576px)").matches) bp = "sm";
    if (window.matchMedia("(min-width: 768px)").matches) bp = "md";
    if (window.matchMedia("(min-width: 992px)").matches) bp = "lg";
    if (window.matchMedia("(min-width: 1200px)").matches) bp = "xl";
    if (window.matchMedia("(min-width: 1400px)").matches) bp = "xxl";
    if (window.matchMedia("(min-width: 1600px)").matches) bp = "xxxl";
    return bp;
}

var bs_breakpoint = bsBreakpoint();

var sanitizerOptions = {
    allowedTags: [ 'p', 'b', 'div', 'em', 'strong', 'code', 'a', 'i', 'ul', 'li', 'ol', 'table', 'tbody', 'thead', 'tfoot', 'tr', 'td', 'th', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'pre' ],
    allowedAttributes: {
        'a': [ 'href' ], 'td': [ 'colspan', 'rowspan' ]
    }
}

window.addEventListener("resize", function () {
    bs_breakpoint = bsBreakpoint();
    toggleNavBreakpoint();
});

function toggleNavBreakpoint() {

    var $rightNavColumn = $(".right-nav");
    var $leftContent = $(".left-content");
    var $nav = $("#admin-nav");

    if (bs_breakpoint === "xs" || bs_breakpoint === "sm" || sidenavCondensed) {
        if (!$nav.hasClass("condensed")) {
            $nav.addClass("condensed");
        }
        $nav.find(".nav-b").hide();
        if (!$rightNavColumn.hasClass("mobile")) {
            $rightNavColumn.addClass("mobile");
        }
        if (!$leftContent.hasClass("mobile")) {
            $leftContent.addClass("mobile");
        }
        var wrapperHeight = $(".content-wrapper").innerHeight();
        $nav.height(wrapperHeight);
    } else {
        if ($nav.hasClass("condensed")) {
            $nav.removeClass("condensed");
        }
        $nav.find(".nav-b").show();
        $rightNavColumn.removeClass("mobile");
        $leftContent.removeClass("mobile");
    }

}
function toggleNav() {
    var $nav = $("#admin-nav");
    if ($nav.hasClass("condensed")) {
        $nav.removeClass("condensed");
        $nav.find(".nav-b").show();
    } else {
        $nav.addClass("condensed");
        $nav.find(".nav-b").hide();
    }
}

function b64EncodeUnicode(str) {
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
        function toSolidBytes(match, p1) {
            return String.fromCharCode('0x' + p1);
    }));
}
var btnSpin = function ($btn, action, pos, delay) {

    pos = (typeof pos !== 'undefined') ? pos : "left";
    delay = (typeof delay !== 'undefined') ? delay : 1500;

    var icon_on_left = "<i class='fad fa-circle-notch fa-spin mr-1'></i> ";
    var icon_on_right = "<i class='fad fa-circle-notch fa-spin ml-1'></i> ";

    var spin = $btn.data("spin") || $btn.html();
    var stop = $btn.data("stop") || $btn.html();
    if ($btn.data("autosave")) {
        spin = $btn.data("autosave");
    }

    if (action === "spin") {
        if (pos === "right") {
            $btn.prop("disabled", true).html(spin + icon_on_right);
        } else {
            $btn.prop("disabled", true).html(icon_on_left + spin);
        }
        $btn.data("stop", stop);
    } else if (action === "success") {
        var txt = $btn.data("success") || "Saved";
        if (pos === "right") {
            $btn.html(txt + " <i class='fas fa-check ml-1'></i>");
        } else {
            $btn.html("<i class='fas fa-check mr-1'></i> " + txt);
        }
        setTimeout(function () {
            $btn.prop("disabled", false).html(stop);
        }, delay);
    } else {
        if ($btn.data("done")) {
            if (pos === "right") {
                $btn.html(icon_on_right + $btn.data("done"));
            } else {
                $btn.html(icon_on_left + $btn.data("done"));
            }
            setTimeout(function () {
                $btn.prop("disabled", false).html(stop);
            }, delay);
        } else {
            $btn.prop("disabled", false).html(stop);
        }
    }
}

function parseDates() {
    $("[data-utc-date]").each(function () {
        var utc = $(this).data("utc-date") || $(this).text();
        if (utc) {
            utc = utc.replace("{ts '", "").replace("'}", "").trim();
            var m = moment.utc(utc);
            if (m.isValid()) {
                var format = $(this).data("format") || "MMM D, YYYY @ h:mm:ss A";
                if (format === "short") format = "MMM D, YYYY";
                if (format === "xshort") format = "M/D";
                if (format === "long") format = "MMM D, YYYY @ hh:mm:ss A";
                if (format === "medium") format = "M/D/YY\xa0\xa0h:mm A";
                if (format === "medium-alt") format = "h:mm A \x6f\x6e M/D/YYYY";
                if (format === "medium-noyear") format = "M/D \xa0\xa0 h:mm A";
                if (format === "mmmd") format = "MMM D";
                if (format === "mdyyyy") format = "M/D/YYYY";
                if (format === "xshort") format = "M/D";
                if (format === "from-now") {
                    var local = m.local().fromNow();
                } else {
                    var local = m.local().format(format);
                }
                $(this).text(local);
                if ($(this).data("toggle") === "popover-hover" && !$(this).data("content")) {
                    let long = m.local().format("MMM D, YYYY @ hh:mm:ss A");
                    $(this).attr("data-content", long).data("content", long);
                }
            }
        }
    });
}

$(function() {

    toggleNavBreakpoint();

    $("#admin-nav .nav-a li.active a.toggle-condensed").on("click", function(e) {
        if ($("#admin-nav").hasClass("condensed")) {
            e.preventDefault();
            toggleNav();
        }
    });

    $(".left-content").on("click", function() {
        if ($(this).hasClass("mobile") && !$("#admin-nav").hasClass("condensed")) { 
            toggleNav();
        }
    });

    var emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,6}$/i;

    if(window.location.hash) {
        var hash = window.location.hash.slice(1);
        var target = "#prop-" + hash;
        if (hash !== 'prop-info' && !hash.includes("&")) {
            $("#prop-info").hide();
            $(target).show();
        }
    }

    $(".nav-items").on("click",function() {

        var tab = $(this).data("target");
        var target = "#" + tab;
        $(".prop-views:visible").fadeOut(150,function() {
            $(target).fadeIn(150,function(){
                if (tab !== 'prop-info') {
                    window.location.hash = target.replace('prop-','');
                }
                if (tab === 'prop-contact') {
                    $("#name").focus();
                }
            });
        });

    });

    $(".nav-site-toggle").on("click",function() {
        $(this).parent().next().slideToggle();
    });

    function trimstring(str) {
        str = str.replace(/^\s+/, '');
        for (var i = str.length - 1; i >= 0; i--) {
            if (/\S/.test(str.charAt(i))) {
                str = str.substring(0, i + 1);
                break;
            }
        }
        return str;
    }

    $(".form-control").on("input",function() {
        // $("button[type='submit']").removeClass("btn-secondary").removeClass("btn-light").addClass("btn-primary");
        $(".fade-icon").show();
    });

    var $teamModal = $(".new-team-modal");

    if ($teamModal && $teamModal.length > 0) {
        
        var team_validator = $(".new-team-form").validate({
            debug: false,
            onkeyup: false,
            rules: {
                teamname: { required: true }
            },
            showErrors: function(errorMap, errorList) {
        
                if (team_validator.numberOfInvalids() > 0){
                    $(".btn-add-team").addClass("btn-disabled");
                    $(".new-team-error").text('Name required').show();
                } else {
                    $(".btn-add-team").removeClass("btn-disabled");
                    $(".new-team-error").text('').hide();
                }

                this.defaultShowErrors();
                $("em.error").hide();
        
            },
            errorElement: "em",
            submitHandler: function(form) {
                return true;
            }
        });

        $teamModal.on('show.bs.modal', function (e) {
            $(".new-team-error").hide();
            team_validator.resetForm();
            $(".new-team-modal .form-control").removeClass("error");
            $("#teamname").val("");

            if (bs_breakpoint !== "xs") {
                $teamModal.find(".modal-dialog").css("width", "500px");
            }

        });

        $teamModal.on('shown.bs.modal', function (e) {
            $("#teamname").focus();
        });

    }

    $('[data-toggle="popover"]').popover({
        trigger: "hover",
        sanitize: false,
        html: true
    });

    var prop_validator = $("#add-property-form").validate({
        debug: false,
        onkeyup: false,
        rules: {
            address: {
                required: true
            },
            city: {
                required: true
            },
            state: {
                required: true
            },
            state_alt: {
                required: {
                    depends: function (element) {
                        return $('#state').val() === 'other';
                    }
                }
            }
        },
        showErrors: function (errorMap, errorList) {

            if (prop_validator.numberOfInvalids() > 0) {
                $("#go_new_property").addClass("btn-disabled");
                $("#errormsg_prop").text('Missing required fields.').show();
            } else {
                $("#go_new_property").removeClass("btn-disabled");
                $("#errormsg_prop").text('').fadeOut();
            }

            this.defaultShowErrors();

        },
        errorElement: "em",
        submitHandler: function(form) {

            $("#errormsg_prop").text('').hide();
            $("#go_new_property").addClass("btn-disabled").html("Adding &nbsp; <i class='fa fa-circle-notch fa-spin'></i>");

            let requestObj = $("#add-property-form").serializeJSON();
            console.log(requestObj);

            $.post(`/manage/properties/add`, requestObj, function (response) { 
                if (response.GOTO) {
                    console.log(response);
                    window.location.href = response.GOTO;
                } else {
                    if (response.ERROR) {
                        $("#errormsg_prop").html(response.MESSAGE).show();
                    }
                    console.log(response);
                    $("#go_new_property").removeClass("btn-disabled").text("Add Property");
                }
            });

            return false;
        }
    });

    $('#add-property-modal').on('show.bs.modal', function (e) {
        $("#errormsg_prop").hide();
        prop_validator.resetForm();
        $(".form-control").removeClass("error");
        $("#go_new_property").prop("disabled", false).html("Add Property");
    });

    $('#add-property-modal').on('shown.bs.modal', function (e) {
        $("#add-property-form .new-prop-address").focus();
    });

    $("#state").on("change", function () {

        var state_province = $(this).val();

        if (state_province === "other") {
            $("#state_alt").show().focus();
        } else {
            $("#state_alt").val('').hide();
        }

    });

    $('[data-click="showLoadingModal"]').on("click", function() {
        $("#loading-modal").modal("show");
    });


});
