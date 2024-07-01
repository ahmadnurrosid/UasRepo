<div class="modal fade" id="modeledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('Mahasiswa/updatedata', ['class' => 'formmahasiswa']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                    <div class="col-sm-10">

                        <input type="hidden" class="form-control is-valid" 
                        id="id_mahasiswa" name="id_mahasiswa" placeholder="Masukan NIM"
                         value="<?= $id_mahasiswa ?>" readonly>
                        <input type="text" class="form-control is-valid" 
                        id="nim" name="nim" placeholder="Masukan NIM" 
                        value="<?= $nim ?>" >
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">NAMA</label>
                    <div class="col-sm-10">
                    
                        <input type="text" class="form-control is-valid" 
                        id="nama" name="nama" placeholder="Masukan Nama Lengkap" 
                        value="<?= $nama ?>" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tmplahir" class="col-sm-2 col-form-label">Tempat & tanggal lahir</label>
                    <div class="col-sm-5">
                   
                        <input type="text" class="form-control is-valid" 
                        id="tmplahir" name="tmplahir" placeholder="Masukan Tempat Lahir" 
                        value="<?= $tmplahir ?>" >
                    </div>
                    <div class="col-sm-5">
                  
                        <input type="text" class="form-control is-valid" 
                        id="tgllahir" name="tgllahir" placeholder="Masukan tanggal lahir" 
                        value="<?= $tgllahir ?>" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenkel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select name="jenkel" id="jenkel" class="form-control is-valid">
                            <option value="">------Silahkan Pilih------</option>
                            <option value="Laki-Laki" <?php if ($jenkel == 'Laki-Laki') echo
                            "selected"; ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php if ($jenkel == 'Perempuan') echo
                            "selected"; ?>>Perempuan</option>
                        </select>
                        <div class="invalid-feedback errorjenkel"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan" id ="tombolsimpan">update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<div class="position-fixed align-items-center" style="position :absolute;
top: 50%;
left: 50%;">
<div id="liveToast" class="toast hide" role="alert" aria-live="assertive"
aria-atomic="true" data-delay="2000">
<div class="toast-header">
    <strong class="mr-auto">Simpan</strong>
    <button type="button" class="nl-2 mb-1 close" data-dismiss="toast"
    aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="toast-body">Data berhasil disimpan!!!</div>
</div>
</div>

<script>
    $(document).ready(function(){
        $('.formmahasiswa').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function(){
                    $('.btnsimpan').attr('disabled', 'disabled');
                    $('.btnsimpan').html('<i class="bi bi-arrow-repeat"></i>');
                },
                complete: function(){
                    $('.btnsimpan').removeAttr('disabled');
                    $('.btnsimpan').html('update');
                },
                success: function(response){
                    
                        Swal.fire({
                            icon: "success",
                            title: "Berhasi",
                            text: response.sukses,
                        });

                        // jika tidak ada error, modal akan ditutup
                        $('#modeledit').modal('hide');
                       
                        // bisa tambahkan aksi lain seperti reload table data
                    datamahasiswa();
                    
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>
