<?php

namespace InsologyStudio\FattureInCloud;

class FattureInCloud
{   
    public function client(array $datas = [])
    {   
        return new Services\ClientService($datas);
    }

    public function supplier(array $datas = [])
    {   
        return new Services\SupplierService($datas);
    }

    public function invoice(array $datas = [])
    {   
        return new Services\InvoiceService($datas);
    }
    
    public function product(array $datas = [])
    {   
        return new Services\ProductService($datas);
    }

    public function purchase(array $datas = [])
    {   
        return new Services\PurchaseService($datas);
    }
    
}