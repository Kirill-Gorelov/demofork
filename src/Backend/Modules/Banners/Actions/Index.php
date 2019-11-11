<?php

namespace Backend\Modules\Asaf\Actions;

use Backend\Core\Engine\Base\ActionIndex as BackendBaseActionIndex;
use Backend\Core\Language\Locale;
use Backend\Modules\Asaf\Domain\Products\ProductDataGrid;

/**
 * This is the index-action (default), it will display the overview
 */
class Index extends BackendBaseActionIndex
{
    public function execute(): void
    {
        parent::execute();
        // $this->template->assign('dataGrid', 'data');
        $this->template->assign('dataGrid', ProductDataGrid::getHtml(Locale::workingLocale()));
        $this->parse();
        $this->display();
    }
}
