<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Repository\HotelRepository;
use App\Repository\ImageRepository;
use App\Repository\SettingRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    /**
     * @Route("/", name="home")
     */
    public function index(SettingRepository $settingRepository,HotelRepository $hotelRepository)
    {
        $setting=$settingRepository->findAll();
        $slider=$hotelRepository->findBy(['status'=>'True'],['title'=>'ASC'] ,3);
        $hotels=$hotelRepository->findBy(['status'=>'True'],['title'=>'DESC'] ,4);
        $newhotels=$hotelRepository->findBy(['status'=>'True'],['title'=>'DESC'] ,10);
        // array findBy(array $criteria, array $orderBy = null, int|null $limit = null, int|null $offset = null)
        //dump($slider);
        //die();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'setting'=>$setting,
            'slider'=>$slider,
            'hotels'=>$hotels,
            'newhotels'=>$newhotels,
        ]);
    }


    /**
     * @Route("/hotel/{id}", name="hotel_show", methods={"GET"})
     */
    public function show(Hotel $hotel,$id,ImageRepository $imageRepository): Response
    {
        $images=$imageRepository->findBy(['hotel'=>$id]);
//        $comments=$commentRepository->findBy(['hotelid'=>$id, 'status'=>'True']);
//        $rooms =$roomRepository->findBy(['hotelid'=>$id, 'status'=>'True']);

        return $this->render('home/hotelshow.html.twig', [
            'hotel' => $hotel,
            'images' => $images,
//            'rooms' => $rooms,
//            'comments' => $comments,
        ]);
    }
}
