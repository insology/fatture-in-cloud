<?php

namespace InsologyStudio\FattureInCloud\Services;
use InsologyStudio\FattureInCloud\Api\Document;

class InvoiceService extends Document
{   
    protected $subject = 'fatture';

    public function __construct()
    {
        parent::__construct($this->subject);
    }
}