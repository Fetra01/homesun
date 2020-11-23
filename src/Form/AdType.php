<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdType extends ApplicationType
{

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

            ->add('slug', TextType::class, $this->getConfiguration("Chaine URL", "Adresse web (Automatique)", [
                'required' => false
            ]))

            ->add('coverImage', TextType::class, $this->getConfiguration("URL de l'image principale", "Donnez l'adresse d'une image qui donne vraiment envie de venir chez vous !"))

            ->add('introduction', TextType::class, $this->getConfiguration("Introduction", "Donnez une déscription globale de votre annonce !"))

            ->add('Content', TextareaType::class, $this->getConfiguration("Description détaillée", "Entrez une description unique de votre bien !"))

            ->add('rooms', IntegerType::class, $this->getConfiguration("Nombre de chambres", "Le nombre de chambre disponible !"))

            ->add('bathrooms', IntegerType::class, $this->getConfiguration("Nombre de salles de bain", "Le nombre de salle de bain !"))

            ->add('pool', ChoiceType::class, $this->getConfiguration("Piscine", "Avez-vous une piscine !", [
                'choices'  => [
                    'Oui' => true,
                    'Non' => false,
                ]
            ]))
            
            ->add('price', MoneyType::class, $this->getConfiguration("Prix par jour", "Indiquez le prix que vous voulez pour chaque jour"))

            ->add('images', CollectionType::class, [
                'entry_type'    => ImageType::class,
                'allow_add'     => true,
                'allow_delete'  => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
