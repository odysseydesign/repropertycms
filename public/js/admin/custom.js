
// delete backend agent data
function deleteAgent(id)
{
    var Id = id;
    
    $("#dialog").addClass("open");
    $('.dialog-msg').html("Do you really want to delete the agent data?<br>Agent might have certain properties");

     // if user click on dialog's box button NO then remove this dialog box event
     $("#dialog").click(function() {
        $(".dialog-yes-btn").unbind();
    });
    //Attach document delete function to yes button
    $("#dialog .dialog-yes-btn").click(function(){
        $("#dialog").removeClass("open");

        $.ajax({
            type: 'GET',
            url: web_url + "/admin/delete",
            data:{Id:id},
            success: function (data) {
                if(data.success==0){
                    $.notify(data.message,{ position:"top center", className: "error",autoHideDelay: 1500} );
                } else {
                    $('#agent_data'+Id).remove();
                    $.notify( data.message, { position:"top center", className: "success",autoHideDelay: 1500 }); 
                }      
            }
        })

    });

}

// delete backend pages data
function deletePages(id)
{
    var Id = id;
    $("#dialog").addClass("open");
    $('.dialog-msg').html("Do you really want to delete the pages data ?");

     // if user click on dialog's box button NO then remove this dialog box event
     $("#dialog").click(function() {
        $(".dialog-yes-btn").unbind();
    });
    //Attach document delete function to yes button
    $("#dialog .dialog-yes-btn").click(function(){
        $("#dialog").removeClass("open");

        $.ajax({
            type: 'GET',
            url: web_url + "/admin/pages/delete",
            data:{Id:id},
            success: function (data) {
                if(data.success==0){
                    $.notify(data.message,{ position:"top center", className: "error",autoHideDelay: 1500} );
                } else {
                    $('#page'+Id).remove();
                    $.notify( data.message, { position:"top center", className: "success",autoHideDelay: 1500 }); 
                }      
            }
        })

    });

}

