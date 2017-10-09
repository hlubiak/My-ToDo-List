function send_what_todo(){
        
	var xmlhttp;
        var sendid = 1;
        var what_todo = document.getElementById("what_todo").value;
      
          if (window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
          }else{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
            xmlhttp.onreadystatechange=function()
          {
            if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 )
            {
                /*
                 * create a div tto temporarily store and show what you sent
                 */
                var temp_div = document.createElement("button");
                temp_div.setAttribute("id",what_todo);
                temp_div.setAttribute("class","todo_list_div blue")
                document.getElementById("feed").appendChild( temp_div );
                var existingAnchor = document.getElementById("temp_holder");
                var parent = existingAnchor.parentNode;
                var newChild = parent.insertBefore( temp_div, existingAnchor );
                
                /*
                 * create checkbox on temp_div above
                 */
                var temp_checkbox = document.createElement("div");
                    temp_checkbox.setAttribute("id","checkbox");
                    temp_checkbox.setAttribute("class","done_btn");
                    temp_div.appendChild( temp_checkbox );
                    
                document.getElementById( what_todo ).innerHTML = what_todo;
             
                //hide the textarea and empty its value
                document.getElementById( "what_todo" ).value = "";
                document.getElementById( "what_todo_input_div" ).style.display ="none";
                
            }
          }
            
            xmlhttp.open( "POST", "object.php" ,true );
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send( "sendid="+sendid + "&what_todo="+what_todo );
    
}

function get_todo( a ){
       
	var xmlhttp;
        var sendid = 2;
        var feed_id = document.getElementById(a).value;
        var loading = document.getElementById("loading");
        if ( window.XMLHttpRequest ){
          xmlhttp = new XMLHttpRequest();
        }else{
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
          xmlhttp.onreadystatechange=function()
        {
          if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 )
          {
            document.getElementById( "feed" ).innerHTML = xmlhttp.responseText;
            loading.style.display = "none";
          }
        }

            /*
             * show if its still loading
             */ 
            loading.style.display = "block";
            
          xmlhttp.open( "POST", "object.php" ,true );
          xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          xmlhttp.send( "sendid="+sendid + "&feed_id="+feed_id );
          
}

function mark( a, b, c ){
       
	var xmlhttp;
        var sendid = 3;
        var thread_id = document.getElementById(a).value;
        var done_id = document.getElementById(b).value;
        var mark = document.getElementById(c).value;
        
        if ( window.XMLHttpRequest ){
          xmlhttp = new XMLHttpRequest();
        }else{
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
          xmlhttp.onreadystatechange=function()
        {
          if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 )
          {
              document.getElementById( "markbtn"+thread_id ).innerHTML = xmlhttp.responseText;
              /*
               * change thread color according to done or not done
               */
              if( done_id == 1 && mark != 1 ){
                document.getElementById( "thread"+thread_id ).style.background = "linen";
                document.getElementById( "done"+thread_id ).value = 0;
              }else if( done_id == 0 && mark != 1 ){
                document.getElementById( "thread"+thread_id ).style.background = "lightblue";
                document.getElementById( "done"+thread_id ).value = 1;
              }else if( mark == 1 ){
                document.getElementById( "done_id" ).value = 0;
                document.getElementByClassName("todo_list_div").style.background = "linen";
              }
          }
        }

          xmlhttp.open( "POST", "object.php" ,true );
          xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          xmlhttp.send( "sendid="+sendid + "&thread_id="+thread_id + "&done_id="+done_id + "&mark="+mark );
          
}