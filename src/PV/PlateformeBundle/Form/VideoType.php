<?php

namespace PV\PlateformeBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',          TextType::class)
            ->add('description',    TextareaType::class)
            ->add('lienVideo',      TextType::class)
            ->add('categorie',      EntityType::class,
                array(
                    "class" => "PV\PlateformeBundle\Entity\Categorie",
                    "choice_label" => "nom"
                )
            )
            ->add("Ajouter", SubmitType::class, array(
                'attr' => array('class' => 'btn btn-block btn-success'),
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PV\PlateformeBundle\Entity\Video'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pv_plateformebundle_video';
    }


}
