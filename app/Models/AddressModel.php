<?php namespace App\Models;

use CodeIgniter\Model;

class AddressModel extends Model
{
    protected $table = 'tbl_address';
    protected $primaryKey = 'pk_id';
    protected $allowedFields = [
        'fk_salutation_id',
        'first_name',
        'middle_name',
        'last_name',
        'address_1',
        'address_2',
        'address_3',
        'city',
        'postcode',
        'tel',
        'email',
        'disabled'
    ];
    protected $returnType = '\App\Entities\Address';
    protected $afterFind = ['setSalutation'];

    protected function setSalutation($data)
    {
        if (is_array($data['data'])) {
            foreach ($data['data'] as &$objAddress) {
                $objAddress->setSalutation();
            }
        } else {
            $data['data']->setSalutation();
        }
        return $data;
    }
}