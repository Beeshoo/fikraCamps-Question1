<?php
    /*
        Q1: Write a function that gets user id and returns his posts with their comments in one JSON object
    ========================================================================================================
    ====    you can fetch the posts from this API: https://jsonplaceholder.typicode.com/posts           ====
    ====    and their comments from this API: https://jsonplaceholder.typicode.com/comments             ====
    ========================================================================================================
    ========================================================================================================
    ====    function name : getAllPostsCommentsByUserId                                                 ====
    ====    variables     : $userID         => parameter of function                                    ====
    ====                  : $json_posts     => take the object json file that has posts                 ====
    ====                  : $array_posts    => posts of users in an multi_array                         ====
    ====                  : $json_comment   => take the object json file that has comments              ====
    ====                  : $array_comment  => comments of users on posts in an multi_array             ====
    ====                  : $user           => an multi_array that take the post and its comments       ====
    ====                  : $array_comment  => comments of users on posts in an multi_array             ====
    ========================================================================================================
    */

    function getAllPostsCommentsByUserId($userID){
        $json_posts     = file_get_contents("posts.json");  //  file_get_contents() returns the file in a string
        $array_posts    = json_decode($json_posts, TRUE);   //  Takes a JSON encoded string and converts it into a PHP variable.
                                                            //  When take TRUE Parameter, returned objects will be converted into associative arrays.

        $json_comments  = file_get_contents("comments.json");
        $array_comments = json_decode($json_comments, true);

        $user = array();
        foreach($array_posts as $post){
            if( $post["userId"] == $userID ){               //  when userId of posts == the Required user take the posts and store it in $user Array
                $user[] = $post['title'];
                foreach($array_comments as $comment){       
                    if($comment['postId'] == $post['id']){  //  when postId of comments == the id of post($array_posts) store comments in subArray in 
                        $user[$post['title']][]= $comment['body'];
                    }
                }
            }
        }
        return json_encode($user);                          // Returns a string containing the JSON representation of the supplied value.
    }
    echo "<pre>";
    print_r($username = getAllPostsCommentsByUserId(1));    //  Call function with $userID = 1 & print the result (josn object)
    
?>