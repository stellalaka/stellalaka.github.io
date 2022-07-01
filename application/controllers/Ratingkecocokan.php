<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ratingkecocokan extends CI_Controller
{

        public function __construct()
        {
                parent::__construct();
                $this->load->model('Modelratingkecocokan');
                $this->load->helper('url_helper');
        }
        public function index()
        {
                $data['itemratingkecocokan'] = $this->Modelratingkecocokan->getratingkecocokan();
                $data['pilidkriteria'] = $this->Modelratingkecocokan->getpilihankriteria();
                $data['pilidatribut'] = $this->Modelratingkecocokan->getpilihanatribut();
                $this->load->view('header');
                $this->load->view('ratingkecocokan', $data);
                $this->load->view('footer');
        }
        public function buatratingkecocokanbaru()
        {
                $this->load->helper('form');
                $this->load->library('form_validation'); 
                $this->form_validation->set_rules('idkriteria', 'Id Kriteria', 'required');
                $this->form_validation->set_rules('idatribute', 'Id Atribut', 'required');
                $this->form_validation->set_rules('nilairating', 'Nilai Rating', 'required');

                if ($this->form_validation->run() === FALSE) {
                        $this->load->view('header');
                        $this->load->view('ratingkecocokan');
                        $this->load->view('footer');
                        redirect('ratingkecocokan');
                } else {
                        $this->Modelratingkecocokan->simpanrekordratingkecocokan();
                        redirect('ratingkecocokan');
                }
        }
        public function hapusratingkecocokan($id)
        {
                $iddihapus = html_escape($this->security->xss_clean($id));
                $this->db->where('idrating', $iddihapus);
                $this->db->delete('ratingkecocokan');
                redirect('ratingkecocokan');
        }
        public function koreksiratingkecocokan($id)
        {
                $this->load->helper('form');
                $this->load->library('form_validation');

                $this->form_validation->set_rules('idkriteria', 'Id Kriteria', 'required');
                $this->form_validation->set_rules('idatribute', 'Id Atribut', 'required');
                $this->form_validation->set_rules('nilairating', 'Nilai Rating', 'required');

                if ($this->form_validation->run() === FALSE) {
                        $idrating = html_escape($this->security->xss_clean($id));
                        $data['itemratingkecocokan'] = $this->Modelratingkecocokan->getratingkecocokan($idrating);
                        $data['pilidkriteria'] = $this->Modelratingkecocokan->getpilihankriteria();
                        $data['pilidatribut'] = $this->Modelratingkecocokan->getpilihanatribut();
                        $this->load->view('header');
                        $this->load->view('koreksiratingkecocokan', $data);
                        $this->load->view('footer');
                } else {
                        $this->Modelratingkecocokan->simpanhasilkoreksiratingkecocokan();
                        redirect('ratingkecocokan');
                }
        }
}
