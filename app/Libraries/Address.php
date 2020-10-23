<?php namespace App\Libraries;

use App\Models\AddressModel;

class Address
{
    public function render(array $arrParams = [])
    {
        $objConn = \Config\Database::connect();
        $objAddressModel = new AddressModel();

        $arrParams['hidden'] = $arrParams['hidden'] ?? 0;
        $arrParams['search'] = $arrParams['search'] ?? "";

        // Filter records
        $strWhere = "";
        if ($arrParams['hidden']) {
            $strWhere .= "disabled = 0";
        }
        if ($arrParams['search']) {
            $strSearch = $objConn->escapeLikeString(strtolower($arrParams['search']));
            $strWhere .= (empty($strWhere) ? "" : " AND ") . "(";
            $arrLikes = [];
            foreach (['first_name', 'middle_name', 'last_name', 'city', 'email'] as $strField) {
                $arrLikes[] = "LOWER({$strField}) LIKE '%{$strSearch}%'"; //  ESCAPE '!'";
            }
            $strWhere .= implode(" OR ", $arrLikes) . ")";
        }

        // Get array of records
        if (empty($strWhere)) {
            $arrParams['data'] = $objAddressModel
                ->orderBy('last_name ASC, first_name ASC, middle_name ASC')
                ->findAll($arrParams['limit'], $arrParams['offset']);
        } else {
            $arrParams['data'] = $objAddressModel
                ->orderBy('last_name ASC, first_name ASC, middle_name ASC')
                ->where($strWhere)
                ->findAll($arrParams['limit'], $arrParams['offset']);
            $strWhere = "WHERE {$strWhere}";
        }

        // Get count of all records
        $objQuery = $objConn->query("SELECT COUNT(1) AS total FROM tbl_address {$strWhere}");

        // Add some pgination variables
        $arrParams['count'] = count($arrParams['data']);
        $arrParams['total'] = $objQuery->getRow('total');

        // Return the view
        return view('address/data', $arrParams);
    }

    /**
     * Adds some additional pagination variables.
     */
    public function pagination(array $arrParams = [])
    {
        return view('pagination', Pagination::parse($arrParams));
    }
}