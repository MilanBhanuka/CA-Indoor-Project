<?php 
  class M_Complaint{
    private $db;
    public function __construct() {
        $this->db = new Database();
    }
public function create($data){
        $this->db->query('INSERT INTO complaint (user_id,name,email,message) VALUES(:user_id,:name,:email,:message)') ;
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':user_id',$_SESSION['user_id']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':message',$data['message']);

       

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
        




    }
    public function getComplaints(){
        $this->db->query('SELECT * FROM complaint');

        return $this->db->resultset();
    }
}
  
?>