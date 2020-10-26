<?php

namespace InsologyStudio\FattureInCloud\Services;
use InsologyStudio\FattureInCloud\Api\Product;

class ProductService extends Product
{   
    protected $subject = 'prodotti';
    public function __construct()
    {
        parent::__construct($this->subject);
    }
}