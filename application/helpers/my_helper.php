<?php 
function sendJSONOutput($response)
{
    $ci = &get_instance();
    $ci->output->set_content_type('application/json');
    return $ci->output->set_output(json_encode($response));
}
?>