<?php

namespace InsologyStudio\FattureInCloud\Services;
use InsologyStudio\FattureInCloud\Api\Document;

class OrderService extends Document
{   
    protected $subject = 'ordini';

    public function __construct()
    {
        parent::__construct($this->subject);
    }
}