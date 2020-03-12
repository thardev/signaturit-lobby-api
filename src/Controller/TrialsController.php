<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Trial;

class TrialsController extends AbstractController
{
    public function index(Request $request)
    {	
    	$parties = json_decode($request->getContent());
    	$trial = new Trial($parties);
    	$result = $trial->calculateTrial();
        return $this->json(['winner' => $result]);
    }
}
