<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    // will be moved to ControllerHelperTrait trait
    public function getLoggedInUser()
    {
        // refer to http://symfony.com/doc/current/book/security.html#checking-to-see-if-a-user-is-logged-in-is-authenticated-fully
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return null;
        }
        return $this->getUser();
    }

    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function homeAction(Request $request)
    {
        $mailerSettings = [
            'mailer_transport' => $this->getParameter('mailer_transport'),
            'mailer_host' => $this->getParameter('mailer_host'),
            'mailer_port' => $this->getParameter('mailer_port'),
            'mailer_user' => $this->getParameter('mailer_user'),
            'mailer_password' => $this->getParameter('mailer_password')
        ];
        return $this->render('default/home.html.twig', ['user' => $this->getLoggedInUser(), 'mailerSettings' => $mailerSettings]);
    }

    /**
     * @Route("/jsontest", name="jsontest")
     */
    public function jsonTestAction(Request $request)
    {
        $data = ['foobar' => true, 'version' => 1];
        $response = new JsonResponse();
        $response->setData($data);
        return $response;
    }

    /**
     * @Route("/emailtest", name="emailtest")
     */
    public function emailTestAction(Request $request)
    {
        $emailData = [
            'subject' => 'Email test',
            'from' => 'send@example.com',
            'to' => 'recipient@example.com'
        ];

        $htmlBody = $this->renderView('default/email/test.html.twig', ['emailData' => $emailData]);
        $textBody = $this->renderView('default/email/test.text.twig', ['emailData' => $emailData]);

        $message = \Swift_Message::newInstance()
            ->setSubject($emailData['subject'])
            ->setFrom($emailData['from'])
            ->setTo($emailData['to'])
            ->setBody($htmlBody, 'text/html')
            ->addPart($textBody, 'text/plain');

        // Create the Transport
        $customTransport = \Swift_SmtpTransport::newInstance($this->getParameter('mailer_host'), $this->getParameter('mailer_port'))
            ->setUsername(null)
            ->setPassword(null);

        $mailer = \Swift_Mailer::newInstance($customTransport);
        $numEmailsSent = $mailer->send($message);
        return $this->render('default/emailtest.html.twig', ['user' => null, 'email' => $emailData, 'numEmailsSent' => $numEmailsSent]);
    }

    /**
     * @Route("/datatest", name="datatest")
     */
    public function dataTestAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('RahiApiBundle:Account\Company\CompanyType');
        $companyTypes = $repository->findAll();
        $data = [];
        foreach ($companyTypes as $companyType) {
            $key = 'id_' . $companyType->id;
            $data[$key] = [
                'id' => $companyType->id,
                'name' => $companyType->name,
                'slug' => $companyType->slug
            ];
        }
        return new JsonResponse($data);
    }
}
