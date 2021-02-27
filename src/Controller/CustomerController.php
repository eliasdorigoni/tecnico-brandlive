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
    public function indexAction($page = 1, Request $request)
    {
        $query = $this->getDoctrine()->getManager()->createQuery('SELECT a FROM App:Customer a');
        $paginator  = $this->get('knp_paginator');
        $perPage = 10;
        $pagination = $paginator->paginate($query, (int) $page, $perPage);
        $pagination->setTemplate('partials/pagination.html.twig');

        return $this->render('customers-list.html.twig', compact('pagination'));
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
    public function editAction($id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $customer = $entityManager->getRepository(Customer::class)->find((int) $id);

        if (!$customer) {
            throw $this->createNotFoundException('El cliente ' . $id . ' no existe');
        }

        $form = $this->createForm(CustomerType::class, $customer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($customer);
            $entityManager->flush();
            $this->addFlash('notice', 'Cliente editado.');
        }

        return $this->render('customer-edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function deleteAction()
    {
        // $entityManager->remove($product);
        // $entityManager->flush();
    }
}