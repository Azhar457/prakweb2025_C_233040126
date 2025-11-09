<?php
class User extends Controller
{
    public function index ()
    {
        $data["judul"] = "user";
        $data["users"] = $this->model("User_model")->getAllUsers();
        $this->view('list',$data);
    }

    

    public function detail($id)
    {
        $data["judul"] = "Detail User";
        $data["user"] = $this->model("User_model")->getUserById($id);
        $this->view('detail',$data);
    }
}