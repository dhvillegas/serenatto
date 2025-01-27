<?php

class EmpresaRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;

    }

    private function formarObjeto($dados)
    {
        return new Empresa($dados['client_id'],
            $dados['client_name'],
            $dados['razao_social'],
            $dados['cnpj']);
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM clients ORDER BY client_id";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = array_map(function ($empresa){
            return $this->formarObjeto($empresa);
        },$dados);

        return $todosOsDados;
    }

    public function salvar(empresa $empresa)
    {
        $sql = "INSERT INTO clients (client_name, razao_social, cnpj) VALUES (?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$empresa->getNome());
        $statement->bindValue(2,$empresa->getRazaoSocial());
        $statement->bindValue(3,$empresa->getCNPJ());
        $statement->execute();

    }

    public function buscar(int $id)
    {
        $sql = "SELECT * FROM clients WHERE client_id  = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$id);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);
        return $this->formarObjeto($dados);

    }

    public function atualizar(empresa $empresa)
    {
        $sql = "UPDATE clients SET client_name = ?, razao_social = ?, cnpj = ? WHERE client_id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getNome());
        $statement->bindValue(2, $produto->getRazaoSocial());
        $statement->bindValue(3, $produto->getCNPJ());
        $statement->bindValue(4, $produto->getId());
        $statement->execute();
    }
}
   



?>