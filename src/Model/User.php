<?php

namespace App\Model;

class User
{
    private int $id;

    private string $name;

    private string $surname;

    private string $email;

    private string $password;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        if (isset($this->name) AND !empty($this->name)) {
            return $this->name;
        } else {
            return NULL;
        }
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return ?string
     */
    public function getSurname(): ?string
    {
        if (isset($this->surname) AND !empty($this->surname)) {
            return $this->surname;
        } else {
            return NULL;
        }
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return ?string
     */
    public function getEmail(): ?string
    {
        if (isset($this->email) AND !empty($this->email)) {
            return $this->email;
        } else {
            return NULL;
        }
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return ?string
     */
    public function getPassword(): ?string
    {
        if (isset($this->password) AND !empty($this->password)) {
            return $this->password;
        } else {
            return NULL;
        }
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

     /**
     * @return ?bool
     */
    public function getIsEmploye(): ?bool
    {
        if(isset($this->isEmploye) AND !empty($this->isEmploye)) {
            return $this->isEmploye;
        } else {
            return NULL;
        }
    }

    /**
     * @param bool $isEmploye
     */
    public function setIsEmploye(bool $isEmploye): void
    {
        $this->isEmploye = $isEmploye;
    }

    /**
     * @return ?bool
     */
    public function getIsAdmin(): ?bool
    {
        if(isset($this->isAdmin) AND !empty($this->isAdmin)) {
            return $this->isAdmin;
        } else {
            return NULL;
        }
    }

    /**
     * @param bool $isAdmin
     */
    public function setIsAdmin(bool $isAdmin): void
    {
        $this->isAdmin = $isAdmin;
    }

}