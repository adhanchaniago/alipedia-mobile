<?php
class M_admin extends CI_Model  {

    public function __contsruct(){
        parent::Model();
    }

    // Identitas 
	public function insert_identitas($data){
        $this->db->insert("identitas",$data);
    }

    public function update_identitas($where,$data){
        $this->db->update("identitas",$data,$where);
    }

    public function delete_identitas($where){
        $this->db->delete("identitas", $where);
    }

	public function get_identitas($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("identitas");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_identitas($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("identitas");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_identitas($where="", $like=""){
        $this->db->select("*");
        $this->db->from("identitas");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

	public function identitaswebsite(){
        $data = "";
		$where['identitas_id'] = 1;
		$this->db->select("*");
        $this->db->from("identitas");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    // Kategori 
	public function insert_kategori($data){
        $this->db->insert("kategori",$data);
    }

    public function update_kategori($where,$data){
        $this->db->update("kategori",$data,$where);
    }

    public function delete_kategori($where){
        $this->db->delete("kategori", $where);
    }

	public function get_kategori($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("kategori");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_kategori($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("kategori");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_kategori($where="", $like=""){
        $this->db->select("*");
        $this->db->from("kategori");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

    // Transaksi 
	public function insert_transaksi($data){
        $this->db->insert("transaksi",$data);
    }

    public function update_transaksi($where,$data){
        $this->db->update("transaksi",$data,$where);
    }

    public function delete_transaksi($where){
        $this->db->delete("transaksi", $where);
    }

	public function get_transaksi($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("transaksi");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_transaksi($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("transaksi");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_transaksi($where="", $like=""){
        $this->db->select("*");
        $this->db->from("transaksi");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}

    // Produk 
	public function insert_produk($data){
        $this->db->insert("produk",$data);
    }

    public function update_produk($where,$data){
        $this->db->update("produk",$data,$where);
    }

    public function delete_produk($where){
        $this->db->delete("produk", $where);
    }

	public function get_produk($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("produk");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_produk($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("produk");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_produk($where="", $like=""){
        $this->db->select("*");
        $this->db->from("produk");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}

    // Toko 
	public function insert_toko($data){
        $this->db->insert("toko",$data);
    }

    public function update_toko($where,$data){
        $this->db->update("toko",$data,$where);
    }

    public function delete_toko($where){
        $this->db->delete("toko", $where);
    }

	public function get_toko($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("toko");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_toko($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("toko");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_toko($where="", $like=""){
        $this->db->select("*");
        $this->db->from("toko");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}

    // Komentar 	
	public function insert_komentar($data){
        $this->db->insert("komentar",$data);
    }

    public function update_komentar($where,$data){
        $this->db->update("komentar",$data,$where);
    }

    public function delete_komentar($where){
        $this->db->delete("komentar", $where);
    }

	public function get_komentar($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("komentar");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_komentar($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("komentar");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_komentar($where="", $like=""){
        $this->db->select("*");
        $this->db->from("komentar");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}

    // Menu Admin 
	public function insert_menu_admin($data){
        $this->db->insert("menu_admin",$data);
    }

    public function update_menu_admin($where,$data){
        $this->db->update("menu_admin",$data,$where);
    }

    public function delete_menu_admin($where){
        $this->db->delete("menu_admin", $where);
    }

	public function get_menu_admin($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("menu_admin");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_menu_admin($select, $sidx, $sord, $limit, $start, $where=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("menu_admin");
		if ($where){$this->db->where($where);}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_menu_admin($where=""){
        $this->db->select("*");
        $this->db->from("menu_admin");
		if ($where){$this->db->where($where);}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

    // Menu 
	public function insert_menu($data){
        $this->db->insert("menu",$data);
    }

    public function update_menu($where,$data){
        $this->db->update("menu",$data,$where);
    }

    public function delete_menu($where){
        $this->db->delete("menu", $where);
    }

	public function get_menu($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("menu");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_menu($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("menu");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $this->db->order_by($sidx,$sord);
		$this->db->order_by('menu_urutan','ASC');
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_menu($where="", $like=""){
        $this->db->select("*");
        $this->db->from("menu");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

    // Admin 
	public function insert_admin($data){
        $this->db->insert("admin",$data);
    }

    public function update_admin($where,$data){
        $this->db->update("admin",$data,$where);
    }

    public function delete_admin($where){
        $this->db->delete("admin", $where);
    }

	public function get_admin($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("admin a");
		$this->db->join('admin_level al', 'a.admin_level_kode = al.admin_level_kode', 'left');
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_admin($select, $sidx,$sord,$limit,$start,$where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("admin a");
        $this->db->join('admin_level al', 'a.admin_level_kode = al.admin_level_kode', 'left');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
		$names = array('admin', 'admin');
        $this->db->where_not_in('admin_user', $names);
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function grid_all_admin2($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("admin a");
        $this->db->join('admin_level al', 'a.admin_level_kode = al.admin_level_kode', 'left');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function grid_all_admin3($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("admin");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    
    public function grid_all_admin4($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("admin");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_admin($where="", $like=""){
        $this->db->select("*");
        $this->db->from("admin");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

    // Admin Level 
	public function insert_admin_level($data){
        $this->db->insert("admin_level",$data);
    }

    public function update_admin_level($where,$data){
        $this->db->update("admin_level",$data,$where);
    }

    public function delete_admin_level($where){
        $this->db->delete("admin_level", $where);
    }

	public function get_admin_level($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("admin_level");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_admin_level($select, $sidx,$sord,$limit,$start,$where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("admin_level");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_admin_level($where="", $like=""){
        $this->db->select("*");
        $this->db->from("admin_level");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){
			$this->db->like($key, $value);
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

    // invoice
    public function insert_invoices($data){
        $this->db->insert("invoice",$data);
    }
        
    public function update_invoice($where,$data){
        $this->db->update("invoice",$data,$where);
    }
    
    public function delete_invoice($where){
        $this->db->delete("invoice", $where);
    }
    
    public function get_invoice($select, $where){
        $data = "";
        $this->db->select($select);
        $this->db->from("invoice s");
        $this->db->join('admin p', 's.admin_user= p.admin_user', 'left');
        $this->db->where($where);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data = $Q->row();
        }
        $Q->free_result();
        return $data;
    }
    
    public function grid_all_invoice($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("invoice");
        if ($where){$this->db->where($where);}
            if ($like){
                foreach($like as $key => $value){ 
                $this->db->like($key, $value); 
                }
            }
            $this->db->order_by($sidx,$sord);
            $this->db->limit($limit,$start);
            $Q = $this->db->get();
            if ($Q->num_rows() > 0){
                $data=$Q->result();
            }
        $Q->free_result();
        return $data;
    }
    
    public function count_all_invoice($where="", $like="")
    {
        $this->db->select("*");
        $this->db->from("invoice");
        if ($where){$this->db->where($where);}
            if ($like){
                foreach($like as $key => $value){ 
                $this->db->like($key, $value); 
            }
        }
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

	public function combo_box($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
		echo "<select name='$name' id='$name' onchange='$js' required class='form-control input-sm' style='width:$width'>";
		echo "<option value=''>".$label."</option>";
		$query = $this->db->query($table);
		foreach ($query->result() as $row){
			if ($pilihan == $row->$value){
				echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
			} else {
				echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
			}
		}
		echo "</select>";
	}

	public function combo_box2($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
		echo "<select name='$name' id='$name' onchange='$js' class='form-control input-sm' style='width:$width'>";
		echo "<option value=''>".$label."</option>";
		$query = $this->db->query($table);
		foreach ($query->result() as $row){
			if ($pilihan == $row->$value){
				echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
			} else {
				echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
			}
		}
		echo "</select>";
	}

	public function combo_box3($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
		echo "<select name='$name'  style='display:none;' id='$name' onchange='$js' class='form-control input-sm' style='width:$width'>";
		$query = $this->db->query($table);
		foreach ($query->result() as $row){
			if ($pilihan == $row->$value){
				echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
			} else {
				echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
			}
		}
		echo "</select>";
	}

	public function checkbox($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			$ceked = (array_search($row->tag_id, $array_tag) === false)? '' : 'checked';
			echo "<label for='".$row->$value."'><input type='checkbox' class='icheck' name='$name' id='".$row->$value."' value='".$row->$value."' ".$ceked."/> ".$row->$name_value."</label> ";
		}
	}

	public function checkbox_status($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			$ceked = (array_search($row->status_perkawinan_kode, $array_tag) === false)? '' : 'checked';
			echo "<input type='checkbox' name='$name' id='".$row->$value."' style='display: inline-block;' value='".$row->$value."' ".$ceked."/><label for='".$row->$value."' style='display: inline-block; margin-right: 10px;'>".$row->$name_value."</label>";
		}
	}

	public function listarray($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			if (array_search($row->tag_id, $array_tag) === false) {
			} else {
			echo $row->$name_value.", ";
			}
		}
	}
}
