<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('akun_model');
		$this->load->helper(array('master'));
	}

	public function index()
	{
		$post = $this->input->post();
		$get = $this->input->get();
		//multilevel
		//if multilevel index are exist

		if (isset($get['in'])) {
			//excute by modal multilevel
			if ($get['in'] == 'multi') {
				$postAkun = $post['level'];
				$decodeAkun = json_decode($postAkun);
				$akun['tb_akun.username'] = $decodeAkun[0];
				$akun['tb_master_level.nama_master_level'] = $decodeAkun[2];
				$password = $decodeAkun[1];

				//call again when account have more than one level
				$isValidAkun = $this->checkAccount($akun, $password);
				$this->session->set_userdata('level', $decodeAkun[2]);
				$this->session->set_userdata('app', 'simprakerin');
				$this->session->set_userdata('id', $isValidAkun[0]->id);

				switch ($isValidAkun[0]->level) {
					case 'mahasiswa':
						$programstudi = masterdata('tb_mahasiswa', array('nim' => $isValidAkun[0]->id), 'id_program_studi');
						$this->session->set_userdata('prodi', $programstudi->id_program_studi);
						break;
					case 'dosen':
						$join = array('tb_dosen', 'tb_dosen.nip_nik = tb_pegawai.nip_nik', 'INNER');
						$dosen = datajoin('tb_pegawai', array('tb_pegawai.username' => $isValidAkun[0]->id), 'tb_pegawai.nama_pegawai,tb_dosen.*', $join, null);
						$this->session->set_userdata('nip_nik', $dosen->nip_nik);
						$this->session->set_userdata('prodi', $dosen->id_program_studi);
						break;
					default:
						//it mean that you're admin
						redirect(site_url('main'));
				}
				return $this->is_matching($isValidAkun['matching']);
			}
			//is in == true
			$akun['tb_akun.username'] = $post['username'];
			$password = $post['password'];
			$isValidAkun = $this->checkAccount($akun, $password);

			//must exactly only one account, when it's empty or more than one,it will throw to exception
			//dosen usernamenya adalah email
			//mahasiswa usernamenya nim
			if (!$isValidAkun['multi']) {
				$this->session->set_userdata('level', $isValidAkun[0]->level);
				$this->session->set_userdata('app', 'simprakerin');
				$this->session->set_userdata('id', $isValidAkun[0]->id);
				switch ($isValidAkun[0]->level) {
					case 'mahasiswa':
						$programstudi_by_year = masterdata('(select tm.*,tw.`id_tahun_akademik` as id_ta from tb_mahasiswa tm join tb_waktu tw on tm.id_tahun_akademik =tw.id_tahun_akademik) tb_mahasiswa', array('nim' => $isValidAkun[0]->id), 'id_program_studi',true);
						if (count($programstudi_by_year) == 0) {
							$this->session->set_flashdata('fail', 'Gagal untuk Login, Anda tidak dijinkan login pada semester ini');
							redirect(site_url('login'));
						}
						$this->session->set_userdata('prodi', $programstudi_by_year[0]->id_program_studi);
						break;
					case 'dosen':
						$join = array('tb_dosen', 'tb_dosen.nip_nik = tb_pegawai.nip_nik', 'INNER');
						$dosen = datajoin('tb_pegawai', array('tb_pegawai.username' => $isValidAkun[0]->id), 'tb_pegawai.nama_pegawai,tb_dosen.*', $join);
						$this->session->set_userdata('nip_nik', $dosen[0]->nip_nik);
						$this->session->set_userdata('prodi', $dosen[0]->id_program_studi);
						break;
					default:
						//it mean that youre not in list
						redirect(site_url('login'));
				}
				return $this->is_matching($isValidAkun['matching']);
			} elseif ($isValidAkun['multi']) {
				unset($isValidAkun['multi']);
				foreach ($isValidAkun as $akun) {
					$akun->userpass = $password;
				}
//				var_dump( $isValidAkun);
				$this->session->set_flashdata('multilevel', $isValidAkun);
				redirect(site_url('login?m=true'));
				return true;
			} else {
				$this->session->set_flashdata('fail', 'Gagal untuk Login, pastikan mengisi username dan password dengan benar');
				redirect(site_url('login'));
				return true;
			}
		}
		//to check is akun exist or not
		if (isset($get['ajax'])) {
			$response = $this->checkLogin($post['username']);
			echo json_encode(array('result' => isset($response->username) ? $response->username : null));
			return true;
		}

		//last think, it must be return to view login
		$this->load->view('login');
	}

	public function checkLogin($username)
	{
		return masterdata('tb_akun', array('username' => $username));
	}

	private function is_matching($isValid)
	{
		if (!$isValid) {
			$this->session->set_flashdata('fail', 'Gagal untuk Login, pastikan mengisi username dan password dengan benar');
			redirect(site_url('login'));
		}
		redirect(site_url('main'));
	}

	public function checkAccount($akun, $password)
	{
		//get account based or username ? row > 2 : ++ level
		$result = $this->akun_model->getAccount($akun);
		//jika akun mempunyai level 1 saja, password akan di verifikasi
		if (count($result) == 1) {
			// var_dump($result[0]->password);
			$result['multi'] = false;
			//checking is MD5 or hash
			if (strlen($result[0]->password) == 32) {
				//is md5
				$result['matching'] = md5($password) == $result[0]->password ? true : false;
			} else {
				//is bcrypt
				$result['matching'] = password_verify($password, $result[0]->password);
			}
		} //jika level lebih dari 1
		else {
			$result['multi'] = true;
		}
		//matching password by bcrypted and plaing password ONLY when result have row / rows
		//TODO:cleaning.

		return $result;
	}

}

/* End of file Login.php */
?>
