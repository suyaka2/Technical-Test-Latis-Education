                <div class="container-fluid">
			 <h3>Edit Data Siswa</h3>
			    <hr />
				<form action="<?php echo base_url('/siswa/update-siswa');?>" method="post" enctype="multipart/form-data">
					<div class="form-group col-md-6">
                        <label>Nama Siswa</label>
                        <input type="text" class="form-control" name="nama_siswa" value="<?= $data_siswa['nama_siswa'];?>" placeholder="Masukkan Nama Siswa" required="required">
                    </div>
                    <div style="clear:both;"></div>

                    <div class="form-group col-md-6">
                        <label>NIS</label>
                        <input type="number" class="form-control" name="nis" value="<?= $data_siswa['nis'];?>" placeholder="Masukkan Nama Pengarang" required="required">
                    </div>
                    <div style="clear:both;"></div>

                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $data_siswa['email_siswa'];?>" placeholder="Masukkan Penerbit" required="required">
                    </div>
                    <div style="clear:both;"></div>

                

                   


                    <div class="form-group col-md-6">
                        <label>Lembaga</label>
                        <select class="form-control" name="lembaga" required="required">
                        	<option value="">-- Pilih Lembaga --</option>
								<?php
								foreach($data_lembaga as $dataLembaga){
									if($dataLembaga['id_lembaga']==$data_siswa['id_lembaga']) {
										$sel="selected";
									}
									else {
										$sel="";
									}
								?>
								<option value="<?= $dataLembaga['id_lembaga']; ?>"<?= $sel;?>><?= $dataLembaga['nama_lembaga']; ?></option>
								<?php } ?>
							</select>
                    </div>
                    <div style="clear:both;"></div>

                    
                    
                  

                   
                        
                    <div class="form-group col-md-2">
                        <label>Foto Profile</label>
                        <img  src="/img/<?=$data_siswa['foto_siswa']?>" width="200%" >
                        <input type="file" class="form-control" accept=".png,.jpg" name="foto_profile" width="200%" >
						<em>Format file yang diizinkan : jpg, png</em>
                        <em>Maksimal ukuran 1 MB</em>
                    </div>
                    <div style="clear:both;"></div>
					

                    

                    <div class="form-group col-md-6">
	                    <button type="submit" class="btn btn-primary">Update</button>
						<a href="<?= base_url('/siswa');?>"><button type="button" class="btn btn-danger">Batal</button></a>
					</div>
					<div style="clear:both;"></div>
				</form>

				</div>


			   