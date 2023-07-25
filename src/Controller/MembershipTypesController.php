<?php

namespace App\Controller;

use App\Entity\MembershipTypes;
use App\Form\MTFormType;
use App\Repository\MembershipTypesRepository;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;

use Monolog\DateTimeImmutable;
use RectorPrefix202305\Nette\Utils\DateTime;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Contracts\Translation\TranslatorInterface;

class MembershipTypesController extends BaseController
{
    /**
     * @param $
     */
    public function __construct(private MembershipTypesRepository $MembershipTypesRepository, private TranslatorInterface $translator, private EntityManagerInterface $entityManager)
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
        $form = $this->createForm(MTFormType::class, null, ['translator' => $this->translator]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $date = new DateTime();

            $immutable = DateTimeImmutable::createFromMutable( $date );

            $appMT = $form->getData();
            $appMT->setStatus(true);
            $appMT->setUpdatedAt($immutable);
            $appMT->setCreatedAt($immutable);
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
        $form = $this->createForm(MTFormType::class, $appMT, ['translator' => $this->translator]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $date = new DateTime();

            $immutable = DateTimeImmutable::createFromMutable( $date );

            $appMT = $form->getData();
            $appMT->setStatus(true);
            $appMT->setUpdatedAt($immutable);
            $this->entityManager->persist($appMT);
            $this->entityManager->flush();
            $this->addFlash("success","MT modifié");
            return $this->redirectToRoute("app_admin_membershiptypes");

        }
        return $this->render("admin/params/membertype/mtform.html.twig",["Form"=>$form->createView()]);
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
    public function delete(MembershipTypes $appMT): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $appMT->setStatus(0);
        $this->entityManager->persist($appMT);
        $this->entityManager->flush();
        return $this->json(["message"=>"success","value"=>!$appMT->getStatus()]);
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
