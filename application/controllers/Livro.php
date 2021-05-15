<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Livro extends  REST_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function index_get($id = 0){
		if(!empty($id)){
			$data = $this->db->get_where("tb_livros",[$id=>$id])->row_array();
		}else{		
			$data = $this->db->get("tb_livros")->result();
		}
			$this->response($data, REST_Controller::HTTP_OK);
	}

	public function index_post(){
		$input = $this->input->post();
		$this->db->insert('tb_livros',$input);
		$this->response('Registro gravado com sucesso!', REST_Controller::HTTP_OK);
	}


	public function index_put($id){
		$input = $this->put(); //o que ele receber vai ser atribuido ao put 
		$this->db->update("tb_livros",$input,array('cd_livro'=>$id)); 
		$this->response(['Registro alterado com sucesso!'], REST_Controller::HTTP_OK);
	}

	public function index_delete($id = 0){
		if(!empty($id)){
			$this->db->delete('tb_livros',array('cd_livro'=>$id)); //tem um array de dados
			$this->response(['Registro deletado com sucesso!'], REST_Controller::HTTP_OK);
		}else{
			$this->db->delete('tb_livros',array()); 
			$this->response(['Registros deletados com sucesso!'], REST_Controller::HTTP_OK);
		}
	}

}
