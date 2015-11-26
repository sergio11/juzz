<?php

namespace juzz\CommentsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommentsController extends Controller
{
    public function commentsWallAction($target)
    {
    	$comments = array();
        return $this->render('juzzCommentsBundle:Default:comments-wall.html.twig',array(
        	'comments' => $comments
        ));
    }
}
