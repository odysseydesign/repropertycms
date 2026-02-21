var $img, canvas, ctx, imgHeight, imgWidth;
var canvasx = canvasy = last_mousex = last_mousey = mousex = mousey = 0;
var mousedown = false;
var borderWidth = 2;
var selected_area_id = 0;
var selected_area_title = "";

var initCanvas = function () {
    imgHeight = $img.height();
    imgWidth = $img.width();
    ctx.canvas.height = imgHeight;
    ctx.canvas.width = imgWidth;
    canvasx = $img.offset().left; //$(canvas).offset().left;
    canvasy = $img.offset().top - $(window).scrollTop(); //$(canvas).offset().top;
    last_mousex = last_mousey = 0;
    mousex = mousey = 0;
    mousedown = false;
}
var togglePhotoMenu = function () {
    $("body").toggleClass("pushy-open-left");
}
var openPhotoMenu = function () {
    if (!$("body").hasClass("pushy-open-left")) {
        $("body").addClass("pushy-open-left");
    }
}
var closePhotoMenu = function () {
    if ($("body").hasClass("pushy-open-left")) {
        $("body").removeClass("pushy-open-left");
    }
}

/*
* Add hotspot to floorplan //migrated.
* */
var addFloorPlanArea = function (position) {
    $.post("/agent/property-floorplan/add-area/" + mediapkid, position, function (res) {
        if (res.ERROR) {
            console.log("Error", res);
        } else {
            var $area = $(".fp-image").find(".photo-box[data-areaid=0]");
            $area.attr("data-areaid", res.AREA.id).data("areaid", res.AREA.id);
        }
    });

}

/*
* remove hotspot //done
* */
var removeFloorPlanArea = function (areaid) {
    $.post("/agent/property-floorplan/remove-area/" + mediapkid, {id: areaid}, function (res) {
        if (res.ERROR) {
            console.log("Error", res);
        } else {
            // console.log("Response", res);
        }
    });
}

var saveAreaName = function (str) {

    var requestObj = {areaid: selected_area_id, title: str};
    var endpoint = "/manage/floor-plans/" + hashkey + "/update-area/" + mediapkid;

    $.post(endpoint, requestObj, function (res) {
        if (res.AREA) {
            var $area = $(".fp-image").find(".photo-box[data-areaid=" + selected_area_id + "]");
            //    console.log($area);
            $area.attr("data-title", res.AREA.title).attr("data-original-title", res.AREA.title).data("title", res.AREA.title);
        } else {
            console.log("Error", res);
        }
    });

}

var updatePhotosInArea = function (assetid, action) {

    var requestObj = {id: selected_area_id, assetid: assetid, action: action};

    // console.log(requestObj);

    var endpoint = "/agent/property-floorplan/update-hotspot-image/" + mediapkid;

    $.post(endpoint, requestObj, function (res) {
        console.log("Update photos:", res);
    });

}

var checkPhotosForArea = function (elem) {

    $(".select-photo").removeClass("photo-selected").find("input[type=checkbox]").prop("checked", false); // uncheck all photos

    var photos_list = elem.data("photo-assets"); // Pre-check all the photos associated with this photo area.
    if (typeof (photos_list) === 'undefined') photos_list = "";
    if (typeof (photos_list) === 'number') photos_list = photos_list.toString();
    if (typeof (photos_list) === 'string') {
        var selected_photos = photos_list.split(",");
        if (selected_photos.length > 0) {
            for (var i = 0; i < selected_photos.length; i++) {
                var assetid = selected_photos[i];
                var $p = $(".select-photo.photo-" + assetid);
                $p.addClass("photo-selected").find("input[type=checkbox]").prop("checked", true);
            }
        }
    }

}

