<?php

class empresa
{
    private ?int $id;
    private string $nome;
    private string $razao_social;
    private string $cnpj;

    public function __construct(?int $id, string $nome, string $razao_social, string $cnpj)
    {
        $this->id = $id;
        $this->nome = $nome; 
        $this->razao_social = $razao_social;
        $this->cnpj = $cnpj;
    }
     
    //código omitido

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getRazaoSocial(): string
    {
        return $this->razao_social;
    }

    public function getCNPJ(): string
    {
        return $this->cnpj;
    }

    public function getCNPJPath(): string
    {
        return $this->cnpj;
    }



}