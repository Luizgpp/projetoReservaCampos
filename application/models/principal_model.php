<?php

class Principal_model extends CI_Model {

	public $nomeHotel;

	public function consulta($dados = null)
	{

		if($dados['tipoQuarto'] > 0 && $dados['nome'] != null){
			$this->db->select('h.*, t.nome AS "tipoquarto"');
			$this->db->select_min('q.precoFixo');
			$this->db->select_min('q.precoPromo');
			$this->db->from('hotelpousada h');
			$this->db->join('quartos q', 'h.idHotelPousada = q.hotelPousada_idHotelPousada');
			$this->db->join('tipoquarto t','q.tipoQuarto_idtipoQuarto = t.idtipoQuarto');
			$this->db->where('t.idtipoQuarto',$dados['tipoQuarto']);
			$this->db->like('h.nome',$dados['nome']);
			$this->db->group_by('h.nome');
			$this->db->order_by('q.precoFixo','asc');
			$query = $this->db->get();
			return $query->result_array();
			
		}
		else if($dados['tipoQuarto'] > 0 && $dados['nome'] == null )
		{
			$this->db->select('h.*, t.nome AS "tipoquarto"');
			$this->db->select_min('q.precoFixo');
			$this->db->select_min('q.precoPromo');
			$this->db->from('hotelpousada h');
			$this->db->join('quartos q', 'h.idHotelPousada = q.hotelPousada_idHotelPousada');
			$this->db->join('tipoquarto t','q.tipoQuarto_idtipoQuarto = t.idtipoQuarto');
			$this->db->where('t.idtipoQuarto',$dados['tipoQuarto']);
			$this->db->group_by('h.nome');
			$this->db->order_by('q.precoFixo','asc');
			$query = $this->db->get();
			return $query->result_array();
		}
		else if($dados['tipoQuarto'] == 0 && $dados['nome'] != null)
		{
			$this->db->select('h.*, t.nome AS "tipoquarto"');
			$this->db->select_min('q.precoFixo');
			$this->db->select_min('q.precoPromo');
			$this->db->from('hotelpousada h');
			$this->db->join('quartos q', 'h.idHotelPousada = q.hotelPousada_idHotelPousada');
			$this->db->join('tipoquarto t','q.tipoQuarto_idtipoQuarto = t.idtipoQuarto');
			$this->db->like('h.nome',$dados['nome']);
			$this->db->group_by('h.nome');
			$this->db->order_by('q.precoFixo','asc');
			$query = $this->db->get();
			return $query->result_array();
		}
		else
		{
			$this->db->select('h.*,t.nome AS "tipoquarto"');
			$this->db->select_min('q.precoFixo');
			$this->db->select_min('q.precoPromo');
			$this->db->from('hotelpousada h');
			$this->db->join('quartos q', 'h.idHotelPousada = q.hotelPousada_idHotelPousada');
			$this->db->join('tipoquarto t','q.tipoQuarto_idtipoQuarto = t.idtipoQuarto');
			$this->db->group_by('h.nome');
			$this->db->order_by('q.precoFixo','asc');
			$query = $this->db->get();
			return $query->result_array();
		}
	}
	public function consultarServico($dados = null){

		if($dados !=0){

			$this->db->select('h.hotelPousada_idHotelPousada, h.servicos_idservicos, s.nome ,s.img');
			$this->db->from('hotelpousadaservicos h'); 
			$this->db->join('servicos s', 'h.servicos_idservicos = s.idservicos');
			$this->db->where('h.hotelPousada_idHotelPousada =',$dados);        
			$query = $this->db->get();
			if($query->num_rows() != 0)
			{
				return $query->result_array();
			}
			else
			{
				return false;
			} 

		}
	}

