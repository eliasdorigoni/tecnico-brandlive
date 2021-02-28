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
        $searchQuery = $request->query->get('q');
        $searchColumn = $request->query->get('in');
        if (!in_array($searchColumn, ['lastName', 'firstName', 'email'])) {
            $searchColumn = 'lastName';
        }


        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery('SELECT a FROM App:Customer a');

        if (!is_null($searchQuery)) {
            $query = $query
                ->where('a.' . $searchColumn . ' LIKE :search')
                ->setParameter('search', $searchQuery);
        }

        $paginator  = $this->get('knp_paginator');
        $perPage = 10;
        $pagination = $paginator->paginate($query, (int) $page, $perPage);
        $pagination->setTemplate('partials/pagination.html.twig');

        return $this->render('customers-list.html.twig', compact(
            'pagination',
            'searchQuery',
            'searchColumn'
        ));
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

    /**
     * @Route("/customer/remove", name="customer.remove", requirements={"id"="\d+"})
     */
    public function removeAction(Request $request)
    {
        (int) $id = $request->request->get('id');

        $entityManager = $this->getDoctrine()->getManager();
        $customer = $entityManager->getRepository(Customer::class)->find($id);

        if (!$customer) {
            throw $this->createNotFoundException('El cliente ' . $id . ' no existe');
        }

        $entityManager->remove($customer);
        $entityManager->flush();
        $this->addFlash('notice', 'Cliente eliminado (ID ' . $id . ')');
        return $this->redirectToRoute('home');
    }
}