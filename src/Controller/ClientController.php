<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
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

    #[Route('/clients/{id}', name: "client_show")]
    public function show(Client $client): Response
    {
        return $this->render('client/show.html.twig', [
            "client" => $client
        ]);
    }
}
