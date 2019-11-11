<?php

namespace Backend\Modules\Banners\Domain\Banners;

use Backend\Form\Type\DeleteType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

final class BannerDelType extends DeleteType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $options['action'] = 'banner_delete';
        parent::buildForm($builder, $options);

        $builder->add('id', HiddenType::class);
    }
}
