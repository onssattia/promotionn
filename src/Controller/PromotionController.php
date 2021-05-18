<?php

namespace App\Controller;

use App\Entity\Promotion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PromotionController extends AbstractController
{
     
    /**
    * @Route("/checkFlash", name="checkFlash_api", methods={"POST"})
    **/

   public function checkFlash(Request $request)
   {
       $id = $request->request->get('id');
    
       $repository = $this->getDoctrine()->getRepository(Promotion::class);
       $promotion = $repository->findOneBy(array('id' => $id));
       if (!empty($promotion)){
      $response = array(
        "code" => 0,
        "id" => $promotion->getId(),
        "iscoupon" => $promotion->getIsCoupon(),
        "errors" => null,
        
     );
     return new JsonResponse($response, Response::HTTP_OK);
           }
   else{
 $response = array(
        "code" => 1,
        "id" => $id,
        "errors" => 'sorry ,id not found',
        
     );
     return new JsonResponse($response, Response::HTTP_NOT_FOUND);
   }
   }
}
