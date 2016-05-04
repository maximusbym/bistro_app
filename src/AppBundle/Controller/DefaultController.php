<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\Type\BonusCardsType;

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
        $source = new Entity('AppBundle:BonusCard');

        $grid = $this->get('grid');
        $grid->setSource($source);
        $grid->setLimits(array(25, 50));

        $myRowAction = new RowAction('Toggle Status', 'card_toggle');
        $myRowAction->addAttribute('class','status-toggle');
        $grid->addRowAction($myRowAction);

        $myRowAction = new RowAction('Profile', 'card_show');
        $grid->addRowAction($myRowAction);

        $myRowAction = new RowAction('Delete', 'card_delete', true, '_self');
        $grid->addRowAction($myRowAction);


        $form = $this->createForm(BonusCardsType::class, array());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();
            $this->get('app.generator')->generate($data);
        }


        return $grid->getGridResponse($request->isXmlHttpRequest() ? 'BonusCard/grid.html.twig' : 'default/index.html.twig',
            array('form' => $form->createView()));
    }


    
    
    
    
}
