<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;


class BonusCardController extends Controller
{

    /**
     * @Route("/bonus-card/show/{id}", name="card_show")
     */
    public function showAction($id, Request $request)
    {
        if (!$id) {
            throw $this->createNotFoundException('No BonusCard found');
        }

        $em = $this->getDoctrine()->getRepository('AppBundle:BonusCard');
        $bonusCard = $em->findOneByIdJoinedToBonusCardHistory($id);

        $purchasesAmount = 0;
        $lastUsage = null;
        foreach($bonusCard->getHistory() as $item) {
            $purchasesAmount += $item->getProductPrice();
            if($item->getDate() > $lastUsage) {
                $lastUsage = $item->getDate();
            } 
        }
        $bonusCard->lastUsage = $lastUsage;
        $bonusCard->purchasesAmount = $purchasesAmount;
        
        return $this->render('BonusCard/showProfile.html.twig', array(
            'bonus_card' => $bonusCard,
        ));
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
        $bonusCard = $em->find('AppBundle:BonusCard',$id);
        
        if( $bonusCard ) {

            $em->remove($bonusCard);
            $em->flush();

            $this->addFlash(
                'notice',
                'Bonus Card ID: '.$id." has been deleted."
            );

            return $this->redirect($request->headers->get('referer'));
        }
        else {
            throw $this->createNotFoundException('No BonusCard found');
        }

    }
    
    /**
     * @Route("/bonus-card/toggle/{id}.json", name="card_toggle")
     */
    public function toggleAction($id, Request $request)
    {
        if (!$id) {
            throw $this->createNotFoundException('No BonusCard found');
        }

        $em = $this->getDoctrine()->getManager();
        $bonusCard = $em->find('AppBundle:BonusCard',$id);

        if( $bonusCard ) {

            $status = $bonusCard->getStatus();
            if ($status != 'expired') {
                $status = ($bonusCard->getStatus() == 'active') ? 'inactive' : 'active';
                $bonusCard->setStatus($status);
                $em->flush();
            }
            
            $response = new JsonResponse();
            $response->setData(array(
                'id' => $id,
                'status' => $status
            ));

            return $response;
        }
        else {
            throw $this->createNotFoundException('No BonusCard found');
        }
    }





}
