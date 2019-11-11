<?php

namespace Backend\Modules\Asaf\Actions;

use Backend\Core\Engine\Base\ActionIndex as BackendBaseActionIndex;
use Backend\Core\Language\Locale;
use Backend\Modules\Asaf\Domain\Pagesliders\PageslidersDataGrid;

/**
 * This is the index-action (default), it will display the overview
 */
class Pagesliders extends BackendBaseActionIndex
{
    public function execute(): void
    {
        parent::execute();
        // $this->template->assign('dataGrid', 'data');
        $this->template->assign('dataGrid', PageslidersDataGrid::getHtml(Locale::workingLocale()));
        $this->parse();
        $this->display();
    }
}
