<?php
class data_tipe extends CI_Controller{

    public function index(){

        $data['tipe'] = $this->rental_models->get_data('tipe')->result();
        
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/data_tipe',$data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_tipe_nana(){

        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/tambah_data_tipe');
        $this->load->view('templates_admin/footer');
    }

    public function tambah_tipe_aksi_nana(){

        $this->_rules();

        if($this->form_validation->run() == FALSE){
            $this->tambah_tipe_nana();
        }else{
             $kode_tipe        = $this->input->post('kode_tipe');
             $nama_tipe        = $this->input->post('nama_tipe');
            
             $data=array(

                 'kode_tipe' => $kode_tipe,
                 'nama_tipe' => $nama_tipe,
             );
             
             $this->rental_models->insert_data($data, 'tipe');
             $this->session->set_flashdata('pesan','
             <div class="alert alert-success alert-dismissible fade show" role="alert">
                     <strong> Data Berhasil ditambahkan! </strong>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>');
             redirect ('admin/data_tipe');

            }
            
    }

    public function update_tipe_nana($id){
        
        $where = array('id_tipe' => $id);
        $data['tipe'] = $this->db->query("SELECT * FROM tipe WHERE id_tipe='$id'")->result();

        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/update_data_tipe',$data);
        $this->load->view('templates_admin/footer');
    }

    public function update_tipe_aksi_nana(){

        $this->_rules();
       
       if($this->form_validation->run() == FALSE){
           $this->update_tipe();
       }else{
           $id                = $this->input->post('id_tipe');
           $kode_tipe         = $this->input->post('kode_tipe');
           $nama_tipe         = $this->input->post('nama_tipe');
           
            
           $data = array(
               'kode_tipe'       =>$kode_tipe,
               'nama_tipe'       =>$nama_tipe
           );
           $where = array(
               'id_tipe' => $id
           );

           $this->rental_models->update_data('tipe',$data, $where);
           $this->session->set_flashdata('pesan','
           <div class="alert alert-success alert-dismissible fade show" role="alert">
                   <strong> Data Berhasil diupdate! </strong>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>');
           redirect('admin/data_tipe');
       }
    }

    public function _rules(){
        // for form_validation

        $this->form_validation->set_rules('kode_tipe','Kode Tipe','required');
        $this->form_validation->set_rules('nama_tipe','Nama Tipe','required');
        
    }

    public function delete_tipe_nana($id){

        $where = array('id_tipe' => $id);
        $this->rental_models->delete_data($where,'tipe');
        $this->session->set_flashdata('pesan','
           <div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <strong> Data Berhasil dihapus! </strong>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>');
           redirect('admin/data_tipe');
    }
}
?>