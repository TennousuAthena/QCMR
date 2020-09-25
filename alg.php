<?php
DEFINE("API_URL", "");

$nowQueue = json_decode(file_get_contents(API_URL . "/api/queue"));
if($nowQueue->count == 0){
    addQueue();
    echo "QAQ \n";
}
function addQueue(){
    send_post(API_URL . "/api/queue/items/add?expression=path+starts+with+%22%2F%22+order+by+path+asc&shuffle=true&clear=false&playback=start");
}

function send_post($url, $post_data=["k"=>"v"]) {
 
    $postdata = http_build_query($post_data);
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => $postdata,
            'timeout' => 15 * 60
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
 
    return $result;
}

echo "Done! \n";
