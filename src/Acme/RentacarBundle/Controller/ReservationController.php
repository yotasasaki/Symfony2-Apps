<?php

namespace Acme\RentacarBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBUndle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * ReservationController.
 *
 * @auther Your Name
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
        if ('POST' === $request->getMethod()) {
            return $this->redirect($this->generateUrl('reservation_car'));
        }

        return array();
    } 

    /**
     * @Route("/car", name="reservation_car")
     * @Template
     */
    public function carAction(Request $request)
    {
        if ('POST' === $request->getMethod()) {
            return $this->redirect($this->generateUrl('reservation_option'));
        }

       return array();
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
    public function confirm(Request $request)
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
