<?php
class User extends Controller
{
    public function index ()
    {
        // head
        
        $data['judul'] = 'Daftar User';
        $data["users"] = $this->model("User_model")->getAllUsers();
        $this->view('templates/header',$data);
        $this->view('list',$data);
        // footer
        $this->view('templates/footer');
    }

    

    public function detail($id)
    {
        $data["judul"] = "Detail User";
        $data["user"] = $this->model("User_model")->getUserById($id);
                // head
        $this->view('templates/header',$data);
        $this->view('detail',$data);
                // footer
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $data["judul"] = "Tambah User";
        $this->view('templates/header',$data);
        $this->view('user/tambah');
        $this->view('templates/footer');
    }

    public function prosesTambah()
    {
        if ($this->model('User_model')->tambahDataUser($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'Data user berhasil ditambahkan.', 'success');
            header('Location: ' . BASEURL . '/user');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Data user gagal ditambahkan.', 'danger');
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }
    public function hapus($id)
    {
        if ($this->model('User_model')->hapusDataUser($id) > 0) {
            Flasher::setFlash('Berhasil', 'Data user berhasil dihapus.', 'success');
            header('Location: ' . BASEURL . '/user');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Data user gagal dihapus.', 'danger');
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }
    public function edit($id)
    {
        $data["user"] = $this->model("User_model")->getUserById($id);
        $data["judul"] = "Edit Data User : ".$data['user']['name'];
        // Ambil data user yang mau diedit
        $this->view('templates/header',$data);
        // Tampilkan view form edit
        $this->view('user/edit', $data);
        $this->view('templates/footer');
    }
    public function prosesEdit()
    {
        if ($this->model('User_model')->editDataUser($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'Data user berhasil diubah.', 'success');
            header('Location: ' . BASEURL . '/user');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Data user gagal diubah.', 'danger');
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }
}