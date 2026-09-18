<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
// $routes->get('/login', 'Home::login_page');
$routes->get('/login', 'Login::login_page');
$routes->get('/logout', 'Login::logout');
$routes->post('/auth/autentikasi', 'Login::autentikasi');
$routes->post('/siswa/simpan-siswa', 'Siswa::simpan_siswa');
$routes->post('/siswa/update-siswa', 'Siswa::update_siswa');
$routes->get('/siswa/hapus-siswa/(:any)', 'Siswa::hapus_siswa/$1');

$routes->get('/dashboard', 'Dashboard::dashboard');
$routes->get('/profile', 'User::profile');
$routes->get('/siswa', 'Siswa::siswa_page');
$routes->get('/siswa/tambahData', 'Siswa::tambah_data');
$routes->get('/siswa/editSiswa/(:any)', 'Siswa::edit_siswa/$1');
