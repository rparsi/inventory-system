<?php
/**
 * Created by PhpStorm.
 * User: rparsi
 * Date: 16/04/2016
 * Time: 1:11 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractAppController extends Controller
{
    /**
     * @return \Rahi\ApiBundle\Entity\Account\User|null
     */
    public function getLoggedInUser()
    {
        // refer to http://symfony.com/doc/current/book/security.html#checking-to-see-if-a-user-is-logged-in-is-authenticated-fully
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return null;
        }
        return $this->getUser();
    }

    /**
     * @return \JMS\Serializer\Serializer
     */
    public function getSerializer()
    {
        /** @var \JMS\Serializer\Serializer $serializer */
        return $this->get('jms_serializer');
    }

    /**
     * @param mixed $data
     * @return Response
     */
    public function createJsonResponse($data)
    {
        return new Response($this->getSerializer()->serialize($data, 'json'), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->getDoctrine()->getManager();
    }
}