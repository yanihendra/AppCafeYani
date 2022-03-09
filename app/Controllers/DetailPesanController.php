<?= $this->extend('layouts/admin')?>
<?= $this->section('content')?>
<div class="container">
    <div class="card">
        <div class="card-tittle">
    <h3>Tambah Menu</h3>
</div>
</div>
<div class="card-body">
    <form action="" method="post">

</form>
</div>
<div class="card-body">
    <div class="card-footer">
</div>
</div>
    <button type="button" class="btn btn-secondary mb-2" data-toggle="modal" data-target="#addDetailPesanan">Tambah Data</button>

    <table class="table table-striped">
        <thead>
            <th>No</th>
            <th>Id Pesan</th>
            <th>Id Menu</th>
            <th>Jumlah</th>
            <th>Option</th>
        </thead>
        <tbody>
            <?php
            $no=1;
            foreach($ddetailpesan as $row):
            ?>
            <tr>
                <td><?=$no?></td>
                <td><?=$row['id_pesan']?></td>
                <td><?=$row['id_menu']?></td>
                <td><?=$row['jumlah']?></td>
                <td><a href="" class="btn btn-info btn-sm btn-edit">Edit</a>
                <a href="" class="btn btn-danger btn-sm btn-hapus">Hapus</a></td>
            </tr>
            <?php
            $no++;
            endforeach?>
        </tbody>
</table>
</div>
<form action="/DetailPesananController/save" method="post">
    <div class="modal fade" id="addDetailPesanan" tabindex="-1" role="dialog" aria-labelledby="exampModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Detail Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Id Pesan</label>
                        <input type="text" class="form-control" name="id_pesan" placeholder="Id Pesan">
                    </div>

                    <div class="form-group">
                        <label>Id Menu</label>
                        <input type="text" class="form-control" name="id_menu" placeholder="Id Menu">
                    </div>

                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" class="form-control" name="jumlah" placeholder="Jumlah">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-btn secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn-btn primary">Save</button>
                    </div>
                       
            </div>
        </div>
    </div>
</div>
</form>
<?= $this->endSection()?>