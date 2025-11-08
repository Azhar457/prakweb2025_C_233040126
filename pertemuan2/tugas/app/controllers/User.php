<?php
class user extends Controller
{
    public function index ()
    {
        $data["judul"] = "Data User";
        $data["users"] = $this->model("User_model")->getAllUsers();
        $this->view('list',$data);
    }

    public function detail($id)
    {
        $data["judul"] = "Detail User";
        $data["users"] = $this->model("User_model")->getUserById($id);
        $this->view('detail',$data);
    }
}