/*
 * create toggle function
 */
function toggle( a ){
    
    var toggle = document.getElementById(a);
    
    if( toggle.style.display == "none" ){
        toggle.style.display = "block";
    }else{
        toggle.style.display = "none";
    }
    
}


