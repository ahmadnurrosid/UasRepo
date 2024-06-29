<table class="table table-sm table-striped" id="datamahasiswa">
    <thead>
        <tr>
            <th>No</th>
            <th>Nim</th>
            <th>Nama Lengkap</th>
            <th>Tempat - Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 0;
        foreach ($tampildata as $row) : $nomor++; ?>
            <tr>
                <td><?= $nomor; ?></td>
                <td><?= $row['nim'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['tmptlahir'] ?> - <?= $row['tgllahir'] ?></td>
                <td><?= $row['jenkel'] ?></td>
                <td>
                <button type="button" class="btn btn-info btn-sm" onclick="edit
            ('<?= $row['id_mahasiswa'] ?>')"><i class="fa fa-tags"></i></button>
                |<button type="button" class="btn btn-danger btn-sm" onclick="hapus
            ('<?= $row['id_mahasiswa'] ?>')"><i class="fa fa-trash"></i></button>
            </tr>
        <?php endforeach; ?>  
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#datamahasiswa').DataTable(); // Initialize DataTable
    });
    function edit(id_mahasiswa){
        $.ajax({
            type:"post",
            url: "<?= site_url('mahasiswa/formedit') ?>",
            data: {
                id_mahasiswa: id_mahasiswa
            },
            dataType: "json",
            success: function(response){
                if( response.sukses){
                    $('.viewmodal').html(response.sukses).show();
                    $('#modeledit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        });
    }
    function hapus(id_mahasiswa){
        Swal.fire({
            title:"hapus ?",
            text:"yakin mau di hapus !",
            icon:"warning",
            showCancelButton:true,
            confirmButtonColor:"#3085d6",
            cancelButtonColor:"#d33",
            confirmButtonText:"Ya",
            cancelButtonText:'Tidak',
    }).then((result)=>{
        if (result.isConfirmed){
            $.ajax({
                type:"post",
                url:"<?= site_url('mahasiswa/hapus')?>",
                data:{
                     id_mahasiswa: id_mahasiswa
                },
                dataType:"json",
                success:function(response){
                    if(response.sukses){
                        Swal.fire({
                        icon:"success",
                        title:"berhasil",
                        text:response.sukses,
                     })
                     datamahasiswa();
                    }
                },
                error: function(xhr, ajaxOption, thrownError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
            })
        }
    }

    )
}
</script>

