<?php

namespace Emsephron\TallDatatable;

use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TallDatatableServiceProvider extends PackageServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        Blade::directive('datatableScripts', function () {
            return "<?php echo view('tall-datatable::scripts')->render(); ?>";
        });

        Blade::directive('datatableStyles', function () {
            return "<?php echo view('tall-datatable::styles')->render(); ?>";
        });
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('tall-datatable')
            ->hasViews()
            ->hasAssets();
    }
}
