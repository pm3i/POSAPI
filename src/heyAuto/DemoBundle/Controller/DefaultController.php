<?php

namespace heyAuto\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
	/**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
	{
		return $this->aboutAction();
	}
    
    /**
     * @Route("/about")
     * @Template()
     */
    public function aboutAction()
    {
    	$filename = "../.buildpath";
    	$lastModified = "Unknown";
    	if (file_exists($filename)) {
    		$lastModified = date ("F d Y H:i:s.", filemtime($filename))." ".$filename;
    	} 
    	return $this->render('heyAutoDemoBundle:Default:about.html.twig', array('lastModified' => $lastModified));
    }
    
}
