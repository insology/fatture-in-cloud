<?php

namespace InsologyStudio\FattureInCloud\Services;
use InsologyStudio\FattureInCloud\Api\Document;

class ProFormaService extends Document
{   
    protected $subject = 'ddt';

    public function __construct()
    {
        parent::__construct($this->subject);
    }
}