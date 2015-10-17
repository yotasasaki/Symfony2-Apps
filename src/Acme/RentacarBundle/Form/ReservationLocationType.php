<?php

namespace Acme\RentacarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * ReservationLocationType.
 *
 */
class ReservationLocationType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('departureAt', 'datetime') //datetimeを指定した
            ->add('departureLocation')
            ->add('returnAt', 'datetime') //datetimeを指定した
            ->add('returnLocation')
        ;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'reservation_location';
    }

    /**
     * @inheritDoc
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'validation_groups' => array('reservation_location'),
        );
    }
}
