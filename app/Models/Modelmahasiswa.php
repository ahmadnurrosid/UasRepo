<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelmahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    protected $useAutoIncrement = true;

    //field yang wajib diisi
    protected $allowedFields =['nim','nama','tmptlahir','tgllahir','jenkel'];
}
?>