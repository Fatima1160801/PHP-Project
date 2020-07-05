<?php
if (!function_exists('getMessage')) {
    function getMessage($msg_id)
    {
        $msg = \App\Models\Setting\Message::
        where('id', $msg_id)
            ->first();
        $massage = [];
        if ($msg) {
            if($msg->messages_type == 1){
                $massage['type'] ='success';
                $massage['icon'] ='done';
            }elseif($msg->messages_type == 2){
                $massage['type'] ='warning';
                $massage['icon'] ='warning';
            }elseif($msg->messages_type == 3){
                $massage['type'] ='info';
                $massage['icon'] ='info';

            }elseif($msg->messages_type == 4){
                $massage['type'] ='confirmation';
                $massage['icon'] ='confirmation_number';
            }

            if (Auth::user()->lang_id == 1) {
                $massage['text'] = $msg->messages_na;
                $massage['title'] = $msg->messages_title_na;
            } else {
                $massage['text'] = $msg->messages_fo;
                $massage['title'] = $msg->messages_title_fo;
            }
            return $massage;
        }
    }

}

    