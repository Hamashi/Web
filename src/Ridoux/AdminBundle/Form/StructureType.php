<?php

namespace Ridoux\AdminBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Ridoux\AdminBundle\Form\ImageType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class StructureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder	        
			->add('nom',           TextType::class)
            ->add('type',          TextType::class)
            ->add('prix',          IntegerType::class)
            ->add('dimension',     TextType::class)
            ->add('pvc',           TextType::class)
            ->add('commentaire',   TextType::class)
	        ->add('promotion',     IntegerType::class)
			->add('image',          ImageType::class)
			->add('sauvegarder',      SubmitType::class)
			;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ridoux\AdminBundle\Entity\Structure'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ridoux_adminbundle_structure';
    }


}
