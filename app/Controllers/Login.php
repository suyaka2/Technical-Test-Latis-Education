<?php

namespace App\Controllers;
use App\Models\M_Login;

class Login extends BaseController
{
    // public function index(): string
    // {
    //     return view('welcome_message');
    // }



    public function login_page(){


        return view('Auth/login');
    }

    public function logout(){
        session()->destroy();
        session()->setFlashdata('success', 'Anda telah berhasil logout');
        ?>
        <script>
            document.location = "<?= base_url('/login') ?>";
        </script>
        <?php
    }

    public function autentikasi(){
        $modelLogin = new M_Login();   

        

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $cekUsername = $modelLogin->getDataUser(['username' => $username])->getRowArray();
        if ($cekUsername == 0){
            session()->setFlashData('error', 'Username tidak ditemukan');
            ?>
            <script>
                history.go(-1);
            </script>
            <?php
        } else {
            $dataUser = $modelLogin->getDataUser(['username' => $username])->getRowArray();
            $passwordUser = $dataUser['password'];
            $verifikasiPassword = password_verify($password, $passwordUser);

            if(!$verifikasiPassword){
                session()->setFlashData('error', 'Password salah');
                ?>
                <script>
                    history.go(-1);
                </script>
                <?php
            } else {
                $dataSession = [
                    'ses_id' => $dataUser['id_user'],
                    'ses_user' => $dataUser['username'],
                    'ses_name' => $dataUser['nama_kandidat'],
                ];
                session()->set($dataSession);
                session()->setFlashData('success', 'Anda berhasil login');
                ?>
                <script>
                    document.location = "<?= base_url('/dashboard') ?>";
                </script>
                <?php
        }
        }
    }
}
