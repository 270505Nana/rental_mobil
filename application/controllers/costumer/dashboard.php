<?php
class Dashboard extends CI_Controller{

    public function index(){
        
        $data['mobil'] = $this->rental_models->get_data('mobil')->result();

        $this->load->view('templates_costumer/header');
        $this->load->view('costumer/dashboard',$data);
        $this->load->view('templates_costumer/footer');
    }
}
?>