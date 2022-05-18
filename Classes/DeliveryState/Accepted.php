<?php

require (ROOT."Classes/Delivery.php.php");

class Accepted extends DeliveryState
{

    public function continue(Delivery $delivery)
    {
        $delivery->setDeliveryState(new Confirmed());
    }

    public function previous(Delivery $delivery)
    {
        // TODO: Implement previous() method.
    }

    public function cancel(Delivery $delivery)
    {
        $delivery->setDeliveryState(new Rejected());
    }

    public function getState()
    {
       return "accepted";
    }
}