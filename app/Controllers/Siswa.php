<?php

namespace App\Controllers;
use App\Models\M_Siswa;
use App\Models\M_Lembaga;

class Siswa extends BaseController
{
    // public function index(): string
    // {
    //     return view('welcome_message');
    // }


    public function siswa_page(){
            if (session()->get('ses_id') == "" or session()->get('ses_user') == "" or session()->get('ses_name') == "") {
           session()->setFlashdata('error', "Silahkan login terlebih dahulu");
           ?>
           <script>
               document.location = "<?= base_url('/login'); ?>";
           </script>
           <?php
           }else{
            $modelSiswa = new M_Siswa;
            $modelLembaga = new M_Lembaga;
            $data['dataSiswa'] = $modelSiswa->getDataSiswaJoin()->getResultArray();
            $data['data_lembaga'] = $modelLembaga->getDataLembaga()->getResultArray();
    
               $uri = service('uri');
               $halaman = $uri->getSegment(2);
               $data['halaman'] = $halaman;
               $data['title'] = "Halaman Siswa";
               echo view('Template/header', $data);
               echo view('Template/sidebar', $data);
               echo view('Template/navbar', $data);
               echo view('Page/siswa', $data);
               echo view('Template/footer', $data);
           }
    }  
    public function tambah_data(){
            if (session()->get('ses_id') == "" or session()->get('ses_user') == "" or session()->get('ses_name') == "") {
           session()->setFlashdata('error', "Silahkan login terlebih dahulu");
           ?>
           <script>
               document.location = "<?= base_url('/login'); ?>";
           </script>
           <?php
           }else{
            $modelLembaga = new M_Lembaga;
            // $data['data_lembaga'] = $modelLembaga->findAll();
            $data['data_lembaga'] = $modelLembaga->getDataLembaga()->getResultArray();
            
    
               $uri = service('uri');
               $halaman = $uri->getSegment(2);
               $data['halaman'] = $halaman;
               $data['title'] = "Input Data";
               echo view('Template/header', $data);
               echo view('Template/sidebar', $data);
               echo view('Template/navbar', $data);
               echo view('Page/tambahData', $data);
               echo view('Template/footer', $data);
           }
    }  

