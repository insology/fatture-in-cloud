<?php

namespace InsologyStudio\FattureInCloud\Services;
use InsologyStudio\FattureInCloud\Api\Document;

class CreditNoteService extends Document
{   
    protected $subject = 'ndc';

    public function __construct()
    {
        parent::__construct($this->subject);
    }
}