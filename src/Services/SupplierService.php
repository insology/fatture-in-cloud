<?php

namespace InsologyStudio\FattureInCloud\Services;
use InsologyStudio\FattureInCloud\Api\PersonalData;

class SupplierService extends PersonalData
{   
    protected $subject = 'fornitori';
    public function __construct()
    {
        parent::__construct($this->subject);
    }
}