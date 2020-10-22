<?php namespace App\Entities;

use CodeIgniter\Entity;

class Address extends Entity
{
    public $salutation;

    public function setSalutation($intId = null)
    {
        if (is_null($intId)) {
            $intId = $this->fk_salutation_id;
        }
        $objSalutationModel = new \App\Models\SalutationModel();
        $objSalutation = $objSalutationModel->find($this->fk_salutation_id);
        $this->salutation = $objSalutation->value ?? "";
        return $this->salutation;
    }

    public function fullName()
    {
        return self::concat(
            [
                $this->salutation,
                $this->first_name,
                $this->middle_name,
                $this->last_name
            ]
        );
    }

    public function fullAddress($strJoin = ", ")
    {
        return self::concat(
            [
                $this->address_1,
                $this->address_2,
                $this->address_3,
                $this->city,
                $this->postcode
            ],
            $strJoin
        );
    }

    protected static function concat($arrData, $strJoin = " ")
    {
        return implode($strJoin, array_filter($arrData));
    }
}