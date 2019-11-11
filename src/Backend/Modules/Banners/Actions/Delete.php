<?php

namespace Backend\Modules\Asaf\Actions;

use Backend\Core\Engine\Base\ActionDelete as BackendBaseActionDelete;
use Backend\Core\Engine\Model as BackendModel;
use Backend\Modules\Asaf\Domain\Products\Product;
use Backend\Modules\Asaf\Domain\Products\ProductsDelType;

// use Backend\Modules\Asaf\Domain\Products\Price;

/**
 * Контроллер удаления банеров
 */
class Delete extends BackendBaseActionDelete
{

    public function execute(): void
    {
        parent::execute();

        $deleteForm = $this->createForm(
            ProductsDelType::class,
            null,
            ['module' => $this->getModule()]
        );

        $deleteForm->handleRequest($this->getRequest());
        if (!$deleteForm->isSubmitted() || !$deleteForm->isValid()) {
            $this->redirect(BackendModel::createUrlForAction('Index', null, null, ['error' => 'something-went-wrong']));

            return;
        }

        $id = $deleteForm->getData()['id'];

        $product = $this->get('doctrine')->getRepository(Product::class)->findOneById($id);

        $this->get('doctrine')->getRepository(Product::class)->delete($product);

        $this->redirect(BackendModel::createUrlForAction('Index'));
    }
}
