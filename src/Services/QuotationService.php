<?php

namespace InsologyStudio\FattureInCloud\Services;
use InsologyStudio\FattureInCloud\Api\Document;

class QuotationService extends Document
{   
    protected $subject = 'preventivi';

    public function __construct()
    {
        parent::__construct($this->subject);
    }
}