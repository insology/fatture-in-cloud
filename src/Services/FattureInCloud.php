<?php

namespace InsologyStudio\FattureInCloud\Services;

class FattureInCloud
{   
    public function client(array $datas = [])
    {   
        return new ClientService($datas);
    }

    public function supplier(array $datas = [])
    {   
        return new SupplierService($datas);
    }

    public function invoice(array $datas = [])
    {   
        return new InvoiceService($datas);
    }
    
}