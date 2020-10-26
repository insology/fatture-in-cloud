<?php

namespace InsologyStudio\FattureInCloud\Services;
use InsologyStudio\FattureInCloud\Api\Purchase;

class PurchaseService extends Purchase
{   
    protected $subject = 'acquisti';

    public function __construct()
    {
        parent::__construct($this->subject);
    }
}