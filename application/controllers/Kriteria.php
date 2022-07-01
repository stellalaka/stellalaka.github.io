<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modelkriteria');
        $this->load->helper('url_helper');
    }
    public function index()
    {
        $data['itemkriteria'] = $this->Modelkriteria->getkriteria();
        $this->load->view('header');
        $this->load->view('kriteria', $data);
        $this->load->view('footer');
    }
    public function simpanrekordbaru()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('namakriteria', 'Nama Kriteria', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('header');
            $this->load->view('kriteria');
            $this->load->view('footer');
        } else {
            $this->Modelkriteria->simpankanrekordbarunya();
            redirect('kriteria');
        }
    }
    public function hapus($id)
    {
        $iddihapus = $this->security->xss_clean($id);
        $this->db->where('idkriteria', $iddihapus);
        $this->db->delete('kriteria');
        redirect('kriteria');
    }
    public function koreksi($id)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('idkriteria', 'Id Kriteria', 'required');
        $this->form_validation->set_rules('namakriteria', 'Nama Kriteria', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['itemkriteria'] = $this->Modelkriteria->getkriteria($id);
            $this->load->view('header');
            $this->load->view('koreksikriteria', $data);
            $this->load->view('footer');
        } else {
            $this->Modelkriteria->simpanrekordkoreksinya();
            redirect('kriteria');
        }
    }
    public function bobotharapan()
    {
        $this->load->helper('form');
        $bSimpan = $this->input->post('bSimpanBobot');
        if (!isset($bSimpan)) {
            $data['itemkriteria'] = $this->Modelkriteria->getkriteria();
            $this->load->view('header');
            $this->load->view('bobotkriteria', $data);
            $this->load->view('footer');
        } else {
            $this->Modelkriteria->simpanbobotkriteria();
            redirect('kriteria/bobotharapan');
        }
    }
}
