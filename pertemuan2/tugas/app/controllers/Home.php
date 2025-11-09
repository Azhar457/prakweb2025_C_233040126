<?php

class Home extends Controller
{

    public function index()
    {
        $data['judul'] = 'Home';
        $data['nama'] =  "Azhar";
        // head
        $this->view('templates/header', $data);

        $this->view('home/index', $data);

        // footer
        $this->view('templates/footer');
    }
}
