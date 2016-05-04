<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\FormBuilderInterface;


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



        $defaultData = array('message' => 'Type your message here');
        $form = $this->createFormBuilder($defaultData)
            ->add('series', TextType::class)
            ->add('expInterval', SelectType::class)
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
        }



        return $grid->getGridResponse($request->isXmlHttpRequest() ? 'BonusCard/grid.html.twig' : 'default/index.html.twig',
            array('form' => 1));
    }


    
    
    
    
}
