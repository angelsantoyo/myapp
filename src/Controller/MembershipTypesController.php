<?php

namespace App\Controller;

use App\Entity\MembershipTypes;
use App\Form\MTFormType;
use App\Repository\MembershipTypesRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MembershipTypesController extends BaseController
{
    /**
     * @param $
     */
    public function __construct(private MembershipTypesRepository $MembershipTypesRepository,private EntityManagerInterface $entityManager)
    {
    }

    #[Route(path: '/admin/parametre/MT', name: 'app_admin_membershiptypes')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function membershiptypes(): Response
    {
        $memberstyp = $this->MembershipTypesRepository->findAll();
        return $this->render("admin/params/membertype/mt.html.twig",["membershtypes"=>$memberstyp]);
    }

    #[Route(path: '/admin/parametre/MT/new', name: 'app_admin_new_membershiptypes')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function newMT(Request $request): Response
    {
        $form = $this->createForm(MTFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /** @var  MembershipTypes $appMT */
            $appMT = $form->getData();
            $appMT->setValid(true)
                ->setDeleted(false);
            $this->entityManager->persist($appMT);
            $this->entityManager->flush();
            $this->addFlash("success","MT success");
            return $this->redirectToRoute("app_admin_membershiptypes");

        }
        return $this->render("admin/params/membertype/mtform.html.twig",["Form"=>$form->createView()]);
    }

    #[Route(path: '/admin/user/parametre/MT/{id}', name: 'app_admin_edit_mt')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function editMT(MembershipTypes $appMT,Request $request): Response
    {
        $form = $this->createForm(MTFormType::class,$appMT);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->entityManager->persist($appMT);
            $this->entityManager->flush();
            $this->addFlash("success","FAQ modifié");
            return $this->redirectToRoute("app_admin_membershiptypes");

        }
        return $this->render("admin/params/membertype/mtform",["Form"=>$form->createView()]);
    }


    #[Route(path: '/admin/parametre/MT/changevalidite/{id}', name: 'app_admin_changevalidite_mt',methods: "POST")]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function activate(MembershipTypes $appMT): JsonResponse
    {
        $appMT->setValid(!$appMT->getValid());
        $this->entityManager->persist($appMT);
        $this->entityManager->flush();
        return $this->json(["message"=>"success","value"=>$appMT->getValid()]);
    }


    #[Route(path: '/admin/parametre/MT/delete/{id}', name: 'app_admin_delete_mt')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function delete(MembershipTypes $appMT): JsonResponse
    {
        $appMT->setDeleted(true);
        $this->entityManager->persist($appMT);
        $this->entityManager->flush();
        return $this->json(["message"=>"success","value"=>$appMT->getDeleted()]);
    }


    #[Route(path: '/admin/parametre/MT/groupaction', name: 'app_admin_groupaction_mt')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function groupAction(Request $request): JsonResponse
    {
        $action = $request->get("action");
        $ids = $request->get("ids");
        $faqs = $this->MembershipTypesRepository->findBy(["id"=>$ids]);
        if ($action=="desactiver"){
            foreach ($faqs as $faq) {
                $faq->setValid(false);
                $this->entityManager->persist($faq);
            }
        }else if ($action=="activer"){
            foreach ($faqs as $faq) {
                $faq->setValid(true);
                $this->entityManager->persist($faq);
            }
        }else if ($action=="supprimer"){
            foreach ($faqs as $faq) {
                $faq->setDeleted(true);
                $this->entityManager->persist($faq);
            }
        }
        else{
            return $this->json(["message"=>"error"]);
        }
        $this->entityManager->flush();
        return $this->json(["message"=>"success","nb"=>count($faqs)]);
    }
}
