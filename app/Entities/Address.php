<?php namespace App\Entities;

use CodeIgniter\Entity;

class Address extends Entity
{
    public $salutation;
    protected static $salutations;

    /**
     * Sets the salutation property from a salutation id.
     */
    public function setSalutation($intId = null)
    {
        if (is_null($intId)) {
            $intId = $this->fk_salutation_id;
        }

        // Use a static array so we don't hit the database too often on a findAll.
        if (is_null(self::$salutations)) {
            $objSalutationModel = new \App\Models\SalutationModel();
            $arrSalutations = $objSalutationModel->orderBy('pk_id', 'asc')->findAll();
            self::$salutations = [];
            foreach ($arrSalutations as $objSalutation) {
                self::$salutations[$objSalutation->pk_id] = $objSalutation->value;
            }
        }

        // Get our string from our static array
        $this->salutation = self::$salutations[$intId] ?? null;

        return $this->salutation;
    }

    /**
     * Returns the full name ([salution] [first] [middle] [last]).
     */
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

    /**
     * Returns the full address as a string.
     */
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

    /**
     * Reduces an array to populated values and concatenates them to a string.
     */
    protected static function concat($arrData, $strJoin = " ")
    {
        return implode($strJoin, array_filter($arrData));
    }
}