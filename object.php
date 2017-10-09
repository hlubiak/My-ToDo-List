<?php

    require 'backened.php';
    require 'dbconnect.php';

    /*
     * the reason why i created switch statement is for if im gonna send more data separately
     */
    switch( $_POST['sendid'] ){
    
        case 1:

            /*
             * since login system is not created, we going to set the user to 1
             */
            $user_id = 1;
            $code->send_what_todo( $user_id , $_POST['what_todo'], $_POST['send_id'] );
            unset( $code );

            break;
        
        case 2:

            $user_id = 1;
            $code->get_todo_list( $user_id, $_POST['feed_id'] );
            unset( $code );

            break;
        
        case 3:

            $user_id = 1;
            $code->mark( $user_id, $_POST['thread_id'], $_POST['done_id'], $_POST['mark'] );
            unset( $code );

            break;
        
        default:
            echo "Error...";
            break;
    }

?>
