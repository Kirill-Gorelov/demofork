<?php

namespace Backend\Modules\Asaf\Actions;

use Symfony\Component\Form\Form;
use Backend\Core\Engine\Model as BackendModel;
use Backend\Modules\Asaf\Domain\Sliders\Slide;
use Backend\Modules\Asaf\Domain\Sliders\SlideType;
use Backend\Modules\Asaf\Domain\Sliders\SlideDelType;
use Backend\Core\Engine\Base\ActionEdit as BackendBaseActionEdit;

/*
 * Контроллер редактирования
 */
class SlideEdit extends BackendBaseActionEdit {

    protected $id;

    private $product;

    private function loadProduct(): void
    {
        $this->product = $this->get('doctrine')->getRepository(Slide::class)->findOneById($this->id);

    }

    private function getForm(): Form
    {
        $form = $this->createForm(
            SlideType::class,
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
        $deleteForm = $this->createForm(
            SlideDelType::class,
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

        // $prices = $this->product->getPrices();
        // if (!empty($prices)){
        //     foreach ($prices as $price) {
        //         $price->setProduct($this->product);
        //     }
        // }

        $this->get('doctrine')->getRepository(Slide::class)->update();

        $this->redirect(BackendModel::createUrlForAction('Slide'));
    }

}
