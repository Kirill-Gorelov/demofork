<?php

namespace Backend\Modules\Asaf\Actions;

use Backend\Core\Engine\Base\ActionAdd as BackendBaseActionAdd;
use Backend\Modules\Asaf\Domain\Products\Product;
use Backend\Modules\Asaf\Domain\Products\ProductType;

use Symfony\Component\Form\Form;
use Backend\Core\Engine\Model as BackendModel;

/*
 * Контроллер добавления товара
 */

class Add extends BackendBaseActionAdd
{

    private function getForm(): Form
    {
        $form = $this->createForm(
            ProductType::class,
            new Product()
        );

        $form->handleRequest($this->getRequest());

        return $form;
    }

    private function parseForm(Form $form): void
    {
        $this->template->assign('form', $form->createView());
        // $this->template->assign('mediaGroup', $form->getData()->getMediaGroup());

        $this->parse();
        $this->display();
    }

    private function createProduct(Form $form): bool
    {
        $product = $form->getData();
        // dump($product);
        // die;

        $oneslide = $product->getOneslidep();
        if (!empty($oneslide)){
            foreach ($oneslide as $slide) {
                $slide->setProduct($product);
            }
        }
        $this->get('doctrine')->getRepository(Product::class)->add($product);

        return true;
    }

    public function execute(): void
    {
        parent::execute();

        $form = $this->getForm();

        if (!$form->isSubmitted() || !$form->isValid()) {
            $this->parseForm($form);
            return;
        }

        $this->createProduct($form);
        $this->redirect(BackendModel::createUrlForAction('Index'));
    }
}
