<?php

namespace InsologyStudio\FattureInCloud\Services;
use InsologyStudio\FattureInCloud\Api\Document;

class ReceiptService extends Document
{   
    protected $subject = 'preventivi';

    public function __construct()
    {
        parent::__construct($this->subject);
    }
}