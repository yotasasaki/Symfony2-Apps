<?php

namespace Acme\RentacarBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBUndle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Acme\RentacarBundle\Entity\Reservation;
use Acme\RentacarBundle\Form\ReservationLocationType;
use Acme\RentacarBundle\Form\ReservationCarType;

/**
 * ReservationController.
 *
 * @Route("/reservation")
 */
class ReservationController extends AppController
{
    /**
     * @Route("/", name="reservation")
     * @Template
     */
    public function indexAction(Request $request)
    {
        return array();
    }

     /**
     * @Route("/new", name="reservation_new")
     * @Template
     */
    public function newAction(Request $request)
    {
        $reservation = new Reservation();

        $form = $this->createForm(new ReservationLocationType(), $reservation);

        if ('POST' === $request->getMethod()) {
            $data = $request->request->get($form->getName());
            $form->bind($data);
            if ($form->isValid()) {
                $request->getSession()->set('reservation/location', $data);

                return $this->redirect($this->generateUrl('reservation_car'));
            }
        } elseif ($request->getSession()->has('reservation/location')) {
            $data = $request->getSession()->get('reservation/location');
            #$data['_token'] = $form['_token']->getData();
            $form->bind($data);
        }

        return array(
            'form' => $form->createView(),
        );
    } 

    /**
     * @Route("/car", name="reservation_car")
     * @Template
     */
    public function carAction(Request $request)
    {
        $reservation = new Reservation();
        
        if (!$this->restoreReservationForms($reservation,
            array('location'))) {
            return $this->redirect($this->generteUrl('reservation_new'));
        }

        $carClassRepository = $this->get('doctrine')->getRepository('AcmeRentacarBundle:CarClass');
        $carClasses = $carClassRepository->findAll();

        $form = $this->createForm(new ReservationCarType(), $reservation);
        if ('POST' === $request->getMethod()) {
            $data = $request->request->get($form->getName);
            $form->bind($data);
            if ($form->isValid()) {
                $request->getSession()->set('reservation/car', $data);
                return $this->redirect($this->generateUrl('reservation_option'));
            }
        }

        return array(
            'carClasses' => $carClasses,
            'form'       => $form->createView(),
        );
    }

    /**
     * Restore reservation data.
     *
     * @param Reservation $reservation
     * @param $formKeys
     * @return boolean
     */
    private function restoreReservationForms(Reservation $reservation, array $formKeys)
    {
        $session = $this->getRequest()->getSession();

        $factory = $this->get('form.factory');
        $binder = function($type, $data) use($factory, $reservation) {
            if (isset($data['_token'])) {
                unset($data['_token']);
            }
            $form = $factory->create($type, $reservation, array('csrf_protection' => false));
            $form->bind($data);

            return $form->isValid();
        };

        $valid = true;

        foreach ($formKeys as $formKey) {
            switch ($formKey) {
                case 'location':
                    $valid = $binder(new ReservationLocationType(),
                             $session->get('reservation/location'));
                    break;
                case 'car':
                    $valid = $binder(new ReservationLocationType(),
                             $session->get('reservation/car'));
                    break;
                default:
                    throw new \InvalidAugumentException(sprintf('Unknown form key "%s"', $formKey));
            }
            
            if (!$valid) {
                return false;
            }
        }

        return true;
    }

    /**
     * @Route("/option", name="reservation_option")
     * @Template
     */
    public function optionAction(Request $request)
    {
        if ('POST' === $request->getMethod()) {
            return $this->redirect($this->generateUrl('reservation_confirm'));
        }
 
        return array();
    }

    /**
     * @Route("/confirm", name="reservation_confirm")
     * @Template
     */
    public function confirmAction(Request $request)
    {
        return array();
    }

    /**
     * @Route("/finish", name="reservation_finish")
     * @Template
     */
    public function finish(Request $request)
    {
        return array();
    }
}
