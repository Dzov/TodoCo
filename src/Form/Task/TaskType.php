<?php

namespace App\Form\Task;

use App\Model\Task\TaskModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => "Titre", 'attr' => ['class' => 'form-control']])
            ->add(
                'content',
                TextareaType::class,
                ['label' => "Description", 'attr' => ['class' => 'form-control']]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => TaskModel::class,
            ]
        );
    }
}
