<?php
//namespace My\BlogBundle\Form;

//use Symfony\Component\Form\AbstractType;
//use Symfony\Component\Form\FormBuilder;
//use Symfony\Component\OptionsResolver\OptionsResolverInterface;
/*
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('body')
        ;
    }

    public function setDefaultsOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'My\BlogBundle\Entity\Post',
        ));
    }

    public function getName()
    {
        return 'post';
    }
}
*/

namespace My\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
#use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('body')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
                'data_class' => 'My\BlogBUndle\Entity\Post',
        ));
    }

    public function getName()
    {
        return 'post';
    }
}
