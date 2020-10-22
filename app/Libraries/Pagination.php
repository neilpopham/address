<?php namespace App\Libraries;

class Pagination
{
    /*
        For now I'll ignore the ellipsis,
        but as the address book gets larger we'll need to reduce the $arrParams['page'] array
        to a fixed number, and indicate that one item should be an ellipsis.
    */
    public static function parse($arrParams)
    {
        $arrParams['current'] = $arrParams['offset'] ? $arrParams['offset'] / $arrParams['limit'] + 1 : 1;
        $arrParams['pages'] = ceil($arrParams['total'] / $arrParams['limit']);

        $arrParams['page'] = [];
        for ($i = 1; $i <= $arrParams['pages']; $i++) {
            $arrParams['page'][$i] = $i == $arrParams['current'];
        }

        return $arrParams;
    }
}