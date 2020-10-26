<?php

namespace InsologyStudio\FattureInCloud\Services;
use InsologyStudio\FattureInCloud\Factory\Document;
use Illuminate\Support\Facades\Http;
use InsologyStudio\FattureInCloud\Traits\PayPalRequest as PayPalAPIRequest;
use Illuminate\Support\Facades\Validator;

class InvoiceService extends DocumentService implements Document
{   
    protected $subject = 'fatture';

    public function __construct()
    {
        parent::__construct($this->subject);
    }
}