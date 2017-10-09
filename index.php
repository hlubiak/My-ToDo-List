<?php

    require 'backened.php';
    require 'dbconnect.php';

?>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script src="ajax.js"></script>
        <script src="action.js"></script>
    </head>
    <body>
        
        <div class="heading"></div>
        
        <div class="my_todolist_heading">
            <a href="#all" onclick="get_todo('all')"> <button class="add_what_todo_btn" > MY TO-DO LIST </button> </a>
            <input type="hidden" id="all" value="0" />
        </div>
        
        <div class="todo_content_holder round_border">
            
            <div class='todo_actions_div'>
                
                <div class='separate_div'> <button onclick="toggle('what_todo_input_div')" class='right_red_todo_btn '> ADD WHAT TO-DO </button> </div>
                    
                    <a href="#all" onclick="get_todo('all')"> 
                        <div class='separate_div'>  To-Do List </div>
                    </a>
                    <a href="#done" onclick="get_todo('done')"> 
                        <div class='separate_div'>  Done </div>
                        <input type="hidden" id="done" value="1" />
                    </a> 
                    <a href="#undone" onclick="get_todo('undone')"> 
                        <div class='separate_div'> Not done </div>
                        <input type="hidden" id="undone" value="2" />
                    </a> 
                <div class='separate_div'> <input type='checkbox' onclick='mark( "todo_id", "done_id", "mark_all" )' /> <span id="markbtnall"> mark all as done </span> </div>
                        <input type="hidden" id="todo_id" value="all" />
                        <input type="hidden" id="done_id" value="1" />
                        <input type="hidden" id="mark_all" value="1" />
                
            </div>
            
            <div id="what_todo_input_div" class="what_todo_input_div" style="display:none;">
                <textarea type="text" id="what_todo" class="text_input" required="required" placeholder="Write what to do" maxlength="140" ></textarea>
                <input type="button" id="submit_what_tod_btn" value="Submit" class="submit_btn round_border" onclick="send_what_todo()"/>
            </div>
            
            <div id="output">  </div>
            <button id="loading"> Loading... </button>
            <div id="feed">
                <div id="temp_holder"></div>
                <?php
                    $code->get_todo_list( 1,0 );
                ?>
            </div>
            
        </div>
        
    </body>
</html>
