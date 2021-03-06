<?php

namespace Backend\Modules\EnerSliders\Domain\Slides;

use Backend\Form\Type\DeleteType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

/*
 * Перенастройка формы удаления товара
 */
final class SlideDelType extends DeleteType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $options['action'] = 'slide_delete';
        parent::buildForm($builder, $options);

        $builder->add('id', HiddenType::class);
    }
}
