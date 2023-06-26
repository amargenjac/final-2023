<?php
require_once "BaseDao.php";

class FinalDao extends BaseDao {

    public function __construct(){
        parent::__construct();
    }

    /** TODO
    * Implement DAO method used login user
    */
    public function login($email){          
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->get_connection()->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** TODO
    * Implement DAO method used add new investor to investor table and cap-table
    */
    public function investor(){
        $query = "SELECT * FROM investors";
        $stmt = $this->get_connection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** TODO
    * Implement DAO method to return list of all share classes from share_classes table
    */
    public function share_classes(){

    }

    /** TODO
    * Implement DAO method to return list of all share class categories from share_class_categories table
    */
    public function share_class_categories(){

    }
}
?>
