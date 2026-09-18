<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            
            <div class="row mb-3 align-items-end">
                <div class="col-md-4">
                    <label>Filter Lembaga:</label>
                    <select id="filterLembaga" class="form-control">
                        <option value="">Semua Lembaga</option>
                        <?php foreach($data_lembaga as $lembaga): ?>
                            <option value="<?= $lembaga['nama_lembaga']; ?>"><?= $lembaga['nama_lembaga']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-8 text-md-right mt-3 mt-md-0">
                    <a href="<?= base_url('/siswa/tambahData') ?>" class="btn btn-success shadow-sm">
                        Tambah Data
                    </a>
                </div>
            </div>

            <!-- Tabel Data Siswa -->
            <div class="table-responsive">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Email</th>
                            <th>Lembaga</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach($dataSiswa as $data){
                        ?>
                        <tr>
                            <td><?= ++$no ?></td>
                            <td><?= $data['nama_siswa'] ?></td>
                            <td><?= $data['nis'] ?></td>
                            <td><?= $data['email_siswa'] ?></td>
                            <td><?= $data['nama_lembaga'] ?></td>
                            <td><img src="<?= base_url('img/' . $data['foto_siswa']) ?>" alt="Foto Siswa" width="100"></td>
                            <td>
                                <a href="<?= base_url('/siswa/editSiswa/' . sha1($data['id_siswa'])) ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger" onclick="doDelete('<?= sha1($data['id_siswa']) ?>')">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    function doDelete(idDelete){
        swal({
            title : "Hapus Data Siswa?",
            text : "YAKIN MAU HAPUS NIH??!!!",
            icon : "warning",
            buttons : true,
            dangerMode : false,
        })
        .then(ok => {
            if(ok){
                window.location.href = '<?= base_url();?>/siswa/hapus-siswa/' + idDelete;
            }
            else{
                $(this).removeAttr('disabled')
            }
        })
    }
</script>