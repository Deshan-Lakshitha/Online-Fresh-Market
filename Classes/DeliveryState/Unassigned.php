<?php

require (ROOT."Classes/Delivery.php.php");

class Unassigned extends DeliveryState
{

    public function continue(Delivery $delivery)
    {
        $delivery->setDeliveryState(new Assigned());
    }

    public function previous(Delivery $delivery)
    {
        // TODO: Implement previous() method.
    }

    public function cancel(Delivery $delivery)
    {
        // TODO: Implement cancel() method.
    }

    public function getState()
    {
        return "unassigned";
    }
}