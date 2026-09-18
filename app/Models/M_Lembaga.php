<?php
namespace App\Models;
use CodeIgniter\Model;
 
class M_Lembaga extends Model
{
    protected $table = 'lembaga';
 
    public function getDataLembaga($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('nama_lembaga','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('nama_lembaga','ASC');
            return $query = $builder->get();
        }
    }

    
    public function saveDataLembaga($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function updateDataLembaga($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data);
    }
    
    public function autoNumber() {
        $builder = $this->db->table($this->table);
        $builder->select("id_lembaga");
        $builder->orderBy("id_lembaga", "DESC");
        $builder->limit(1);
        return $query = $builder->get();
	}
}
?>