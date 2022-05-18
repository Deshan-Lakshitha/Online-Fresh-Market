<?php

require (ROOT."Classes/Delivery.php.php");

class Confirmed extends DeliveryState
{

    public function continue(Delivery $delivery)
    {
        // TODO: Implement continue() method.
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
        return "confirmed";
    }
}