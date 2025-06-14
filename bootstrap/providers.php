<?php

return [
    App\Providers\AppServiceProvider::class,

    App\Domains\Accounting\AccountingProvider::class,
    App\Domains\Admin\AdminProvider::class,
    App\Domains\Agenda\AgendaProvider::class,
    App\Domains\Assets\AssetsProvider::class,
    App\Domains\Auth\AuthProvider::class,
    App\Domains\Crm\CrmProvider::class,
    App\Domains\Dashboard\DashboardProvider::class,
    App\Domains\Data\DataProvider::class,
    App\Domains\Hris\HrisProvider::class,
    App\Domains\I18n\I18nProvider::class,
    App\Domains\Industry\IndustryProvider::class,
    App\Domains\Product\ProductProvider::class,
    App\Domains\Projects\ProjectsProvider::class,
    App\Domains\RealEstate\RealEstateProvider::class,
    App\Domains\Stock\StockProvider::class,
    App\Domains\Supplier\SupplierProvider::class,
    App\Domains\User\UserProvider::class,
];
