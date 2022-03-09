<?= $this->extend('layouts/admin')?>
<?= $this->section('content')?>
    <?php
        if(session()->getFlashdata('success')){
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success')?>
        <button type="button" class="close" data-dismiss="alert" aria-label="close">Succes</button>
    </div>
    <?php
        }
    ?>
<div class="container">
    <h3>Data User</h3>
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addUser">Tambah Data</button>

    <table class="table table-bordered">
        <thead>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
           
            <th>Jenis Kelamin</th>
            <th>Jenis</th>
            <th>Option</th>
        </thead>
        <tbody>
            <?php
            $no=1;
            foreach($data as $row):
            ?>
            <tr>
                <td><?=$no?></td>
                <td><?=$row['nama']?></td>
                <td><?=$row['username']?></td>
                
                <td><?=$row['jenis_kelamin']?></td>
                <td><?=$row['jenis']?></td>
                <td><a href="#" class="btn btn-info btn-sm btn-edit" data-toggle="modal" data-target="#editUser-<?=$row['id']?>">Edit</a>
                <a href="<?= base_url('UserController/delete/'.$row['id'])?>" onclick="return confirm('Yakin Akan dihapus')" class="btn btn-danger btn-sm btn-delete">Hapus</a></td>
            </tr>

            <form action="<?= base_url('user/edit/'.$row['id'])?>" method="post">
    <div class="modal fade" id="editUser-<?=$row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url('user')?>" method="post">
                <div class="modal-body">

                    <div class="form-group">
                    <label for="nama">nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama User" value="<?=$row['nama']?>">
                    </div>

                    <div class="form-group">
                    <label for="username">username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" value="<?=$row['username']?>">
                    </div>

                    <div class="form-group">
                    <label for="password">Password</label>
                        <input type="text" class="form-control" name="password" placeholder="Password">
                    </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                    <option value="L">Laki-Laki</option>
                                    <option value="p">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=jenis>Jenis</label>
                                <select name=jenis id=jenis class="form-control">
                                    <option value=admin>Admin</option>
                                    <option value=kasir>Kasir</option>
                                    <option value=manager>Manager</option>
                                </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        $no++;
        endforeach
        ?>
        </tbody>
</table>
</div>

    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url('user')?>" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama User</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama User">
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" name="password" placeholder="Password">
                    </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=jenis>Jenis</label>
                                <select name=jenis id=jenis class="form-control">
                                    <option value=admin>Admin</option>
                                    <option value=kasir>Kasir</option>
                                    <option value=manager>Manager</option>
                                </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

</table>
<?= $this->endSection()?>
