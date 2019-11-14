<?php

namespace Frontend\Modules\EnerBanners\Widgets;

use Frontend\Core\Engine\Base\Widget as FrontendBaseWidget;
use Backend\Modules\EnerBanners\Domain\Banners\Banner;

class Banners extends FrontendBaseWidget
{
    private $tpl;
    private $banner;
    public function execute(): void
    {
            parent::execute();
            $this->loadData();
            $this->loadTemplate($this->tpl);
            $this->parse();
    }

    public function parse(){
        $this->template->assign('banner', $this->banner);
    }

    public function loadData() {
        $this->banner = $this->get('doctrine')->getRepository(Banner::class)->getBanner(true);
        // $this->tpl = $this->listamenties;
        $this->tpl = '/EnerBanners/Layout/Widgets/default.html.twig';
    }
}
