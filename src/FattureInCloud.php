<?php

namespace InsologyStudio\FattureInCloud;

use FattureInCloud\Api\ArchiveApi;
use FattureInCloud\Api\CashbookApi;
use FattureInCloud\Api\ClientsApi;
use FattureInCloud\Api\CompaniesApi;
use FattureInCloud\Api\InfoApi;
use FattureInCloud\Api\IssuedDocumentsApi;
use FattureInCloud\Api\IssuedEInvoicesApi;
use FattureInCloud\Api\ProductsApi;
use FattureInCloud\Api\ReceiptsApi;
use FattureInCloud\Api\ReceivedDocumentsApi;
use FattureInCloud\Api\SettingsApi;
use FattureInCloud\Api\SuppliersApi;
use FattureInCloud\Api\TaxesApi;
use FattureInCloud\Api\UserApi;
use FattureInCloud\Configuration;
use GuzzleHttp\ClientInterface;

/**
 * @method ArchiveApi archive()
 * @method CashbookApi cashbook()
 * @method ClientsApi clients()
 * @method CompaniesApi companies()
 * @method InfoApi info()
 * @method IssuedDocumentsApi issuedDocuments()
 * @method IssuedEInvoicesApi issuedEInvoice()
 * @method ProductsApi products()
 * @method ReceiptsApi receipts()
 * @method ReceivedDocumentsApi receivedDocuments()
 * @method SettingsApi settings()
 * @method SuppliersApi suppliers()
 * @method TaxesApi taxes()
 * @method UserApi user()
 */
class FattureInCloud
{
    public Configuration $config;
    public ?ClientInterface $httpClient = null;

    public function __construct()
    {
        $secret = config('fatture-in-cloud.api_secret');

        $this->config = Configuration::getDefaultConfiguration()->setAccessToken($secret);
    }

    /**
     * Instantiate new *Api class. E.g. new UserApi()
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $endpoint = 'FattureInCloud\Api\\' . ucfirst($name) . 'Api';

        return new $endpoint($this->httpClient, $this->config);
    }
}
