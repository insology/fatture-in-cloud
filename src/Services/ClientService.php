<?php

namespace InsologyStudio\FattureInCloud\Services;
use Illuminate\Support\Facades\Http;
use InsologyStudio\FattureInCloud\Traits\PayPalRequest as PayPalAPIRequest;
use Illuminate\Support\Facades\Validator;

class ClientService extends PersonalDataService
{   
    protected $subject = 'clienti';

    public function __construct()
    {
        parent::__construct($this->subject);
    }
}