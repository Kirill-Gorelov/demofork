<?php
namespace Backend\Modules\Banners\Installer;

use Common\ModuleExtraType;
use Backend\Core\Engine\Model;
use Backend\Core\Installer\ModuleInstaller;
use Backend\Modules\Banners\Domain\Banners\Banner;
// use Backend\Modules\Banners\Domain\Banners\Banner;

final class Installer extends ModuleInstaller
{
    public function install()
    {
        $this->addModule('Banners');

        // $this->importLocale(__DIR__ . '/Data/locale.xml');
        $this->configureBackendNavigation();
        $this->configureBackendRights();
        $this->makeSearchable($this->getModule());

        $this->configureFrontendExtras();
        $this->configureEntities();

    }


    private function configureBackendNavigation(): void
    {
        $navigationModulesId = $this->setNavigation(null, 'Modules');
        $moduleAsafId = $this->setNavigation($navigationModulesId, 'Banners');
        $this->setNavigation($moduleAsafId, 'Banners', 'banners/index', ['banners/add']); 
    }


    private function configureBackendRights(): void
    {
        $this->setModuleRights(1, 'Banners');
        $this->setActionRights(1, 'Banners', 'Banners');
    }


    private function configureFrontendExtras(): void
    {
    }

    private function configureEntities(): void
    {
        Model::get('fork.entity.create_schema')->forEntityClass(Banner::class);
    }


}