var updateDataPhotoAssets = function (elem, assetid, action) {

    var photos_list = elem.data("photo-assets");
    if (typeof (photos_list) === 'undefined') photos_list = "";
    if (typeof (photos_list) === 'number') photos_list = photos_list.toString();
    if (typeof (photos_list) === 'string') {

        var selected_photos = photos_list.split(",");
        var found = false;

        if (selected_photos.length) {
            for (var i = 0; i < selected_photos.length; i++) {
                var aid = parseInt(selected_photos[i]);
                if (assetid === aid) found = true;
            }
        }

        // console.log(selected_photos, action, found); 

        var new_list = "";
        if (found && action === "remove") {
            new_array = selected_photos.filter(function (e) {
                return parseInt(e) !== assetid
            });
            new_list = new_array.join(",");
        }
        if (!found && action === "add") {
            selected_photos.push(assetid);
            new_list = selected_photos.join(",");
        }

        elem.attr("data-photo-assets", new_list).data("photo-assets", new_list);
    }
}

var updatePopoverThumbs = function (elem) {
    // console.log(elem);
    var photos_list = elem.data("photo-assets");
    if (typeof (photos_list) === 'undefined') photos_list = "";
    if (typeof (photos_list) === 'number') photos_list = photos_list.toString();

    var selected_photos = photos_list.length > 0 ? photos_list.split(",") : [];
    var tcontent = "";

    for (var i = 0; i < selected_photos.length; i++) {
        var aid = selected_photos[i];
        if (aid.toString().length > 0) {
            var imgPath = web_url + "/agent/property-floorplan/property-image/thumb/" + aid;
            tcontent = tcontent + "<div class='d-inline-block m-1'><img src='" + imgPath + "' width='50px' class='img-fluid shadow'></div>";
        }
    }

    if (tcontent.length === 0) {
        tcontent = "No photos assigned to this area. Click to add photos.";
    }

    elem.attr("data-content", tcontent);
}

