<?php

namespace InsologyStudio\FattureInCloud\Facades;

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
use Illuminate\Support\Facades\Facade;

/**
 * @method static ArchiveApi archive()
 * @method static CashbookApi cashbook()
 * @method static ClientsApi clients()
 * @method static CompaniesApi companies()
 * @method static InfoApi info()
 * @method static IssuedDocumentsApi issuedDocuments()
 * @method static IssuedEInvoicesApi issuedEInvoice()
 * @method static ProductsApi products()
 * @method static ReceiptsApi receipts()
 * @method static ReceivedDocumentsApi receivedDocuments()
 * @method static SettingsApi settings()
 * @method static SuppliersApi suppliers()
 * @method static TaxesApi taxes()
 * @method static UserApi user()
 */
class FattureInCloud extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return \InsologyStudio\FattureInCloud\FattureInCloud::class;
    }
}
