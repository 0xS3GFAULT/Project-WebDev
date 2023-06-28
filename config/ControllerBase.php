<?php

namespace Config;

use AltoRouter;
use App\Model\User;
use App\Repository\UserRepository;
use Exception;

class ControllerBase extends Env
{

    protected AltoRouter $router;

    protected UserRepository $userRepository;

     public function __construct(AltoRouter $router)
    {
        parent::__construct();
        $this->router = $router;
        $this->userRepository = new UserRepository();
    }

    /**
     * @throws Exception
     */
    protected function render(string $name, array $args = [])
    {
        $class = str_split($name, strpos($name, "::"));
        $function = str_replace("::", "", $class[1]);
        if (class_exists($class[0])) {
            $controller = new $class[0]();
            if (method_exists($class[0], $function)) {
                $controller->$function($args);
            } else {
                throw new Exception('The method ' . $class[1] . 'does not exist');
            }
        } else {
            throw new Exception('The class ' . $class[0] . 'does not exist');
        }
    }

    protected function user(): ?User
    {
        if(isset($_SESSION['id']) AND !empty($_SESSION['id']) AND $_SESSION['id'] > 0) {
            return $this->userRepository->getUser(["id" => $_SESSION['id']]);
        } else {
            return NULL;
        }
    }

    /**
     * @throws Exception
     */
    protected function sendEmail(string $name, array $args = [])
    {
        $class = str_split($name, strpos($name, "::"));
        $function = str_replace("::", "", $class[1]);
        if (class_exists($class[0])) {
            $controller = new $class[0]();
            if (method_exists($class[0], $function)) {
                $header = "From: " . $this->get('NAME') ."<" .$this->get('MAIL_FROM') . ">\n";
                if($cc = $this->get('MAIL_CC') !== null) {
                    $header .= "Cc: " . $cc . "\n";
                }
                if($bcc = $this->get('MAIL_BCC') !== null) {
                    $header .= "Bcc: " . $bcc . "\n";
                }
                mail($args['to'], $args['subject'], $controller->$function($args), $header );
            } else {
                throw new Exception('The method ' . $class[1] . ' does not exist');
            }
        } else {
            throw new Exception('The class ' . $class[0] . ' does not exist');
        }
    }
}