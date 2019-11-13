<?php

namespace Backend\Modules\Asaf\Actions;

use Symfony\Component\Form\Form;
use Backend\Core\Engine\Model as BackendModel;
use Backend\Modules\Asaf\Domain\Works\Works;
use Backend\Modules\Asaf\Domain\Works\WorksType;
use Backend\Modules\Asaf\Domain\Works\WorksDelType;
use Backend\Core\Engine\Base\ActionEdit as BackendBaseActionEdit;

/*
 * Контроллер редактирования
 */
class WorksEdit extends BackendBaseActionEdit {

    protected $id;

    private $product;

    private function loadProduct(): void
    {
        $this->product = $this->get('doctrine')->getRepository(Works::class)->findOneById($this->id);

    }

    private function getForm(): Form
    {
        $form = $this->createForm(
            WorksType::class,
            $this->product
        );

        $form->handleRequest($this->getRequest());

        return $form;
    }

    private function parseForm(Form $form): void
    {
        $this->template->assign('form', $form->createView());

        $this->parse();
        $this->display();
    }

    /*
     * Создаём форму для кнопки удаления. Специфика движка
     */
    private function loadDeleteForm(): void
    {
        // dump('ertg');
        //     die;
        $deleteForm = $this->createForm(
            WorksDelType::class,
            ['id' => $this->id],
            ['module' => $this->getModule()]
        );
        $this->template->assign('deleteForm', $deleteForm->createView());
    }

    protected function parse(): void
    {
        parent::parse();
        // $this->template->assign('mediaGroup', $this->product->getMediaGroup());
        // $this->template->assign('image', $this->product->getImage());
        $this->template->assign('id', $this->product->getId());
    }

    public function execute(): void
    {
        parent::execute();

        $this->id = $this->getRequest()->get('id');

        $this->loadProduct();

        $form = $this->getForm();
        // dump($form);
        // die;

        if (!$form->isSubmitted() || !$form->isValid()) {
            
            $this->loadDeleteForm();
            $this->parseForm($form);
            return;
        }

        $this->get('doctrine')->getRepository(Works::class)->update();
        $this->redirect(BackendModel::createUrlForAction('Works'));
    }

}
