<?php

class UsuarioRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;

    }

    private function formarObjeto($dados)
    {
        return new Usuario($dados['user_id'],
            $dados['username'],
            $dados['password'],
            $dados['user_name'],
            $dados['user_email'],
            $dados['user_phone'],
            $dados['user_admin'],
            $dados['client_id']);
    }

    
    public function buscarTodos()
    {
        $sql = "SELECT * FROM users ORDER BY user_id";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = array_map(function ($usuario){
            return $this->formarObjeto($usuario);
        },$dados);

        return $todosOsDados;
    }

    public function deletar(int $id)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindvalue(1,$id);
        $statement->execute();
    }

    public function salvar(usuario $usuario)
    {
        $sql = "INSERT INTO users (username, password, user_name, user_email, user_phone, user_admin, client_id) VALUES (?,?,?,?,?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$usuario->getUsername());
        $statement->bindValue(2,$usuario->getPassword());
        $statement->bindValue(3,$usuario->getNome());
        $statement->bindValue(4,$usuario->getEmail());
        $statement->bindValue(5,$usuario->getPhone());
        $statement->bindValue(6,$usuario->getAdmin());
        $statement->bindValue(7,$usuario->getEmpresa());
        $statement->execute();

    }
   
    public function buscar(int $id)
    {
        $sql = "SELECT * FROM users WHERE user_id  = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$id);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);
        return $this->formarObjeto($dados);

    }

    public function atualizar(usuario $usuario)
    {
        $sql = "UPDATE users SET user_name = ?, user_email = ?, user_phone = ?, user_admin = ?, client_id = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $usuario->getNome());
        $statement->bindValue(2, $usuario->getEmail());
        $statement->bindValue(3, $usuario->getPhone());
        $statement->bindValue(4, $usuario->getAdmin());
        $statement->bindValue(5, $usuario->getEmpresa());
        $statement->bindValue(6, $usuario->getId());
        $statement->execute();
    }

    public function checalogin(string $email, string $password)
    {
        $sql = "SELECT * FROM users WHERE user_email = ? AND password = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $email);
        $statement->bindValue(2, $password);
        $statement->execute();


        $dados = $statement->fetch(PDO::FETCH_ASSOC);
        return $this->formarObjeto($dados);

    }

}
   

?>