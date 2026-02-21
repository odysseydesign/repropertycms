function contactForm(){
    var name = $('#name').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var messege = $('#messege').val();

    if(name == '' && email == '' && phone == ''){
        alert("All * fields are required ");
        return false;
    } else {
        if(validateName() == false){
            alert("Username must have at least 2 characters ");
            return false;
        } else if(ValidateEmail() == false){
            alert("Incorrect Email");
            return false;
        } else if(ValidatePhone() == false){
            alert("Incorrect Phone");
            return false;
        }

        //all fields have valid data now show loading indicator
        $('#formsubmit').hide();
        $('#spiiner').removeClass('d-none');
        $.ajax({
            type: "GET",
            url:  "property-view",
            data : {name:name, email:email, phone:phone, messege:messege},
            dataType: 'JSON',
            success: function(response){
                console.log(response);

                if(response.success == "0"){
                    console.log("Error");
                    $.notify(
                        response.messege,
                        { position:"top center", className: "error"}
                    );

                    //in error case show the submit button and hide loading
                    $('#formsubmit').show();
                    $('#spiiner').addClass('d-none');

                } else {
                    console.log("Success");
                    $('#contactform').hide();
                    $('#responseform').removeClass('d-none')
                    $('#response').text(response.message)
                    $('#response').addClass('text-success').addClass('p-5').addClass('bold')
                }
            }
        });
    }
    return false;
}

//check name at least 2 characters
function validateName(){
    name = document.getElementById('name').value;
    if (name.length < 2)
    {
        document.getElementById("small-name").innerHTML = "Name must have at least 2 characters";
        document.getElementById("small-name").style.color = "red";
        return false;
    } else {
        document.getElementById("small-name").innerHTML = "";
    }
    return true;
}

//remove number press on fill the name
function NumValidate(){
    return (event.charCode > 64 &&  event.charCode < 91) || (event.charCode > 96 && event.charCode < 122 || event.charCode == 32)
}
// check email credential
function ValidateEmail(){
    email = document.getElementById('email').value;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(email.match(mailformat))
    {
        document.getElementById("small-email").innerHTML = "";
        return true;
    } else {
        document.getElementById("small-email").innerHTML = "Enter Valid email";
        document.getElementById("small-email").style.color = "red";
        return false;
    }
}

// check phone credential
function ValidatePhone(){
    phone = document.getElementById('phone').value;
    var numberformat = /^[0-9]\d{9}$/ ;
    if(numberformat.test(phone)){
        document.getElementById("small-phone").innerHTML = "";
        return true;
    } else {
        document.getElementById("small-phone").innerHTML = "";
        document.getElementById("small-phone").innerHTML = "Use 10 digits valid mobile number";
        document.getElementById("small-phone").style.color = "red";
        return false;
    }
}


function bac(id){
    document.getElementById('exampleModal'+id).style.cssText= 'display:block; opacity:1; transition-delay: 3s; background-color:rgba(0,0,0,0.8);';

    // onclick hotspot button get popup model div
    var hotspot_image = $('#exampleModal' + id)

    // Get window heigth and width
    var window_height = window.innerHeight;
    var window_width = window.innerWidth;

    // get model third parent image details
    var hotspot_images = hotspot_image[0].children[0].children[0].children[1];
    var hotspot_image_height = hotspot_images.height;
    var hotspot_image_width = hotspot_images.width;

    // check if hotspot image heigth size is greater that screen height
    if(hotspot_image_height > window_height) {
        // Get ratio between hotspot image heigth and width
        var height_divide_width = hotspot_image_height / hotspot_image_width;
        // set image width for window
        var final_image_width = window_height / height_divide_width;
        hotspot_images.style.width = final_image_width + 'px';

    } else if(hotspot_image_width > window_width) {        // check for hotspot image width size is greater than screen width

        // Get ratio between hotspot image heigth and width
        var width_divide_height = hotspot_image_width / hotspot_image_height;
        // set image height for window
        var final_image_height = window_height / width_divide_height;
        hotspot_images.style.height = final_image_height + 'px';
    }
}
function close_dialog(id){
    document.getElementById('exampleModal'+id).style.cssText= 'display:none; opacity:0;';
}
function playvideo(){
    $('#video').trigger('play');
    $('#video-play-icon').addClass('d-none');
}