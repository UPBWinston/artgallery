<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\ArtRepository;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use GuzzleHttp\Promise\Is;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Doctrine\Common\Collections\Criteria;
use Psr\Log\LoggerInterface;


#[Route('/order')]
class OrderController extends AbstractController
{
    #[Route('/', name: 'app_order_index', methods: ['GET'])]
    public function index(OrderRepository $orderRepository, LoggerInterface $logger): Response
    {
        $ordersToShow = [];
        if (in_array('ROLE_CUSTOMER', $this->getUser()->getRoles(), true)){
            foreach ($orderRepository->findAll() as $order){
                if($order->getUser()->getUsername() == $this->getUser()->getUserIdentifier()){
                    $ordersToShow[] = $order;
                }
            }
        }else{
            $ordersToShow = $orderRepository->findAll();
        }

        return $this->render('order/index.html.twig', [
            'orders' => $ordersToShow,
            'userRoles' => $this->getUser()->getRoles(),
        ]);
    }

    #[Route('/new', name: 'app_order_new', methods: ['GET'])]
    #[IsGranted('ROLE_CUSTOMER')]
    public function new(Request $request, OrderRepository $orderRepository, ArtRepository $artRepository, UserRepository $userRepository, LoggerInterface $logger): Response
    {
        $order = new Order();
        $findUserByUsername = new Criteria();
        $findUserByUsername->where(Criteria::expr()->eq('username', $this->getUser()->getUserIdentifier()));
        $order->setUser($userRepository->matching($findUserByUsername)[0]);
        $order->setArt($artRepository->find($_GET['artId']));
        $order->setStatus('Active');

        $orderRepository->save($order, true);
        return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/approve', name: 'app_order_approve', methods: ['GET'])]
    #[IsGranted('ROLE_SALES')]
    public function approve(OrderRepository $orderRepository): Response
    {
        $order = $orderRepository->find($_GET['id']);
        $order->setStatus('Approved');
        $orderRepository->save($order, flush: true);
        return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/reject', name: 'app_order_reject', methods: ['GET'])]
    #[IsGranted('ROLE_SALES')]
    public function reject(OrderRepository $orderRepository): Response
    {
        $order = $orderRepository->find($_GET['id']);
        $order->setStatus('Rejected');
        $orderRepository->save($order, flush: true);
        return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/cancel', name: 'app_order_cancel', methods: ['GET'])]
    public function cancel(OrderRepository $orderRepository, LoggerInterface $logger): Response
    {
        $order = $orderRepository->find($_GET['id']);
        $order->setStatus('Canceled');
        $orderRepository->save($order, flush: true);
        return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
    }
}
