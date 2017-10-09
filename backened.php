<?php

class code {
    
        /*
         * create a constructor to connect to the database
         * this is the first thing i need to be performed hence the constructor
        */
    
        //create private variable for connection, only to be accessed in this class.
	private $con;
        /*
         * this constructor function will take arguments for database
         */
        function __construct( $servername, $username, $password, $dbname ){
			
                /*
                 * create databse connection using mysql improved
                 */
                $this->con = new mysqli( $servername, $username, $password, $dbname );
                /*
                 * check if you are connected else return error
                 */
                if ( $this->con->connect_error ) {
                        die( "Connection failed: " . $this->conn->connect_error )	;
                }
        }
        
        /*
         * create a function to get to do list from the database
        */
        function get_todo_list( $user_id, $feed_id ){
            
            /*
             * use select statement to get the list
             * use prepared statement to prevent sql injections
             */
            $done = 1;
            $undone = 0;
            
            /*switch feed id to check if its all, task done or tasks undone
             * 
             */
            if( $feed_id == 1 ){
                $get_list = $this->con->prepare (" 
                        SELECT todo_id, what_todo, done 
                        FROM todo_table
                        WHERE user_id = ?
                        AND done = ?
                        ORDER BY timestamp DESC
                        ");
                $get_list->bind_param( "ii", $user_id, $done );
            }elseif( $feed_id == 2 ){
                $get_list = $this->con->prepare (" 
                        SELECT todo_id, what_todo, done 
                        FROM todo_table
                        WHERE user_id = ?
                        AND done = ?
                        ORDER BY timestamp DESC
                        ");
                $get_list->bind_param( "ii", $user_id,$undone );
            }else{
                $get_list = $this->con->prepare (" 
                        SELECT todo_id, what_todo, done 
                        FROM todo_table
                        WHERE user_id = ?
                        ORDER BY timestamp DESC
                        ");
                $get_list->bind_param( "i", $user_id );
            }
            $get_list->execute();
            $get_list->bind_result( $todo_id, $what_todo, $done );
            
                while( $get_list->fetch() ) {
                        
                    $todo_id = $todo_id;
                    $done_id = $done;
                    
                    /*
                     * create different output for done and not done tasks
                     */
                    if( $done == 1 ){
                        $done_color = "linen";
                        $update_done = 0;
                    }else{
                        $done_color = "blue";
                        $update_done = 1;
                    }
                    
                    echo
                        "<button id='thread".$todo_id."'' class='todo_list_div $done_color'>".
                            "<div class='mark_todo_div'>".
                                "<input type='checkbox' class='checkbox' onclick='mark( \"$todo_id\", \"done$todo_id\", \"mark\" )' />".
                            "</div>".
                            "<div class='separate_di'>" .
                                "<input type='hidden' id='".$todo_id ."' value='".$todo_id."' />".
                                "<input type='hidden' id='done".$todo_id."' value='".$update_done."' />".
                                "<input type='hidden' id='mark' value='0' />".
                                "<span id='markbtn$todo_id' style='display:none;'></span>".
                                ucfirst($what_todo).
                            "</div>".
                        "</button>";
                }
        }
        
        /*
         * insert what to do into the database
        */
        function send_what_todo( $user_id, $what_to_do ){
            
            $insert = $this->con->prepare("
                       INSERT 
                       INTO todo_table ( user_id, what_todo, done ) 
                       VALUES ( ?, ?, ? ) 
                       ");
            //set done to 0 which represent the task is not yet done
            $done = 0;
            $insert->bind_param( "isi", $user_id, $what_to_do ,$done );
            $insert->execute() == true;
            
        }
        
        /*
         * mark as done or undon function
         */
        function mark( $user_id, $thread_id, $done, $mark ){
            
            /*
             * check if mark all or individually
             */
            if( $mark == 1 ){
                $update = $this->con->prepare("
                           UPDATE todo_table
                           SET done='".$done."'
                           ");
            }else{
            
                $update = $this->con->prepare("
                           UPDATE todo_table
                           SET done='".$done."'  
                           WHERE user_id=? 
                           AND todo_id = ?
                           ");
                $update->bind_param( "ii", $user_id, $thread_id );
            }
                if ( $update->execute() == true ){

                    if( $done == 1 ){
                        echo "Mark Undone";
                    }elseif( $done == 0 ){
                        echo "Mark Done";
                    }else{
                        echo "Error..";
                    }

                }else{
                    echo "Error";
                }
            
        }
        
}

?>

