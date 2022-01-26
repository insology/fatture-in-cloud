# FattureInCloud

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

Laravel Fatture in Cloud service. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
composer require insologystudio/fatture-in-cloud
```

In your `.env` file add `FATTURE_CLOUD_API_SECRET` and `FATTURE_CLOUD_COMPANY_ID`. 

## Usage

Please reference to [fattureincloud.it](https://github.com/fattureincloud/fattureincloud-php-sdk) api docs.
You can get an *Api class instance from the `FattureInCloud` service by calling a method with the same *Api class name less the Api suffix. E.g. Retrive `ClientsApi` by calling `$fattureInCloud->clients()`.

```php
<?php
namespace App\Http\Controllers;

use FattureInCloud\Model\ListClientsResponse;
use InsologyStudio\FattureInCloud\FattureInCloud;

class ClientController extends Controller
{
    /**
     * @param FattureInCloud $fattureInCloud
     * @return ListClientsResponse 
     * @throws \FattureInCloud\ApiException
     */
    public function index(FattureInCloud $fattureInCloud): ListClientsResponse
    {
        $companyId = config('fatture-in-cloud.company_id');

        $clients = $fattureInCloud->clients()->listClients($companyId);
        
        return $clients;
    }
}
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [Insology Studio][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/insologystudio/fatture-in-cloud.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/insologystudio/fatture-in-cloud.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/insologystudio/fatture-in-cloud/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/insologystudio/fatture-in-cloud
[link-downloads]: https://packagist.org/packages/insologystudio/fatture-in-cloud
[link-travis]: https://travis-ci.org/insologystudio/fatture-in-cloud
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/insologystudio
[link-contributors]: ../../contributors
