<?php

include_once ('GenericDAO.php');

class LeadsDao extends GenericDAO {

    private static $instance;

    public static function getInstance() {

        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {
        ;
    }

    protected $table = 'leads';



    public function insert($lead) {
        try {
           $sql = "INSERT INTO $this->table (nome, whatsapp, email, cidade, data, status, curso_interesse, obs) 
           VALUE(:nome, :whatsapp, :email, 'Quixeramobim', (NOW()), 0, :curso_interesse, null)";

           $stmt = DB::prepare($sql);
           $stmt->bindValue(':nome',$lead['nome']);
           $stmt->bindValue(':whatsapp',$lead['whatsapp']);
           $stmt->bindValue(':email',$lead['email']);
           $stmt->bindValue(':curso_interesse',$lead['curso_interesse']);
           $stmt->execute();
           
           return true;
       
       } catch (Exception $ex) {
           $ex->getMessage();
           return false;
       }
   }

    public function update($lead) {
        try {
            $sql = "UPDATE $this->table SET nome = :nome, email = :email, cidade = :cidade, curso_interesse = :curso_interesse, whatsapp = :whatsapp WHERE id = :id";
            $stmt = DB::prepare($sql);
            $stmt->bindValue(':nome',$lead['nome']);
            $stmt->bindValue(':email',$lead['email']);
            $stmt->bindValue(':cidade',$lead['cidade']);
            $stmt->bindValue(':curso_interesse',$lead['curso_interesse']);
            $stmt->bindValue(':whatsapp',$lead['whatsapp']);
            $stmt->bindValue(':id',$lead['id']);
            $stmt->execute();
    
            return true;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return false;
        }
    }


    public function delete($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE id = :id";
            $stmt = DB::prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
    
            return true;
    
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return false;
        }
    }
   
}
