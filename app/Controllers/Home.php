<?php namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        //phpinfo(); exit;
        //print '<pre>'; print_r($this->request); exit;

        //exit("HERE");

        //$objAddressModel = new \App\Models\AddressModel();

        //$objAddress = $objAddressModel->first(); //$objAddressModel->asArray()->first();

        //return view('list', ['address' => $objAddress]);

        //print '<pre>'; print_r($objAddress); exit;

        //$x = $objAddressModel->find(1);
        //print '<pre>'; print_r($x); exit;
        //$x = $objAddressModel->first();

        //$arrAddresses = $objAddressModel->findAll();

        //print '<pre>';
        //print_r($arrAddresses);
        //print_r($objAddress);
        //exit;

        /*
        foreach ($arrAddresses as $objAddress) {
            print $objAddress->salutation(123);
            print "\n";
            print $objAddress->first_name;
            print "\n";
        }
        */

        //exit;


        //$db = \Config\Database::connect();

        //print '<pre>'; print_r($db); exit;
        //$query = $db->query('SELECT * FROM tbl_address ORDER BY pk_id');

        //print '<pre>'; print_r($query); exit;

        /*
        foreach ($query->getResult() as $row)
        {

            echo $row->first_name;
            echo $row->last_name;
            echo $row->middle_name;

        }
        */

        return view('welcome');
    }

    //--------------------------------------------------------------------

}
