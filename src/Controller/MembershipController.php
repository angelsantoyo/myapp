<?php

namespace App\Controller;

use App\Entity\Memberships;
use App\Entity\Partners;
use App\Form\MembershipForm;
use App\Form\MembershipFormType;
use App\Repository\MembershipsRepository;
use App\Repository\PartnersRepository;
use Doctrine\ORM\EntityManagerInterface;

use Monolog\DateTimeImmutable;
use RectorPrefix202305\Nette\Utils\DateTime;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

class MembershipController extends BaseController
{
    /**
     * @param PartnersRepository $partnersRepository
     * @param MembershipsRepository $MembershipsRepository
     * @param TranslatorInterface $translator
     * @param EntityManagerInterface $entityManager
     */
    public function __construct( private MembershipsRepository $MembershipsRepository, private TranslatorInterface $translator, private EntityManagerInterface $entityManager)
    {
    }

    #[Route(path: '/admin/parametre/Membership', name: 'app_admin_membership')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function membership(): Response
    {
        $memberstyp = $this->MembershipsRepository->findAll();

        return $this->render("admin/params/membership/membership.html.twig",["memberships"=>$memberstyp]);
    }

    #[Route(path: '/admin/parametre/Membership/new', name: 'app_admin_new_membership')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function newMembership(Request $request): Response
    {
        $form = $this->createForm(MembershipFormType::class, null, ['translator' => $this->translator]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $date = new DateTime();

            $immutable = DateTimeImmutable::createFromMutable( $date );

            $appMembership = $form->getData();
            $appMembership->setStatus(true);
            $appMembership->setUpdatedAt($immutable);
            $appMembership->setCreatedAt($immutable);
            $this->entityManager->persist($appMembership);
            $this->entityManager->flush();
            $this->addFlash("success","Membership success");
            return $this->redirectToRoute("app_admin_membership");

        }
        return $this->render("admin/params/membership/membershipform.html.twig",["Form"=>$form->createView()]);
    }

    #[Route(path: '/admin/user/parametre/Membership/{id}', name: 'app_admin_edit_membership')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function editMembership(Memberships $appMembership,Request $request): Response
    {
        $form = $this->createForm(MembershipForm::class, $appMembership, ['translator' => $this->translator]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $date = new DateTime();

            $immutable = DateTimeImmutable::createFromMutable( $date );

            $appMembership = $form->getData();
            $appMembership->setStatus(true);
            $appMembership->setUpdatedAt($immutable);
            $this->entityManager->persist($appMembership);
            $this->entityManager->flush();
            $this->addFlash("success","Membership modifié");
            return $this->redirectToRoute("app_admin_membership");

        }
        return $this->render("admin/params/membership/membershipform.html.twig",["Form"=>$form->createView()]);
    }


    #[Route(path: '/admin/parametre/Membership/changevalidite/{id}', name: 'app_admin_changevalidite_membership',methods: "POST")]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function activate(Memberships $appMembership): JsonResponse
    {
        $appMembership->setMembershipNumber(!$appMembership->getMembershipNumber());
        $this->entityManager->persist($appMT);
        $this->entityManager->flush();
        return $this->json(["message"=>"success","value"=>$appMembership->getMembershipNumber()]);
    }


    #[Route(path: '/admin/parametre/Membership/delete/{id}', name: 'app_admin_delete_membership')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function delete(Memberships $appMembership): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $appMembership->setStatus(0);
        $this->entityManager->persist($appMembership);
        $this->entityManager->flush();
        return $this->json(["message"=>"success","value"=>!$appMembership->getState()]);
    }


    #[Route(path: '/admin/parametre/Membership/groupaction', name: 'app_admin_groupaction_membership')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function groupAction(Request $request): JsonResponse
    {
        $action = $request->get("action");
        $ids = $request->get("ids");
        $faqs = $this->MembershipsRepository->findBy(["id"=>$ids]);
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
