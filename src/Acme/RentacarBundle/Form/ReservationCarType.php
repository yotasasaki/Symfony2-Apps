<?php

namespace Acme\RentacarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuiderInterface;

/**
 * ReservationCarType.
 */
class ReservationCarType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buidForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('carClass')
        ;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'reservation_car';
    }

    /**
     * @inheritDoc
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'validation_group' => 'reservation_car',
        );
    }
}
