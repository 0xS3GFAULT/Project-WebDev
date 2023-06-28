<?php

namespace App\Controller;

use AltoRouter;
use App\Model\User;
use Config\ControllerBase;
use Exception;

class AuthController extends ControllerBase
{
    public function __construct(AltoRouter $altoRouter) {
        parent::__construct($altoRouter);
    }
    /**
     * @throws Exception
     */
    public function signup(): void
    {
        if (isset($_POST["password"]) && isset($_POST["email"])) {
            $name = htmlspecialchars($_POST['firstname']);
            $surname = htmlspecialchars($_POST['lastname']);
            $email = htmlspecialchars($_POST["email"]);
            $psw1 = htmlspecialchars($_POST["password"]);
            $psw2 = htmlspecialchars($_POST["confirm_password"]);

            if ($this->userRepository->getUser(["email" => $email]) instanceof User) {
                header("Location: " . $this->router->generate("login"));
            } else {
                if ($psw1 == $psw2) {
                    $psw1 = password_hash($psw1, PASSWORD_DEFAULT);
                    $this->userRepository->createUser($name, $surname, $email, $psw1,0, 0);
                    header("Location: " . $this->router->generate("login"));
                } else {
                    $message = "Not the same password";
                }
            }
        }
        $this->render("App\View\Auth::signup", [[$this->router], $this->user(), $message ?? NULL]);
    }

    /**
     * @throws Exception
     */
    public function login(): void
    {
        if (isset($_POST['submit'])) {
            $email = htmlspecialchars($_POST["email"]);
            $psw = htmlspecialchars($_POST["password"]);

            $user = $this->userRepository->getUser(["email" => $email]);
            if ($user != NULL) {
                if (password_verify($psw, $user->getPassword())) {
                    $_SESSION["id"] = $user->getId();
                    header("Location: " . $this->router->generate("home"));
                } else {
                    $message = "Wrong password";
                }
            } else {
                $message = "User not found";
            }
        }
        $this->render("App\View\Auth::login", [[$this->router], $this->user(), $message ?? null]);
    }

    /**
     * @throws Exception
     */
    public function logout(): void
    {
        session_destroy();
        header("Location: " . $this->router->generate("home"));
    }

    /**
     * @throws Exception
     */
    public function forgotPassword(): void {
        if (isset($_POST["submit"])) {
            $email = htmlspecialchars($_POST["email"]);
            $user = $this->userRepository->getUser(["email" => $email]);
            if ($user instanceof User) {
                $newPassword = $this->userRepository->generatePassword();
                $user->setPassword(password_hash($newPassword, PASSWORD_DEFAULT));
                $this->userRepository->updateUser($user);
                $this->sendEmail("App\Templates\Emails\MotDePasse::index", ["name" => $user->getName(), "email" => $user->getEmail(), "password" => $newPassword, "url" => $this->router->generate('login')]);
                header("Location: " . $this->router->generate("login"));
            }
        }
        $this->render("App\View\Auth::forgotPassword", [[$this->router], $this->user()]);
    }
}