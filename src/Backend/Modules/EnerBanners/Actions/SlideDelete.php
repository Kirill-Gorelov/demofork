<?php

namespace Backend\Modules\Asaf\Actions;

use Backend\Core\Engine\Base\ActionDelete as BackendBaseActionDelete;
use Backend\Core\Engine\Model as BackendModel;
use Backend\Modules\Asaf\Domain\Sliders\Slide;
use Backend\Modules\Asaf\Domain\Sliders\SlideDelType;

// use Backend\Modules\Asaf\Domain\Products\Price;

/**
 * Контроллер удаления банеров
 */
class SlideDelete extends BackendBaseActionDelete
{

    public function execute(): void
    {
        parent::execute();

        $deleteForm = $this->createForm(
            SlideDelType::class,
            null,
            ['module' => $this->getModule()]
        );
        
        // dump('456');
        // die;
        $deleteForm->handleRequest($this->getRequest());
        if (!$deleteForm->isSubmitted() || !$deleteForm->isValid()) {
            $this->redirect(BackendModel::createUrlForAction('Index', null, null, ['error' => 'something-went-wrong']));
            return;
        }

        $id = $deleteForm->getData()['id'];
        

        $product = $this->get('doctrine')->getRepository(Slide::class)->findOneById($id);

        $this->get('doctrine')->getRepository(Slide::class)->delete($product);

        $this->redirect(BackendModel::createUrlForAction('Slide'));
    }
}
