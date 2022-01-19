<?php

abstract class OrderFactory
{
    public function createOrder($arr)
    {
        $order = $this->create($arr);
        return $order;
    }

    protected abstract function create($arr);
}