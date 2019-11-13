<?php

namespace Backend\Modules\Asaf\Actions;

use Backend\Core\Engine\Base\ActionIndex as BackendBaseActionIndex;
use Backend\Core\Language\Locale;
use Backend\Modules\Asaf\Domain\Sliders\SlideDataGrid;

/**
 * This is the index-action (default), it will display the overview
 */
class Slide extends BackendBaseActionIndex
{
    public function execute(): void
    {
        parent::execute();
        // $this->template->assign('dataGrid', 'data');
        $this->template->assign('dataGrid', SlideDataGrid::getHtml(Locale::workingLocale()));
        $this->parse();
        $this->display();
    }
}
