<?php namespace App\Controllers;

use App\Models\M_Login;

class Dashboard extends BaseController
{

    public function dashboard(){
            if (session()->get('ses_id') == "" or session()->get('ses_user') == "" or session()->get('ses_name') == "") {
           session()->setFlashdata('error', "Silahkan login terlebih dahulu");
           ?>
           <script>
               document.location = "<?= base_url('/login'); ?>";
           </script>
           <?php
           }else{
    
               $uri = service('uri');
               $halaman = $uri->getSegment(2);
               $data['halaman'] = $halaman;
               $data['title'] = "Dashboard";
               echo view('Template/header', $data);
               echo view('Template/sidebar', $data);
               echo view('Template/navbar', $data);
               echo view('Page/dashboard', $data);
               echo view('Template/footer', $data);
           }
    }       
 
}
?>