	public function pesquisaAvancada($dados)
	{

		if($dados['estrelas'] == null && $dados['categoria'] == 1 && $dados['preco'] == 0)
		{
			
			$this->db->select('h.*, q.precoFixo, q.precoPromo, t.nome as "tipoquarto"');
			$this->db->from('hotelpousada h');
			$this->db->join('quartos q', 'h.idHotelPousada = q.hotelPousada_idHotelPousada');
			$this->db->join('tipoquarto t','q.tipoQuarto_idtipoQuarto = t.idtipoQuarto');
			$this->db->where('h.categoria',$dados['categoria']);
			$this->db->where('q.precoPromo > 0');
			$query = $this->db->get();
			return $query->result_array();
		}
		else if($dados['categoria'] == 1 && $dados['preco'] > 0 && $dados['estrelas'] == null)
		{
			$this->db->select('h.*, q.precoFixo, q.precoPromo, t.nome as "tipoquarto"');
			$this->db->from('hotelpousada h');
			$this->db->join('quartos q', 'h.idHotelPousada = q.hotelPousada_idHotelPousada');
			$this->db->join('tipoquarto t','q.tipoQuarto_idtipoQuarto = t.idtipoQuarto');
			$this->db->where('h.categoria',$dados['categoria']);
			$this->db->where('q.precoPromo > 0');
			$this->db->where('q.precoPromo <=', $dados['preco']);
			$query = $this->db->get();
			return $query->result_array();
		}
		else if($dados['categoria'] == 1 && $dados['estrelas'] > 0 && $dados['preco'] == 0)
		{
			
			$this->db->select('h.*, q.precoFixo, q.precoPromo, t.nome as "tipoquarto"');
			$this->db->from('hotelpousada h');
			$this->db->join('quartos q', 'h.idHotelPousada = q.hotelPousada_idHotelPousada');
			$this->db->join('tipoquarto t','q.tipoQuarto_idtipoQuarto = t.idtipoQuarto');
			$this->db->where('h.categoria',$dados['categoria']);
			$this->db->where('classificacao',$dados['estrelas']);
			$this->db->where('q.precoPromo > 0');
			$query = $this->db->get();
			return $query->result_array();

		}
		else if($dados['categoria'] == 2 && $dados['preco'] > 0)
		{
			;
			$this->db->select('h.*, q.precoFixo, q.precoPromo, t.nome as "tipoquarto"');
			$this->db->from('hotelpousada h');
			$this->db->join('quartos q', 'h.idHotelPousada = q.hotelPousada_idHotelPousada');
			$this->db->join('tipoquarto t','q.tipoQuarto_idtipoQuarto = t.idtipoQuarto');
			$this->db->where('h.categoria',$dados['categoria']);
			$this->db->where('q.precoPromo > 0');
			$this->db->where('q.precoPromo <=', $dados['preco']);
			$query = $this->db->get();
			return $query->result_array();
		}
		else if($dados['categoria'] == 2 && $dados['preco'] == 0)
		{
			
			$this->db->select('h.*, q.precoFixo, q.precoPromo, t.nome as "tipoquarto"');
			$this->db->from('hotelpousada h');
			$this->db->join('quartos q', 'h.idHotelPousada = q.hotelPousada_idHotelPousada');
			$this->db->join('tipoquarto t','q.tipoQuarto_idtipoQuarto = t.idtipoQuarto');
			$this->db->where('h.categoria',$dados['categoria']);
			$this->db->where('q.precoPromo > 0');
			$query = $this->db->get();
			return $query->result_array();

		}
		else if($dados['categoria'] == null && $dados['preco'] > 0 && $dados['estrelas'] > 0)
		{
			
			$this->db->select('h.*, q.precoFixo, q.precoPromo, t.nome as "tipoquarto"');
			$this->db->from('hotelpousada h');
			$this->db->join('quartos q', 'h.idHotelPousada = q.hotelPousada_idHotelPousada');
			$this->db->join('tipoquarto t','q.tipoQuarto_idtipoQuarto = t.idtipoQuarto');
			$this->db->where('classificacao',$dados['estrelas']);
			$this->db->where('q.precoPromo > 0');
			$query = $this->db->get();
			return $query->result_array();

		}
		else if ($dados['categoria'] == null && $dados['preco'] > 0 && $dados['estrelas'] == null) {
			
			$this->db->select('h.*, q.precoFixo, q.precoPromo, t.nome as "tipoquarto"');
			$this->db->from('hotelpousada h');
			$this->db->join('quartos q', 'h.idHotelPousada = q.hotelPousada_idHotelPousada');
			$this->db->join('tipoquarto t','q.tipoQuarto_idtipoQuarto = t.idtipoQuarto');
			$this->db->where('q.precoPromo > 0');
			$this->db->where('q.precoPromo <=', $dados['preco']);
			$query = $this->db->get();
			return $query->result_array();
		}
		else if($dados['categoria'] == null && $dados['preco'] == 0 && $dados['estrelas'] > 0){
			
			$this->db->select('h.*, q.precoFixo, q.precoPromo, t.nome as "tipoquarto"');
			$this->db->from('hotelpousada h');
			$this->db->join('quartos q', 'h.idHotelPousada = q.hotelPousada_idHotelPousada');
			$this->db->join('tipoquarto t','q.tipoQuarto_idtipoQuarto = t.idtipoQuarto');
			$this->db->where('classificacao',$dados['estrelas']);
			$this->db->where('q.precoPromo > 0');
			$query = $this->db->get();
			return $query->result_array();
		}
		else if($dados['categoria'] == 1 && $dados['preco'] > 0 && $dados['estrelas'] > 0)
		{
			
			$this->db->select('h.*, q.precoFixo, q.precoPromo, t.nome as "tipoquarto"');
			$this->db->from('hotelpousada h');
			$this->db->join('quartos q', 'h.idHotelPousada = q.hotelPousada_idHotelPousada');
			$this->db->join('tipoquarto t','q.tipoQuarto_idtipoQuarto = t.idtipoQuarto');
			$this->db->where('h.categoria',$dados['categoria']);
			$this->db->where('classificacao',$dados['estrelas']);
			$this->db->where('q.precoPromo > 0');
			$this->db->where('q.precoPromo <=', $dados['preco']);
			$query = $this->db->get();
			return $query->result_array();
		}
		else
		{
			$this->db->select('h.*,t.nome AS "tipoquarto"');
			$this->db->select_min('q.precoFixo');
			$this->db->select_min('q.precoPromo');
			$this->db->from('hotelpousada h');
			$this->db->join('quartos q', 'h.idHotelPousada = q.hotelPousada_idHotelPousada');
			$this->db->join('tipoquarto t','q.tipoQuarto_idtipoQuarto = t.idtipoQuarto');
			$this->db->group_by('h.nome');
			$this->db->order_by('q.precoFixo','asc');
			$query = $this->db->get();
			return $query->result_array();

		}
		

	}
} 