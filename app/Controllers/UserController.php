<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
//use CodeIgniter\HTTP\request;

class UserController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    function __construct()
    {
        $this->users= new UserModel();
    }
    public function tampil()
        {
        # code...
        //$users= new UserModel();
        $data['data']= $this->users->findAll();
        return view('user', $data);
    }
    public function create()
    {
        # code...
        $data = array(
            'nama'=>$this->request->getPost('nama'),
            'username'=>$this->request->getPost('username'),
            'password'=>password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
            'jenis_kelamin'=>$this->request->getPost('jenis_kelamin'),
            'jenis'=>$this->request->getPost('jenis'),
        );
        $this->users->insert($data);
    return redirect('user')->with('success','data berhasil disimpan');
    }
    public function delete($id)
    {
        # code...
        $this->users->delete($id);
        return redirect('user')->with('success','data berhasil dihapus');
    }
    public function edit($id)
    {
        # code...
        $data = array(
            'nama'=>$this->request->getPost('nama'),
            'username'=>$this->request->getPost('username'),
            'password'=>password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
            'jenis_kelamin'=>$this->request->getPost('jenis_kelamin'),
            'jenis'=>$this->request->getPost('jenis'),
        );
        $this->users->update($id,$data);
    return redirect('user')->with('success','data berhasil diedit');
    }
    public function tlogin()
    {
        return view('login');
    }
    public function login()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $data = $this->users->where('username', $username)->first();
        if ($data) {
            $pass = $data['password'];
            $cek_pass = password_verify($password,$pass);
            if ($cek_pass) {
                $ses_data= [
                    'id' => $data['id'],
                    'username'=> $data['username'],
                    'jenis'=> $data['jenis'],
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            }else{
                $session->getFlashdata('msg', 'username tidak ditemukan');
                return redirect('tlogin');
            }
        }else{
                $session->getFlashdata('msg', 'username tidak ditemukan');
                return redirect('tlogin');
        }
    }
    public function logout()
    {
        # code...
        $session = session();
        $session ->destroy();
        return redirect('login');
    }
    public function show()
    {
        # code...
    }

}