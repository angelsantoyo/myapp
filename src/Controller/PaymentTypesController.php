<?php

namespace App\Controller;

use App\Entity\MembershipTypes;
use App\Entity\PaymentTypes;
use App\Form\MTFormType;
use App\Form\PTFormType;
use App\Repository\MembershipTypesRepository;
use App\Repository\PaymentTypesRepository;
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

class PaymentTypesController extends BaseController
{
    /**
     * @param $
     */
    public function __construct(private PaymentTypesRepository $PaymentTypesRepository, private TranslatorInterface $translator, private EntityManagerInterface $entityManager)
    {
    }

    #[Route(path: '/admin/parametre/PT', name: 'app_admin_paymenttypes')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function paymenttypes(): Response
    {
        $paymenttyp = $this->PaymentTypesRepository->findAll();
        return $this->render("admin/params/paymentType/pt.html.twig",["paymenttypes"=>$paymenttyp]);
    }

    #[Route(path: '/admin/parametre/PT/new', name: 'app_admin_new_paymenttypes')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function newPT(Request $request): Response
    {
        $form = $this->createForm(PTFormType::class, null, ['translator' => $this->translator]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $date = new DateTime();

            $immutable = DateTimeImmutable::createFromMutable( $date );

            $appPT = $form->getData();
            $appPT->setStatus(true);
            $appPT->setUpdatedAt($immutable);
            $appPT->setCreatedAt($immutable);
            $this->entityManager->persist($appPT);
            $this->entityManager->flush();
            $this->addFlash("success","PT success");
            return $this->redirectToRoute("app_admin_paymenttypes");

        }
        return $this->render("admin/params/paymentType/ptform.html.twig",["Form"=>$form->createView()]);
    }

    #[Route(path: '/admin/user/parametre/PT/{id}', name: 'app_admin_edit_pt')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function editPT(PaymentTypes $appPT,Request $request): Response
    {
        $form = $this->createForm(PTFormType::class, $appPT, ['translator' => $this->translator]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $date = new DateTime();

            $immutable = DateTimeImmutable::createFromMutable( $date );

            $appPT = $form->getData();
            $appPT->setStatus(true);
            $appPT->setUpdatedAt($immutable);
            $this->entityManager->persist($appPT);
            $this->entityManager->flush();
            $this->addFlash("success","PT modifié");
            return $this->redirectToRoute("app_admin_paymenttypes");

        }
        return $this->render("admin/params/paymentType/ptform.html.twig",["Form"=>$form->createView()]);
    }


    #[Route(path: '/admin/parametre/PT/changevalidite/{id}', name: 'app_admin_changevalidite_pt',methods: "POST")]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function activate(MembershipTypes $appPT): JsonResponse
    {
        $appPT->setValid(!$appPT->getValid());
        $this->entityManager->persist($appPT);
        $this->entityManager->flush();
        return $this->json(["message"=>"success","value"=>$appMT->getValid()]);
    }


    #[Route(path: '/admin/parametre/PT/delete/{id}', name: 'app_admin_delete_pt')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function delete(PaymentTypes $appPT): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $appPT->setStatus(0);
        $this->entityManager->persist($appPT);
        $this->entityManager->flush();
        return $this->json(["message"=>"success","value"=>!$appPT->getStatus()]);
    }


    #[Route(path: '/admin/parametre/PT/groupaction', name: 'app_admin_groupaction_pt')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function groupAction(Request $request): JsonResponse
    {
        $action = $request->get("action");
        $ids = $request->get("ids");
        $faqs = $this->PaymentTypesRepository->findBy(["id"=>$ids]);
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
