<?php
class M_Bookings
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function Booking_Register($data)
    {
        $this->db->query('INSERT INTO reservation (name, email, date, net, timeSlot, phoneNumber, coach) VALUES (:name, :email, :date, :net, :timeSlot, :phoneNumber, :coach)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':net', $data['net']);
        $this->db->bind(':timeSlot', $data['timeSlot']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':coach', $data['coach']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function findBooking($date, $timeSlot, $net)
    {
        $this->db->query('SELECT * FROM reservation WHERE date = :date && timeSlot = :timeSlot && net = :net');
        $this->db->bind(':date', $date);
        $this->db->bind(':timeSlot', $timeSlot);
        $this->db->bind(':net', $net);


        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function deleteBooking($reservation__Id){
        $this->db->query('DELETE FROM reservation WHERE reservation_Id=:reservation_Id');
        $this->db->bind(':reservation_Id', $reservation__Id);

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }


}
?>