<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ClientController extends AbstractController
{
    #[Route('/clients', name: 'client_index')]
    public function index(ClientRepository $clientRepository): Response
    {
        $clients = $clientRepository->findAll();
        return $this->render('client/index.html.twig', [
            "clients" => $clients
        ]);
    }

    #[Route('/clients/search', name: "client_search")]
    public function search(ClientRepository $clientRepository, Request $request): Response
    {
        $companyName = $request->query->get("name");
        $clients = $clientRepository->findByCompanyName($companyName);
        return $this->render('client/index.html.twig', [
            "clients" => $clients
        ]);
    }

    #[Route('/clients/new', name: 'client_new')]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($client);
            $entityManager->flush();
            // On peut aussi importer ClientRepository et
            // $clientRepository->save($client);
            return $this->redirectToRoute('client_index');
        }

        return $this->render('client/new.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }

    #[Route('/clients/{id}/invoices', name: "client_invoices")]
    public function showInvoices(Client $client): Response
    {
        return $this->render("client/invoices.html.twig", [
            "client" => $client
        ]);
    }

    #[Route('/clients/{id}', name: "client_show")]
    public function show(Client $client): Response
    {
        return $this->render('client/show.html.twig', [
            "client" => $client
        ]);
    }
}