// Update here For Property is Published or Not?
$(function () {
    $(".confirm-alert").click(function(){
        msg = $(this).data("msg");
        if(typeof msg == "undefined") {
            msg = "Do you really want to do this?";
        }

        if(confirm(msg) == true) {
            return true;
        } else {
            return false;
        }
    });

    $('.save_publish').on("click", function (event) {
        event.preventDefault();
        $var = $(this);
        var id = event.target.id;

        $("#dialog").addClass("open");
        $('.dialog-msg').html("Do you really want to change the Property Status ?");

         // if user click on dialog's box button NO then remove this dialog box event
        $("#dialog").click(function() {
            $(".dialog-yes-btn").unbind();
        });
    
        //Attach document delete function to yes button
        $("#dialog .dialog-yes-btn").click(function(){
            $("#dialog").removeClass("open");

            $.ajax({
                type: 'GET',
                url: web_url  + "/admin/property-status",
                data:{id:id},
                success: function (data) {
                    var stat_us;
                    if (data['messege'] == "1") {
                        if (data['status'] == 1) {
                            stat_us = 'ENABLE';
                            $.notify('User ENABLE', { className: 'success', autoHideDelay: 1500, globalPosition: "top center" });
                        } else {
                            stat_us = 'DISABLE';
                            $.notify('User DISABLE', { className: 'success', autoHideDelay: 1500, globalPosition: "top center" });
                        }
                    } else {
                        $.notify('Error', { className: 'error', autoHideDelay: 1500, globalPosition: "top center" });
                    }
                    $var.text(stat_us);
                }
            })
        });
    })

    // Here Add Code For Member Ship Status Enable Or Disable
    $('.plan_status').on("click", function (event) {
        event.preventDefault();
        $var = $(this);
        var id = event.target.id;
        var value = event.target.innerText;

        $("#dialog").addClass("open");
        $('.dialog-msg').html("Do you really want to change the plans status ?");

          // if user click on dialog's box button NO then remove this dialog box event
        $("#dialog").click(function() {
            $(".dialog-yes-btn").unbind();
        });
        //Attach document delete function to yes button
        $("#dialog .dialog-yes-btn").click(function(){
            $("#dialog").removeClass("open");

            $.ajax({
                type: 'GET',
                url: web_url + "/admin/plans/status",
                data:{id:id,value:value},

                success: function (data) {
                    var stat_us;
                    if (data['messege'] == "1") {
                        if (data['status'] == 1) {
                            stat_us = 'ENABLE';
                            $.notify('Plan ENABLE', { className: 'success', autoHideDelay: 1500, globalPosition: "top center" });
                        } else {
                            stat_us = 'DISABLE';
                            $.notify('Plan DISABLE', { className: 'success', autoHideDelay: 1500, globalPosition: "top center" });
                        }
                    } else {
                        $.notify('Error', { className: 'error', autoHideDelay: 1500, globalPosition: "top center" });
                    }
                    $var.text(stat_us);
                }
            })
        });
        
    })

    // Here Add Code For deleting Existing Membership Plans
    $('.delete-plan').on("click", function (event) {
        event.preventDefault();
        $var = $(this);
        var id = event.currentTarget.id;

        $("#dialog").addClass("open");
        $('.dialog-msg').html("Do you really want to delete the membership plan ?");

         // if user click on dialog's box button NO then remove this dialog box event
        $("#dialog").click(function() {
            $(".dialog-yes-btn").unbind();
        });
        //Attach document delete function to yes button
        $("#dialog .dialog-yes-btn").click(function(){
            $("#dialog").removeClass("open");

            $.ajax({
                type: 'GET',
                url: web_url + "/admin/plans/delete/"+id,

                success: function (data) {
                    console.log(data)
                    if (data['success'] == "1") {
                        $('#tab_row'+id).remove();
                        $.notify(   data.messege, { className: 'success', autoHideDelay: 1500, globalPosition: "top center" });
                    } else {
                        $.notify(  data.messege, { className: 'error', autoHideDelay: 1500, globalPosition: "top center" });
                    }
                }
            })
        });
    });

    // Here Admin can Update all agent active status 
    $('.save_status').on("click", function (event) {
        event.preventDefault();
        $var = $(this);
        var id = event.target.id;
        var value = event.target.innerText;

        $("#dialog").addClass("open");
        $('.dialog-msg').html("Do you really want to change the agent Status ?");
        
        // if user click on dialog's box button NO then remove this dialog box event
        $("#dialog").click(function() {
            $(".dialog-yes-btn").unbind();
        });

        //Attach document delete function to yes button
        $("#dialog .dialog-yes-btn").click(function(){
            $("#dialog").removeClass("open");

            $.ajax({
                type: 'GET',
                url: web_url + "/admin/status",
                data:{id:id,value:value},

                success: function (data) {
                    var stat_us;
                    if (data['messege'] == "1") {
                        if (data['status'] == 1) {
                            stat_us = 'ENABLE';
                            $.notify('User ENABLE', { className: 'success', autoHideDelay: 1500, globalPosition: "top center" });
                        } else {
                            stat_us = 'DISABLE';
                            $.notify('User DISABLE', { className: 'success', autoHideDelay: 1500, globalPosition: "top center" });
                        }
                    } else {
                        $.notify('Error', { className: 'error', autoHideDelay: 1500, globalPosition: "top center" });
                    }
                    $var.text(stat_us);
                }
            })
            
        });
        
    })

    // Here Admin can Update all pages active status 
    $('.page_status').on("click", function (event) {
        event.preventDefault();
        $var = $(this);
        var id = event.target.id;
        var value = event.target.innerText;

        $("#dialog").addClass("open");
        $('.dialog-msg').html("Do you really want to change the agent Status ?");
        
        // if user click on dialog's box button NO then remove this dialog box event
        $("#dialog").click(function() {
            $(".dialog-yes-btn").unbind();
        });

        //Attach document delete function to yes button
        $("#dialog .dialog-yes-btn").click(function(){
            $("#dialog").removeClass("open");

            $.ajax({
                type: 'GET',
                url: web_url + "/admin/pages/status",
                data:{id:id,value:value},

                success: function (data) {
                    var stat_us;
                    if (data['success'] == "1") {
                        if (data['status'] == 1) {
                            stat_us = 'ENABLE';
                            $.notify('User ENABLE', { className: 'success', autoHideDelay: 1500, globalPosition: "top center" });
                        } else {
                            stat_us = 'DISABLE';
                            $.notify('User DISABLE', { className: 'success', autoHideDelay: 1500, globalPosition: "top center" });
                        }
                    } else {
                        $.notify('Error', { className: 'error', autoHideDelay: 1500, globalPosition: "top center" });
                    }
                    $var.text(stat_us);
                }
            })
        });
    });
});


// Added Summernote js for backend pages section 
// Summernote js 
$('.summernote').summernote({
    placeholder: 'Enter the content for page here...',
    tabsize: 2,
    height: 250,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link', 'picture', 'video']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ]
  });