<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Customer;
use App\Form\CustomerType;
use Symfony\Component\HttpFoundation\Request;


class CustomerController extends Controller
{
    /**
     * @Route("/{page}", name="home", requirements={"page"="\d+"}, )
     */
    public function indexAction($page = 1)
    {
        $customers = $this->getDoctrine()
            ->getRepository(Customer::class)
            ->findAll();

        return $this->render('customers-list.html.twig', compact('customers'));
    }

    /**
     * @Route("/customer/create", name="customer.create")
     */
    public function createAction(Request $request)
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($customer);
            $entityManager->flush();
            $this->addFlash('notice', 'Cliente creado correctamente!');

            return $this->redirectToRoute('home');
        }

        return $this->render('customer-create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/customer/{id}/edit", name="customer.edit", requirements={"id"="\d+"})
     */
    public function editAction($id)
    {
        $customer = $this->getDoctrine()
            ->getRepository(Customer::class)
            ->find($id);
        return $this->render('customer-edit.html.twig', compact('customer'));
    }

    public function deleteAction()
    {
        // $entityManager->remove($product);
        // $entityManager->flush();
    }
}