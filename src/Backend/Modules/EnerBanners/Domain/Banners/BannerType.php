<?php

namespace Backend\Modules\EnerBanners\Domain\Banners;

use Symfony\Component\Form\AbstractType;
//use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\LabelType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Backend\Modules\MediaLibrary\Domain\MediaGroup\MediaGroupType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Valid;
use Backend\Form\Type\EditorType;
use Backend\Form\Type\MetaType;
use Backend\Core\Engine\Model;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Common\Form\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Backend\Modules\TechCourses\Forms\SpeakerType;

class BannerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('active',
            CheckboxType::class,
            [
                'label' => 'Показывать',
                'required' => false,
            ]
        )->add('title',
            TextType::class,
            [
                'label' => 'Название',
                'empty_data' => false,
                'required' => true,
            ]
        )->add('link',
            TextType::class,
            [
                'label' => 'Ссылка',
                'empty_data' => false,
                'required' => true,
            ]
        )->add('image',
            TextType::class,
            [
                'label' => 'Изображение',
                'required' => true,
                'attr' => ['class'=>'mediaselect'],
            ]
        )->add('description',
            EditorType::class,
            [
                'label' => 'Короткое описание',
                'empty_data' => false,
                'required' => false,
            ]
        )->add('date',
            TextType::class,
            [
                'label' => 'Дата создания',
                'empty_data' => false,
                'disabled' => true
            ]
        )->add('edited_on',
            TextType::class,
            [
                'label' => 'Дата изменения',
                'empty_data' => false,
                'disabled' => true
            ]
        )->add('creator_user_id',
            TextType::class,
            [
                'label' => 'кто создал',
                'empty_data' => false,
                'disabled' => true
            ]
        )->add('tpl',
            ChoiceType::class, [
            'choices' => $this->getTplLayout(),
            'by_reference' => false,
            'placeholder' => 'Выбрать шаблон',
            'required' => true,
            'label' => 'Выберите шаблон виджета',
        ]
        ); 

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Banner::class,
        ));
    }

    private function getTplLayout(){
        $ar = [];
        foreach (glob($_SERVER['DOCUMENT_ROOT']."/src/Frontend/Modules/EnerBanners/Layout/*.html.twig") as $filename) {
            $filename = explode('/',$filename);
            $filename = end($filename);
            $ar[$filename] = $filename;
        }
        return $ar;
    }

}
