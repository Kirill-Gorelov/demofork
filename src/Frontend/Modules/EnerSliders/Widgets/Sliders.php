<?php

namespace Frontend\Modules\EnerSliders\Widgets;

use Frontend\Core\Engine\Base\Widget as FrontendBaseWidget;
use Backend\Modules\EnerSliders\Domain\Sliders\Slider;

class Sliders extends FrontendBaseWidget
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
        $this->template->assign('slider', $this->banner);
    }

    public function loadData() {
        if(intval($this->data['gallery_id']) != 0){
            $this->banner = $this->get('doctrine')->getRepository(Slider::class)->getBanner($this->data['gallery_id']);
            $this->tpl = '/EnerSliders/Layout/Widgets/'.$this->banner->tpl;
        }else{
            $this->banner = '';
            $this->tpl = '';
        }
    }
}
