<?php

class usuario
{
    private ?int $id;
    private string $username;
    private string $password;
    private string $nome;
    private string $email;
    private string $phone;
    private bool $admin;
    private int $client_id;



    public function __construct(?int $id, string $username, string $password, string $nome, string $email, string $phone, bool $admin, int $client_id)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->nome = $nome; 
        $this->email = $email;
        $this->phone = $phone;
        $this->admin = $admin;
        $this->client_id = $client_id;
    }
     
    //código omitido

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getAdmin(): bool
    {
        return  $this->admin;
    }

    public function getEmpresa(): int
    {
        return $this->client_id;
    }



}