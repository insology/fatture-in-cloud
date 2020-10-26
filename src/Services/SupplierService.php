<?php

namespace InsologyStudio\FattureInCloud\Services;
use Illuminate\Support\Facades\Http;
use InsologyStudio\FattureInCloud\Traits\PayPalRequest as PayPalAPIRequest;
use Illuminate\Support\Facades\Validator;

class SupplierService extends PersonalDataService
{   
    protected $subject = 'fornitori';
    public function __construct()
    {
        parent::__construct($this->subject);
    }
}