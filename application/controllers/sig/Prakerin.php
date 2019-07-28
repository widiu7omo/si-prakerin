<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prakerin extends CI_Controller {
  public function __construct(){
    parent::__construct();
    //Cek Session Level
    if ($this->session->userdata('level') != "mahasiswa"){
			redirect('sig/login');
		}
    $this->load->model('sig/Model_prakerin');
  }
  
  public function index(){
    $nim = $this->session->userdata('id');
    $data['form_nama']  = 'Data Prakerin';
    $data['komponen']   = 'prakerin';
    // Tampil Data Mahasiswa Pilih Perusahaan
    $data_mhs_perusahaan  = $this->Model_prakerin->tampil_mhs_perusahaan($nim)->row();
    if($data_mhs_perusahaan != NUll){
      $data['mhs_pilih_perusahaaan'] = 'acc';
      $data['id_mhs_pilih_perusahaan'] = $data_mhs_perusahaan->id_mhs_pilih_perusahaan;
      $data['id_perusahaan']      = $data_mhs_perusahaan->id_perusahaan;
      $data['nama_perusahaan']    = $data_mhs_perusahaan->nama_perusahaan;
      $data['long_perusahaan']    = $data_mhs_perusahaan->long_perusahaan;
      $data['lat_perusahaan']     = $data_mhs_perusahaan->lat_perusahaan;
      $data['telepon_perusahaan'] = $data_mhs_perusahaan->telepon_perusahaan;
      $data['alamat_perusahaan']  = $data_mhs_perusahaan->alamat_perusahaan;
      $data['id_negara']          = $data_mhs_perusahaan->id_negara;
      $data['nama_negara']        = $data_mhs_perusahaan->nama_negara;
      $data['id_provinsi']        = $data_mhs_perusahaan->id_provinsi;
      $data['nama_provinsi']      = $data_mhs_perusahaan->nama_provinsi;
      $data['id_kab_kota']        = $data_mhs_perusahaan->id_kab_kota;
      $data['nama_kab_kota']      = $data_mhs_perusahaan->nama_kab_kota;
      $data['id_kecamatan']       = $data_mhs_perusahaan->id_kecamatan;
      $data['nama_kecamatan']     = $data_mhs_perusahaan->nama_kecamatan;
    }else{
      $data['mhs_pilih_perusahaaan'] = 'tidak_acc'; 
    }
    $data['t_negara'] = $this->Model_prakerin->tampil_negara();
    $data['t_soal_kuesioner'] = $this->Model_prakerin->tampil_soal_kuesioner();
    $data['t_mhs_review'] = $this->Model_prakerin->tampil_mhs_review($nim);
    $data['t_mhs_berkas_perusahaan'] = $this->Model_prakerin->tampil_mhs_berkas_perusahaan($nim);
    $this->load->view('sig/header', $data);
    $this->load->view('sig/menu');
    $this->load->view('sig/view_prakerin');
    $this->load->view('sig/footer');
  }

  public function update_perusahaan(){
    if(isset($_POST['PUpdate'])){
      $nim = $this->session->userdata('id');
      $not_id['nama_perusahaan'] = $this->input->post("not_id");
      $data = array(
        'nama_perusahaan'   => $this->input->post("nama_perusahaan"),
        'long_perusahaan'   => $this->input->post("lng_perusahaan"),
        'lat_perusahaan'    => $this->input->post("lat_perusahaan"),
        'id_negara'         => $this->input->post("id_negara"),
        'id_provinsi'       => $this->input->post("id_provinsi"),
        'id_kab_kota'       => $this->input->post("id_kabupaten"),
        'id_kecamatan'      => $this->input->post("id_kecamatan"),
        'telepon_perusahaan'=> $this->input->post("telepon_perusahaan"),
        'alamat_perusahaan' => $this->input->post("alamat_perusahaan"),
      );
      $data = $this->Model_prakerin->simpan_perusahaan($data, $not_id);
      $data_notif = array(
        'session_notif' => 'notif',
        'judul_notif'   => 'Berhasil Mengupdate',
        'ket_notif'     => 'Berhasil Mengupdate Data Perusahaan',
        'icon'          => 'success'
      );
      $this->session->set_flashdata($data_notif);
      redirect('sig/prakerin');
    }else{
      echo "<script>window.history.back()</script>";
    }
  }

  public function tambah_review_perusahaan(){
    $nim = $this->session->userdata('id');
    $data_mhs_perusahaan  = $this->Model_prakerin->tampil_mhs_perusahaan($nim)->row();
    $komentar = $this->input->post("komentar");
    //Proses Menyimpan Data Array Bintang Review
    for($i=0; $i < count($this->input->post("id_data_kuisioner")); $i++) {
      $id_soal = $_POST['id_data_kuisioner'][$i];
      $rating = $_POST['rating_perusahaan'.$i];
      $data = array(
        'nim' => $nim,
        'id_perusahaan' => $data_mhs_perusahaan->id_perusahaan,
        'id_data_kuisioner'   => $id_soal,
        'rating_perusahaan'   => $rating,
        'komentar' => $komentar,
        'tanggal_review_perusahaan' => date("Y-m-d"),
      );
      $this->Model_prakerin->tambah_review_perusahaan($data);
    }
    $data_notif = array(
      'session_notif' => 'notif',
      'judul_notif'   => 'Berhasil',
      'ket_notif'     => 'Berhasil Review Perusahaan',
      'icon'          => 'success'
    );
    $this->session->set_flashdata($data_notif);
    redirect('sig/prakerin');
  }

  public function update_review_perusahaan(){
    $nim = $this->session->userdata('id');
    $data_mhs_perusahaan  = $this->Model_prakerin->tampil_mhs_perusahaan($nim)->row();
    $komentar = $this->input->post("komentar");
    //Proses Menyimpan Data Array Bintang Review
    for($i=0; $i < count($this->input->post("id_data_kuisioner")); $i++) {
      $id['id_perusahaan_review'] = $_POST['id_perusahaan_review'][$i];
      $id_soal = $_POST['id_data_kuisioner'][$i];
      $rating = $_POST['rating_perusahaan'.$i];
      $data = array(
        'nim' => $nim,
        'id_perusahaan' => $data_mhs_perusahaan->id_perusahaan,
        'id_data_kuisioner'   => $id_soal,
        'rating_perusahaan'   => $rating,
        'komentar' => $komentar,
        'tanggal_review_perusahaan' => date("Y-m-d"),
      );
      $this->Model_prakerin->update_review_perusahaan($data, $id);
    }
    $data_notif = array(
      'session_notif' => 'notif',
      'judul_notif'   => 'Berhasil',
      'ket_notif'     => 'Berhasil Ubah Ulasaan Perusahaan',
      'icon'          => 'success'
    );
    $this->session->set_flashdata($data_notif);
    redirect('sig/prakerin');
  }

  public function tambah_foto_prakerin(){
    if(!empty($_FILES['file']['name'])){
      $nama_file = $this->input->post("nama_foto");
      $mhs_pilih_perusahaan = $this->input->post("id_mhs_pilih_perusahaan");
      $temp = explode(".", $_FILES["file"]["name"]);
      $config['file_name'] = $this->session->userdata('id').'_'.time().'.'.end($temp);
      $config['upload_path'] = FCPATH."./file_upload/file_perusahaan";
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      $this->load->library('upload', $config);
      if ($this->upload->do_upload('file')){
        $file = $this->upload->data();
        //Compress Image 
        $config['image_library']='gd2';
        $config['source_image']='./file_upload/file_perusahaan/'.$file['file_name'];
        $config['create_thumb']= FALSE;
        $config['maintain_ratio']= FALSE;
        $config['quality']= '70%';
        $config['width']= 800;
        $config['height']= 500;
        $config['new_image']= './file_upload/file_perusahaan/'.$file['file_name'];
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        //End File Compress
        $data = array(
          'id_mhs_pilih_perusahaan'         => $mhs_pilih_perusahaan,
          'nama_berkas_pilih_perusahaan'    => $nama_file,
          'extensi_berkas_pilih_perusahaan' => $_FILES["file"]["type"],
          'jenis_berkas_pilih_perusahaan'   => $file['file_name'],
          'tanggal_upload_pilih_perusahaan' => date("Y-m-d H:i:s"),
        );
        $this->Model_prakerin->simpan_foto_perusahaan($data, FALSE);
        # Data Untuk Membuat Notifikasi
        $data_notif = array(
          'session_notif' => 'notif',
          'judul_notif'   => 'Berhasil',
          'ket_notif'     => 'Berhasil Menambahkan Data',
          'icon'          => 'success'
        );
        # Session Notifikasi
        $this->session->set_flashdata($data_notif);
        redirect('sig/prakerin');
      }
    } 
  }

  public function provinsi($id_negara){
    $query = $this->Model_prakerin->tampil_provinsi($id_negara);
		foreach ($query as $data_provinsi) {
			$data .= '<option value="'.$data_provinsi->id_provinsi.'">'.$data_provinsi->nama_provinsi.'</option>';
    }
    echo $data;
  }

  public function kabupaten($id_provinsi){
    $query = $this->Model_prakerin->tampil_kabupaten($id_provinsi);
		foreach ($query as $data_kabupaten) {
			$data .= '<option  value="'.$data_kabupaten->id_kab_kota.'">'.$data_kabupaten->nama_kab_kota.'</option>';
    }
    echo $data;
  }

  public function kecamatan($id_kecamatan){
    $query = $this->Model_prakerin->tampil_kecamatan($id_kecamatan);
    foreach ($query as $data_kecamatan) {
      $data .= '<option class="'.$data_kabupaten->id_kab_kota.'" value="'.$data_kecamatan->id_kecamatan.'">'.$data_kecamatan->nama_kecamatan.'</option>';
    }
    echo $data;
  }

  public function hapus_foto_perusahaan(){
    # Control Proses Hapus foto
    $id['id_berkas_pilih_perusahaan'] = $this->input->post('id_berkas_pilih_perusahaan');
    unlink(FCPATH."./file_upload/file_perusahaan/".$this->input->post("jenis_berkas_pilih_perusahaan"));
    $this->Model_prakerin->hapus_foto_perusahaan($id);
    # Data Untuk Membuat Notifikasi
    $data_notif = array(
      'session_notif' => 'notif',
      'judul_notif'   => 'Berhasil',
      'ket_notif'     => 'Berhasil Menghapus Data',
      'icon'          => 'success'
    );
    # Session Notifikasi
    $this->session->set_flashdata($data_notif);
    redirect('sig/prakerin');
  }
}
?>
