Installation
------------

Kernel
======

Add to `/app/AppKernel.php`

.. code-block:: php

    $bundles = array(
        new GetResponse\ApiBundle\GetResponseBundle()
    );

Routing
=======

Add to `app/config/routing.yml`

.. code-block:: yaml

    get_response:
        resource: "@GetResponseBundle/Controller/"
        type:     annotation
        prefix:   /

Config
======

You can fill config literally in `app/config/config.yml`:

.. code-block:: yaml

    get_response:
        url: http://api2.getresponse.com
        key: 1a109b7777333331065413755460
        campaign: my_campaign

but more convenient is adding values into `app/config/parameters.yml`

.. code-block:: yaml

    get_response_url: http://api2.getresponse.com
    get_response_key: 1a109b7777333331065413755460
    get_response_campaign: my_campaign


and then use parameter values in `app/config/config.yml`

.. code-block:: yaml

    get_response:
        url: %get_response_url%
        key: %get_response_key%
        campaign: %get_response_campaign%

`url` parameter is optional, default value is `http://api2.getresponse.com`.


Update
======

It is strongly recommended to run following command to obtain current GetResponse Api Class
from `https://raw.github.com/GetResponse/DevZone/master/API/lib/jsonRPCClient.php`

.. code-block:: bash

    php app/console gr:install



