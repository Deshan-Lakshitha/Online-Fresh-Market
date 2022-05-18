<?php

require (ROOT."Classes/Delivery.php.php");

class Assigned extends DeliveryState
{

    public function continue(Delivery $delivery)
    {
        $delivery->setDeliveryState(new Accepted());
    }

    public function previous(Delivery $delivery)
    {
        $delivery->setDeliveryState(new Unassigned());
    }

    public function cancel(Delivery $delivery)
    {
        // TODO: Implement cancel() method.
    }

    public function getState()
    {
        return "assigned";
    }
}