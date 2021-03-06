<?php

namespace Backend\Modules\EnerSliders\Domain\Sliders;

use Backend\Form\Type\DeleteType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

final class SliderDelType extends DeleteType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $options['action'] = 'delete';
        parent::buildForm($builder, $options);

        $builder->add('id', HiddenType::class);
    }
}
