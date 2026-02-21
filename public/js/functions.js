
/**
 * This function applied the styles of tailwind input and text area to new elements.
 * Just pass the wrapper element selector to this function. This selector should include only newly added elements.
 */
function apply_tailwind_styles(selector) {
    $( selector + " input, " + selector + " textarea").each(function() {
        $(this).focus(function(){ $(this).parent().addClass("focused")});
        $(this).blur(function(){ 
            $(this).parent().removeClass("focused");
            if($(this).val() != "") {
                $(this).parent().addClass("is-filled");    
            } else {
                $(this).parent().removeClass("is-filled");
            }
        });
        
        if($(this).val() != "") {
            $(this).parent().addClass("is-filled");    
        } else {
            $(this).parent().removeClass("is-filled");
        }
    });
}
