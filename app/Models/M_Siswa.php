<?php
namespace App\Models;
use CodeIgniter\Model;
 
class M_Siswa extends Model
{
    protected $table = 'siswa';

    protected $primaryKey = 'id_siswa';
 
    public function getDataSiswa($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('nama_siswa','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->orderBy('nama_siswa','ASC');
            return $query = $builder->get();
        }
    }

     public function getDataSiswaJoin($where = false)
    {
        if ($where === false) {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->join('lembaga','lembaga.id_lembaga = siswa.id_lembaga ','LEFT');
            $builder->orderBy('siswa.nama_siswa','ASC');
            return $query = $builder->get();
        } else {
            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->where($where);
            $builder->join('lembaga','lembaga.id_lembaga = siswa.id_lembaga ','LEFT');
            $builder->orderBy('siswa.nama_siswa','ASC');
            return $query = $builder->get();
        }
    }

    
    public function saveDataSiswa($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function updateDataSiswa($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data);
    }

    public function deleteDataSiswa($id_siswa)
    {
        return $this->db->table($this->table)->where('sha1(id_siswa)', $id_siswa)->delete();
    }
    
    public function autoNumber() {
        $builder = $this->db->table($this->table);
        $builder->select("id_siswa");
        $builder->orderBy("id_siswa", "DESC");
        $builder->limit(1);
        return $query = $builder->get();
	}
}
?>