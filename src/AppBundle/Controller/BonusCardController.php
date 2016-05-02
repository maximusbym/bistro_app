<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

//use APY\DataGridBundle\Grid\Source\Entity;
//use APY\DataGridBundle\Grid\Column\TextColumn;
//use APY\DataGridBundle\Grid\Column\ActionsColumn;
//use APY\DataGridBundle\Grid\Action\MassAction;
//use APY\DataGridBundle\Grid\Action\DeleteMassAction;
//use APY\DataGridBundle\Grid\Action\RowAction;

class BonusCardController extends Controller
{

    /**
     * @Route("/bonus-card/edit/{id}", name="card_edit")
     */
    public function editAction($id, Request $request)
    {


        // replace this example code with whatever you need
//        return $this->render('default/grid.html.twig', array(
//            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
//        ));
    }
    
    /**
     * @Route("/bonus-card/delete/{id}", name="card_delete")
     */
    public function deleteAction($id, Request $request)
    {
        if (!$id) {
            throw $this->createNotFoundException('No BonusCard found');
        }

        $em = $this->getDoctrine()->getManager();
        $bonusCard = $em->find('\AppBundle\Entity\BonusCard',$id);
        
        if( $bonusCard ) {

            $em->remove($bonusCard);
            $em->flush();
            return $this->redirect('/');
        }
        else {
            throw $this->createNotFoundException('No BonusCard found');
        }

    }
    
    /**
     * @Route("/bonus-card/toggle/{id}", name="card_toggle")
     */
    public function toggleAction($id,Request $request)
    {
        

        // replace this example code with whatever you need
//        return $this->render('default/grid.html.twig', array(
//            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
//        ));
    }
    
//    /**
//     * @Route("/bonus-cards/grid", name="cards_grid")
//     */
//    public function gridAction()
//    {
//        // Creates a simple grid based on your entity (ORM)
//        $source = new Entity('AppBundle:BonusCard');
//
//        // Get a Grid instance
//        $grid = $this->get('grid');
//
//        $grid->setRouteUrl($this->generateUrl('cards_grid'));
//
//        // Attach the source to the grid
//        $grid->setSource($source);
//
//        $grid->setLimits(array(25, 50));
//        $grid->setDefaultLimit(25);
//
//
//        // Add row actions in the default row actions column
//        $myRowAction = new RowAction('Toggle Status', 'card_toggle');
//        $grid->addRowAction($myRowAction);
//
////        $myRowAction = new RowAction('Edit', 'AppBundle:BonusCard:edit');
////        $myRowAction = new RowAction('Edit', 'AppBundle\Controller\BonusCardController::editAction');
//        $myRowAction = new RowAction('Edit', 'card_edit');
//        $grid->addRowAction($myRowAction);
//
////        $myRowAction = new RowAction('Delete', 'AppBundle:BonusCard:delete', true, '_self');
//        $myRowAction = new RowAction('Delete', 'card_delete', true, '_self');
//        $grid->addRowAction($myRowAction);
//
//        // Return the response of the grid to the template
//        return $grid->getGridResponse('BonusCard/grid.html.twig');
//
//    }




}
