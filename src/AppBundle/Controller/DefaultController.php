<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Column\TextColumn;
use APY\DataGridBundle\Grid\Column\ActionsColumn;
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;
use APY\DataGridBundle\Grid\Action\RowAction;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //return $this->render('default/index.html.twig');

        // Creates a simple grid based on your entity (ORM)
        $source = new Entity('AppBundle:BonusCard');

        // Get a Grid instance
        $grid = $this->get('grid');

//        $grid->setRouteUrl($this->generateUrl(''));

        // Attach the source to the grid
        $grid->setSource($source);

        $grid->setLimits(array(25, 50));
//        $grid->setDefaultLimit(25);


        // Add row actions in the default row actions column
        $myRowAction = new RowAction('Toggle Status', 'card_toggle');
        $grid->addRowAction($myRowAction);

//        $myRowAction = new RowAction('Edit', 'AppBundle:BonusCard:edit');
//        $myRowAction = new RowAction('Edit', 'AppBundle\Controller\BonusCardController::editAction');
        $myRowAction = new RowAction('Edit', 'card_edit');
        $grid->addRowAction($myRowAction);

//        $myRowAction = new RowAction('Delete', 'AppBundle:BonusCard:delete', true, '_self');
        $myRowAction = new RowAction('Delete', 'card_delete', true, '_self');
        $grid->addRowAction($myRowAction);

        return $grid->getGridResponse($request->isXmlHttpRequest() ? 'BonusCard/grid.html.twig' : 'default/index.html.twig');
    }


    
    
    
    
}
