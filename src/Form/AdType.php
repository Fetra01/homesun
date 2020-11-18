<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType
{
    /**
     * Permet d'avoir le configuration de base des champs
     *
     * @param string $label
     * @param string $placeholder
     * @return array
     */

    private function getConfiguration($label, $placeholder){
        return [
            'label' => $label,
            'attr'  => [
                'placeholder' => $placeholder
            ]
        ];

    }
    
    /**
     * Configuration du choix pour la piscine
     *
     * @param string $label
     * @return array
     */
    private function getConfigPool($label){
        return [
            'label' => $label,
            'choices'  => [
                'Oui' => true,
                'Non' => false,
            ],
        ];
    }
    
    /**
     * Les champs à compléter
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title', TextType::class, $this->getConfiguration("Titre","Entrer un titre pour votre annonce"))
            ->add('slug', TextType::class, $this->getConfiguration("Chaine URL", "Adresse web (Automatique)"))
            ->add('price', MoneyType::class, $this->getConfiguration("Prix par jour", "Indiquez le prix que vous voulez pour chaque jour"))
            ->add('introduction', TextType::class, $this->getConfiguration("Introduction", "Donnez une déscription globale de votre annonce !"))
            ->add('Content', TextareaType::class, $this->getConfiguration("Description détaillée", "Entrez une description unique de votre bien !"))
            ->add('coverImage', TextType::class, $this->getConfiguration("URL de l'image principale", "Donnez l'adresse d'une image qui donne vraiment envie de venir chez vous !"))
            ->add('rooms', IntegerType::class, $this->getConfiguration("Nombre de chambres", "Le nombre de chambre disponible !"))
            ->add('bathrooms', IntegerType::class, $this->getConfiguration("Nombre de salles de bain", "Le nombre de salle de bain !"))
            ->add('pool', ChoiceType::class, $this->getConfigPool("Piscine", "Avez-vous une piscine !"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