$(function () {

    canvas = document.getElementById('fp-canvas');
    ctx = canvas.getContext('2d');

    $img = $(".fp-image img.img-web");

    if ($img && $img.length > 0) {
        $img.attr("src", $img.data("src"));
        $img.on("load", function () {
            setTimeout(function () {
                initCanvas();
            }, 1000);
        });
    }

    $(canvas).on('mousemove', function (e) {
        mousex = parseInt(e.clientX - canvasx);
        mousey = parseInt(e.clientY - canvasy);
        if (mousedown) {
            ctx.clearRect(0, 0, canvas.width, canvas.height); //clear canvas
            ctx.beginPath();
            var width = mousex - last_mousex;
            var height = mousey - last_mousey;
            ctx.rect(last_mousex, last_mousey, width, height);
            ctx.setLineDash([5, 5]);
            ctx.strokeStyle = '#269afa';
            ctx.lineWidth = borderWidth;
            ctx.stroke();
        }
    });

    $(canvas).on('mousedown', function (e) {
        last_mousex = parseInt(e.clientX - canvasx);
        last_mousey = parseInt(e.clientY - canvasy);
        mousedown = true;
    });

    $(canvas).on('mouseup', function (e) {

        mousedown = false;
        boxWidth = Math.abs(mousex - last_mousex) + borderWidth;
        boxHeight = Math.abs(mousey - last_mousey) + borderWidth;

        if (mousey > last_mousey) {
            topPct = (last_mousey / imgHeight * 100).toFixed(3);
        } else {
            topPct = (mousey / imgHeight * 100).toFixed(3);
        }

        if (mousex > last_mousex) {
            leftPct = (last_mousex / imgWidth * 100).toFixed(3);
        } else {
            leftPct = (mousex / imgWidth * 100).toFixed(3);
        }
        heightPct = (boxHeight / imgHeight * 100).toFixed(3);
        widthPct = (boxWidth / imgWidth * 100).toFixed(3);

        if (heightPct > 2.0 && widthPct > 2.0 && topPct > 0.0 & leftPct > 0.0) {
            $("<div class='photo-box' data-areaid='0' data-title='' data-photo-assets='' data-toggle='popover' data-content='' data-html='true' data-placement='top'><div class='remove-box' data-toggle='popover' data-content='Remove photo area' data-placement='top'>x</div><div class='ml-auto num-photos'>0</div></div>").appendTo(".fp-image").css({
                "top": topPct + "%",
                "left": leftPct + "%",
                "height": heightPct + "%",
                "width": widthPct + "%"
            });
            addFloorPlanArea({
                top: topPct,
                left: leftPct,
                height: heightPct,
                width: widthPct
            });
        }

        ctx.clearRect(0, 0, canvas.width, canvas.height);

    });

    $(".fp-container").on("click", ".photo-box", function (e) {
        selected_area_id = $(this).data("areaid");
        selected_area_title = $(this).data("title");
        $(".fp-area-name").val(selected_area_title);
        checkPhotosForArea($(this));
        togglePhotoMenu();
    });

    $(".fp-container").on("mouseenter", ".photo-box", function (e) {
        $(this).find(".remove-box").show();
        updatePopoverThumbs($(this));
        $(this).popover("show");
    });

    $(".fp-container").on("mouseleave", ".photo-box", function (e) {
        $(this).find(".remove-box").hide();
        $(this).popover("hide");
    });

    $(".fp-container").on("click", ".remove-box", function (e) {
        e.stopPropagation();
        $(".fp-container .photo-box").popover("hide");
        $(this).popover("hide");
        $(this).closest(".photo-box").remove();

        var areaid = $(this).closest(".photo-box").data("areaid");
        removeFloorPlanArea(areaid);

    });

    $(".fp-container").on("mouseenter", ".remove-box", function (e) {
        $(".fp-container .photo-box").popover("hide");
        $(this).popover("show");
    });

    $(".fp-container").on("mouseleave", ".remove-box", function (e) {
        $(this).popover("hide");
    });

    $(window).on("resize scroll", function () {
        initCanvas();
    });

    $(".rename-fp").on("click", function () {
        $(".modal-rename-floor-plans").modal("show");
    });

    $(".modal-rename-floor-plans").on("shown.bs.modal", function (e) {
        $(".floor-plan-title").focus().select();
    });

    $(".modal-rename-floor-plans").on("shown.bs.modal", function (e) {
        $(".btn-rename-plans").prop("disabled", false).html("Save Changes");
    });

    $("#frm-rename-plans").on("submit", function () {
        $(".btn-rename-plans").prop("disabled", true).html("<i class='fa fa-circle-notch fa-spin mr-2'></i> Saving...");
    });

    $(".close-photo-menu").on("click", function (e) {
        closePhotoMenu();
        $(".fp-container .photo-box").popover("hide");
    });

    $(".select-photo").on("click", function (e) {

        e.stopPropagation();

        var assetid = $(this).data("assetid");
        var action;

        if ($(this).hasClass("photo-selected")) {
            $(this).removeClass("photo-selected");
            $(this).find("input[type=checkbox]").prop("checked", false);
            action = "remove";
        } else {
            $(this).addClass("photo-selected");
            $(this).find("input[type=checkbox]").prop("checked", true);
            action = "add";
        }
        var num_selected = $(".photo-scroller input[type=checkbox]:checked").length;
        var $area = $(".fp-image").find(".photo-box[data-areaid=" + selected_area_id + "]");
        $area.find(".num-photos").text(num_selected);

        updatePhotosInArea(assetid, action);
        updateDataPhotoAssets($area, assetid, action);
        updatePopoverThumbs($area);
        $area.popover("show");

    });

    $(".fp-area-name").on("blur", function () {
        var area_name = $(this).val();
        if (area_name.length >= 3) saveAreaName(area_name);
    });
    $(".fp-editor").on("click", function () {
        if (!$("body").hasClass("pushy-open-left")) {
            $(".fp-container .photo-box").popover("hide");
        }
    });

});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});