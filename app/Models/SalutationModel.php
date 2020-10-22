<?php namespace App\Models;

use CodeIgniter\Model;

class SalutationModel extends Model
{
    protected $table = 'tbl_salutation';
    protected $primaryKey = 'pk_id';
    protected $returnType = 'object';
}