        public function simpan_siswa(){
            if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_name')==""){
            session()->setFlashdata('error', "Silahkan login terlebih dahulu");
            ?>
            <script>
                document.location = "<?= base_url('/login');?>";
            </script>
            <?php
            }else{
            $modelSiswa = new M_Siswa; // inisiasi
            $modelLembaga = new M_Lembaga; // inisiasi
           $namaSiswa = $this->request->getPost('nama_siswa');
           $nis = $this->request->getPost('nis');
           $email  = $this->request->getPost('email');
           $lembaga = $this->request->getPost('lembaga');
       
         if(!$this->validate([
                'foto_profile' => 'uploaded[foto_profile]|max_size[foto_profile, 100]|ext_in[foto_profile,jpg,png]',
            ])){
                session()->setFlashdata('error', "Format file yang diizinkan : jpg, png dengan maksimal ukuran 1 MB");
                return redirect()->to('/siswa/tambahData')->withInput();
            }
            
            $file = $this->request->getFile('foto_profile');
            $file ->move('img');
            $namaFile = $file->getName();

           $cekSiswa = $modelSiswa->getDataSiswa(['nama_siswa' => $namaSiswa])->getNumRows();
           if($cekSiswa > 0){
            session()->setFlashdata('error','Siswa Sudah Terdaftar!!');
            ?>
            <script>
                history.go(-1);
            </script>
            <?php
           }else{
            $hasil = $modelSiswa->autoNumber()->getRowArray();
            if(!$hasil){
             $id = "SWA001";
            }else{
             $kode = $hasil['id_siswa'];
             $noUrut = (int) substr($kode, -3);
             $noUrut++;
             $id = "SWA".sprintf("%03s", $noUrut);
            }
 
            $dataSimpan = [
             'id_siswa' =>$id,
             'nama_siswa' => $namaSiswa,
             'nis' => $nis,
             'email_siswa' => $email,
             'id_lembaga' => $lembaga,
             'foto_siswa' => $namaFile
            
 
            ];
            $modelSiswa->saveDataSiswa($dataSimpan);
            session()->setFlashdata('success', "Data Telah Ditambahkan!");
            ?>
            <script>
                 document.location = "<?= base_url('/siswa');?>";
            </script>
            <?php   
           }
          
        }
        }

    public function update_siswa(){
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_name')==""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('/login');?>";
            </script>
            <?php
        }
        else{
            $modelSiswa = new M_Siswa; // inisiasi

            $idUpdate = session()->get('idUpdate');
            $namaSiswa = $this->request->getPost('nama_siswa');
           $nis = $this->request->getPost('nis');
           $email  = $this->request->getPost('email');
           $lembaga = $this->request->getPost('lembaga');

            if($_FILES['foto_profile']['name'] != ""){
                if(!$this->validate([
                    'foto_profile' => 'uploaded[foto_profile]|max_size[foto_profile, 100]|ext_in[foto_profile,jpg,png]',
                ])){
                    session()->setFlashdata('error', "Format file yang diizinkan : jpg, png dengan maksimal ukuran 1 MB");
                    ?>
                    <script>
                        history.go(-1);
                    </script>
                    <?php
                }
                $dataUpdate = $modelSiswa->getDataSiswa(['id_siswa' => $idUpdate])->getRowArray();
                if(file_exists('img/'.$dataUpdate['foto_siswa']) and $dataUpdate['foto_siswa'] !=""){
                    unlink('img/'.$dataUpdate['foto_siswa']); // hapus file yang lama
                }
    
                
    
                $file = $this->request->getFile('foto_profile');
                $file ->move('img');
                $namaFile = $file->getName();
                $dataUpdate = [
                    'nama_siswa' => $namaSiswa,
             'nis' => $nis,
             'email_siswa' => $email,
             'id_lembaga' => $lembaga,
             'foto_siswa' => $namaFile
                ];
                $whereUpdate = ['id_siswa' => $idUpdate];
        
                $modelSiswa->updateDataSiswa($dataUpdate, $whereUpdate);
                session()->remove('idUpdate');
                session()->setFlashdata('success', 'Data Siswa Berhasil Diperbarui!');
                ?>
                <script>
                    document.location = "<?= base_url('/siswa');?>";
                </script>
                <?php
            }
            else{
                $dataUpdate = [
                    'nama_siswa' => $namaSiswa,
             'nis' => $nis,
             'email_siswa' => $email,
             'id_lembaga' => $lembaga
                ];
                $whereUpdate = ['id_siswa' => $idUpdate];
        
                $modelSiswa->updateDataSiswa($dataUpdate, $whereUpdate);
                session()->remove('idUpdate');
                session()->setFlashdata('success', 'Data Siswa Berhasil Diperbarui!');
                ?>
                <script>
                    document.location = "<?= base_url('/siswa');?>";
                </script>
                <?php
            }
            
            
        }
    }  
    
    public function hapus_siswa(){
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_name')==""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('/login');?>";
            </script>
            <?php
        }
        else{
            $modelSiswa = new M_Siswa; // inisiasi

            $uri = service('uri');
            $idHapus = $uri->getSegment(3);
            $dataHapus = $modelSiswa->getDataSiswa(['id_siswa' => $idHapus])->getRowArray();

            
            $modelSiswa->deleteDataSiswa($idHapus);
            session()->setFlashdata('success', 'Data Siswa Berhasil Dihapus!!');
            ?>
            <script>
                document.location = "<?= base_url('/siswa');?>";
            </script>
            <?php
        }
    }

    public function edit_siswa(){
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_name')==""){
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('/login');?>";
            </script>
            <?php
        }
        else{
            $modelSiswa = new M_Siswa;
            $modelLembaga = new M_Lembaga; // inisiasi

            $uri = service('uri');
            $halaman = $uri->getSegment(2);
            $idEdit = $uri->getSegment(3);
            $dataSiswa = $modelSiswa->getDataSiswa(['sha1(id_siswa)' => $idEdit])->getRowArray();
            session()->set(['idUpdate' => $dataSiswa['id_siswa']]);

            $data['title'] = 'Edit Data';
            
            $data['halaman'] = $halaman;
            $data['data_siswa'] = $dataSiswa;
            $data['data_lembaga'] = $modelLembaga->getDataLembaga()->getResultArray();
            
            echo view('Template/header', $data);
               echo view('Template/sidebar', $data);
               echo view('Template/navbar', $data);
               echo view('Page/editSiswa', $data);
               echo view('Template/footer', $data);;
        }
    }

}
