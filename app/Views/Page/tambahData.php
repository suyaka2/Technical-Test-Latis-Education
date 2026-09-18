                <div class="container-fluid">
<form action="<?= base_url('/siswa/simpan-siswa') ?>" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleFormControlInput1">Nama Siswa</label>
    <input type="text" class="form-control" name="nama_siswa" id="exampleFormControlInput1" placeholder="Silahkan Isi Nama Siswa" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">NIS</label>
    <input type="number" class="form-control" name="nis" id="exampleFormControlInput1" placeholder="Silahkan Isi NIS" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="Silahkan Isi Email" required>
  </div>
  <div class="custom-file">
  <input type="file" class="custom-file-input" name="foto_profile" id="customFile">
  <label class="custom-file-label" for="customFile">Choose file</label>
</div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Example select</label>
     <select name="lembaga"  class="form-control">
                            <option value="">Pilih Lembaga</option>
                            <?php
                            foreach($data_lembaga as $dataLembaga){                    
                            ?>
                            <option value="<?= $dataLembaga['id_lembaga'];?>"><?= $dataLembaga ['nama_lembaga'];?></option>
                            <?php } ?>
                         </select>
  </div>

 <button class="btn btn-primary" type="submit">Submit form</button>
</form>
              </div>


