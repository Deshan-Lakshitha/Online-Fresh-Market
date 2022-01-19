<?php

class Request {
    private $request_id, $shop_id, $shop_name, $user_id, $status;

    public function __construct ($request_id, $shop_id, $shop_name, $user_id, $status)
    {
        $this->request_id = $request_id;
        $this->shop_id = $shop_id;
        $this->shop_name = $shop_name;
        $this->user_id;
        $this->status;
    }

    
}