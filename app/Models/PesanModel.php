<?php 
namespace App\Models;

use CodeIgniter\Model;

class PesanModel extends Model{
    protected $table      = 'tb_pesan';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_menu','nama', 'id_user', 'tanggal', 'no_meja', 'total_harga', 'nama_pemesan'];
}