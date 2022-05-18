<?php

require (ROOT."Classes/Delivery.php");

abstract class DeliveryState
{
    public abstract function continue(Delivery $delivery);
    public abstract function previous(Delivery $delivery);
    public abstract function cancel(Delivery $delivery);

    public abstract function getState();
}