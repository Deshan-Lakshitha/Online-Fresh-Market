<?php

require_once(ROOT . "Classes/OrderFactory.php");
require_once(ROOT . "Classes/MyOrder.php");

class MyOrderFactory extends OrderFactory
{

    public function create($arr)
    {
        return new MyOrder($arr[0],$arr[1],$arr[2],$arr[3],$arr[4],$arr[5],$arr[6],$arr[7],$arr[8],$arr[9],$arr[10]);
    }
}