<?php

namespace Backend\Modules\Asaf\Actions;

use Backend\Core\Engine\Base\ActionAdd as BackendBaseActionAdd;
use Backend\Modules\Asaf\Domain\OneSlide\OneSlide;
use Backend\Modules\Asaf\Domain\OneSlide\OneSlideType;

use Symfony\Component\Form\Form;
use Backend\Core\Engine\Model as BackendModel;

/*
 * Контроллер добавления товара
 */

class OneSlideAdd extends BackendBaseActionAdd
{

    private function getForm(): Form
    {
        $form = $this->createForm(
            OneSlideType::class,
            new OneSlide()
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
        $this->get('doctrine')->getRepository(OneSlide::class)->add($product);

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
