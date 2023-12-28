<?php
include("connection.php");
include("clientsoop.php");


class eclientsDAO {
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function get_clients(){
        $query = "SELECT * FROM clients ";
        $stmt = $this->db->query($query);
        $stmt -> execute();
        $clientsData = $stmt->fetchAll();
        $clients= array();
        foreach ($clientsData as $P) {
            $clients[] = new clients($P["adresse"],$P["email"],$P["full_name"],$P["password"],$P["phone"],$P["username"],$P["ville"]
            );
        }
        return $clients;

    }
    public function insert_clients($clients)
    {
        $query = "INSERT INTO clients(adresse, email, full_name, password, phone, username, ville) 
                  VALUES (:idEn, ;img, :nameEn, :full_name, :password, :phone, :username, :ville)";

        $stmt = $this->db->prepare($query);

        $name = $clients->getadresse();
        $name = $clients->getemail();
        $name = $clients->getfull_name();
        $name = $clients->getpassword();
        $name = $clients->getphone();
        $name = $clients->getusername();
        $name = $clients->getville();
        
       
        

        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':ville', $ville);
        


        try {
            $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }
       
}
public function update_entreprise($entreprise)
    {
        $query = "UPDATE entreprise SET 
                  idEn = :idEn, 
                  img = :img,
                  nameEn = :nameEn,
                  WHERE idEn = :idEn";

        $stmt = $this->db->prepare($query);

        $name = $entreprise->getidEn();
        $name = $entreprise->getimg();
        $name = $entreprise->getnameEn();
       

        $stmt->bindParam(':idEn', $idEn);
        $stmt->bindParam(':img', $img);
        $stmt->bindParam(':nameEn', $nameEn);

       

        try {
            $stmt->execute();
            echo "Record updated successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function delete_entreprise($id)
    {
        $query = "UPDATE entreprise WHERE name = :idEn";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':idEn', $id);

        try {
            $stmt->execute();
            echo "Record deleted successfully.";
        } catch (PDOException $e) {
            throw $e;
        }
    }
}

?>