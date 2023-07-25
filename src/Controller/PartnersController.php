<?php

namespace App\Controller;

use App\Entity\MembershipTypes;
use App\Entity\Partners;
use App\Entity\PaymentTypes;
use App\Form\MTFormType;
use App\Form\PartnersFormType;
use App\Form\PTFormType;
use App\Repository\MembershipTypesRepository;
use App\Repository\PartnersRepository;
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

class PartnersController extends BaseController
{
    /**
     * @param $
     */
    public function __construct( private PartnersRepository $PartnersRepository, private TranslatorInterface $translator, private EntityManagerInterface $entityManager)
    {
    }

    #[Route(path: '/admin/parametre/Partners/{Membership}', name: 'app_admin_partners')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function partners(string $Membership): Response
    {
        $partners = $this->PartnersRepository->findByMembership([intval($Membership) ]);
        return $this->render("admin/params/partners/partners.html.twig",["partners"=>$partners]);
    }

    #[Route(path: '/admin/parametre/Partners/new', name: 'app_admin_new_partners')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function newPartner(Request $request): Response
    {
        $form = $this->createForm(PartnersFormType::class, null, ['translator' => $this->translator]);
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
            return $this->redirectToRoute("app_admin_partners");

        }
        return $this->render("admin/params/partners/partnersform.html.twig",["Form"=>$form->createView()]);
    }

    #[Route(path: '/admin/user/parametre/Partners/{id}', name: 'app_admin_edit_partners')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function editPartners(Partners $appPT,Request $request): Response
    {
        $form = $this->createForm(PTFormType::class, $appPT, ['translator' => $this->translator]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $date = new DateTime();

            $immutable = DateTimeImmutable::createFromMutable( $date );

            $appPT = $form->getData();

            $this->entityManager->persist($appPT);
            $this->entityManager->flush();
            $this->addFlash("success","Partners modifié");
            return $this->redirectToRoute("app_admin_partners");

        }
        return $this->render("admin/params/partners/partnersform.html.twig",["Form"=>$form->createView()]);
    }


    #[Route(path: '/admin/parametre/Partners/changevalidite/{id}', name: 'app_admin_changevalidite_partners',methods: "POST")]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function activate(MembershipTypes $appPT): JsonResponse
    {
        $appPT->setValid(!$appPT->getValid());
        $this->entityManager->persist($appPT);
        $this->entityManager->flush();
        return $this->json(["message"=>"success","value"=>$appMT->getValid()]);
    }


    #[Route(path: '/admin/parametre/Partners/delete/{id}', name: 'app_admin_delete_partners')]
    #[IsGranted('ROLE_ADMINISTRATOR')]
    public function delete(PaymentTypes $appPT): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $appPT->setStatus(0);
        $this->entityManager->persist($appPT);
        $this->entityManager->flush();
        return $this->json(["message"=>"success","value"=>!$appPT->getStatus()]);
    }


    #[Route(path: '/admin/parametre/Partners/groupaction', name: 'app_admin_groupaction_partners')]
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
