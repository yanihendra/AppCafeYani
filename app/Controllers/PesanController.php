<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MenuModel;
use App\Models\PesanModel;
//use App\Models\DetailPesananModel;
use CodeIgniter\HTTP\Request;

class PesanController extends Controller{
    /**
     * Instance of the main Request object. 
     * 
     * @var HTTP\incomingRequest
     */
    protected $request;

    function __construct()
    {
        $this->menu = new MenuModel();
        $this->session = session();
        $this->pesan = new PesanModel();
        //$this->detail = new DetailPesananModel();
    }
    public function index()
    {
        $data['data']= $this->menu->select('id, nama')->findAll();
        if(session('cart')!=null)
        {
            $data['menu']=array_values(session('cart'));
        }else{
            $data['menu']=null;
        }
        return view('pesan', $data);
    }
    public function addCart()
    {
        $id = $this->request->getPost('id_menu');
        $jumlah = $this->request->getPost('jumlah');
        $menu=$this->menu->find($id);
        if($menu) {
        }
        $isi= array(
            'id_menu'=>$id,
            'nama'=> $menu['nama'],
            'harga'=>$menu['harga'],
            'jumlah'=>$jumlah
        );

        if($this->session->has('cart')){
            $index=$this->cek($id);
            $cart=array_values(session('cart'));
            if($index == -1) {
                array_push($cart, $isi);
            }else{
                $cart[$index]['jumlah']+=$jumlah;
            }
            $this->session->set('cart', $cart);
    }else{
        $this->session->set('cart', array($isi));
    }
    return redirect('pesan')->with('success', 'Data berhasil ditambahkan');    
    }

    public function cek($id)
    {
        $cart = array_values(session('cart'));
        for($i=0; $i < count($cart); $i++){
            if($cart[$i]['id_menu'] == $id){
                return $i;
            }
        }

        
        return -1;
    }
    public function hapusCard($id)
    {
        # code...
        $index = $this->cek($id);
        $cart = array_values(session('cart'));
        unset($cart [$index]);
        $this->session->set('cart', $cart);
        return redirect('pesan')->with('success', "data berhasil dihapus");
    }
    public function simpan()
    {
        if(session('cart') !=null){
            $datapesan = array(
                'tanggal'=>date('Y/m/d'),
                'id_user'=>1,
                'no_meja'=>$this->request->getPost('no_meja'),
                'nama_pemesan'=>$this->request->getPost('nama_pemesan'),
                'total_harga'=>'0'
            );
            $id= $this->pesan->insert($datapesan);
            $cart= array_values(session('cart'));

            $tharga=0;
            foreach($cart as $val) {
                $datadetail = array(
                    'pesanan_id'=>$id,
                    'id_menu'=>$val['id_menu'],
                    'jumlah'=>$val['jumlah'],
                );
                $tharga +=$val['jumlah']*$val['harga'];
                //$this->detail->insert($datadetail);
           }
           $dtharga= array(
                'total_harga'=>$tharga
            );
            $this->pesan->update($id, $dtharga);
           $this->session->remove('cart');
           return redirect('pesan')->with('success', 'Data berhasil disimpan');
        }
    }
}