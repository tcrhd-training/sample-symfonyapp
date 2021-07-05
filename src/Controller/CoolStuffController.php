<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoolStuffController extends AbstractController
{
    /**
     * @Route("/{name}", name="cool_stuff")
     */
    public function index(string $name = "guest"): Response
    {   
        $crawler = new Crawler();
        $crawler->addXmlContent(
            file_get_contents(
                'https://www.bnr.ro/nbrfxrates.xml'
            )
        );
    
        $eurRate = $crawler->filterXPath('//default:DataSet/default:Body/default:Cube/default:Rate[@currency="EUR"]/text()')->text();

        return $this->render('cool_stuff/index.html.twig', [
            'name' => $name,
            'login' => true,
            'eurRate' => $eurRate
        ]);
    }

    /**
     * @Route("/cool/stuff2", name="cool_stuff2")
     */
    public function index2(Request $request): Response
    {
        $name = $request->get('name', 'guest');

        $routePath = $this->container->get('router')->generate('cool_stuff', ['name'=>$name]);
        
        return $this->render('cool_stuff/index.html.twig', [
            'name' => $name,
            'routePath' => $routePath,
            'login' => false
        ]);
    }
}
