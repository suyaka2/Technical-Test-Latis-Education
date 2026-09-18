<?php namespace App\Controllers;

use App\Models\M_User;

class User extends BaseController
{

    public function profile(){
            if (session()->get('ses_id') == "" or session()->get('ses_user') == "" or session()->get('ses_name') == "") {
           session()->setFlashdata('error', "Silahkan login terlebih dahulu");
           ?>
           <script>
               document.location = "<?= base_url('/login'); ?>";
           </script>
           <?php
           }else{
            $modelUser = new M_User();

            $idLogin = session()->get('ses_id');
    
            $dataUser = $modelUser->getDataUser(['id_user' => $idLogin])->getRowArray();

               $uri = service('uri');
               $halaman = $uri->getSegment(2);
               $data['halaman'] = $halaman;
            $data['data_user'] = $dataUser; 

               $data['title'] = "Dashboard";
               echo view('Template/header', $data);
               echo view('Template/sidebar', $data);
               echo view('Template/navbar', $data);
               echo view('Page/profile', $data);
               echo view('Template/footer', $data);
           }
    }       


    
    
 
}
?>