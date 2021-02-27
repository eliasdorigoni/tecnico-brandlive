<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Customer;


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
    public function createAction()
    {
        return $this->render('customer-create.html.twig');
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

    public function storeAction()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $customer = new Customer();
        $customer->setFirstName('nombre');
        $customer->setLastName('apellido');
        $customer->setEmail('test@email.com');

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($customer);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
    }

    public function deleteAction()
    {
        // $entityManager->remove($product);
        // $entityManager->flush();
    }
}