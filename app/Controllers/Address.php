<?php namespace App\Controllers;

use App\Models\AddressModel;
use CodeIgniter\Controller;

class Address extends Controller
{
    public function index()
    {
        $intOffset = $this->request->getGet("offset", "int") ?? 0;
        return view(
            'address/index',
            [
                'limit' => 12,
                'offset' => $intOffset,
                'search' => "",
                'hidden' => 0,
            ]
        );
    }

    public function data()
    {
        $intLimit = $this->request->getGet("limit", FILTER_VALIDATE_INT) ?? 0;
        $intOffset = $this->request->getGet("offset", FILTER_VALIDATE_INT) ?? 0;
        $strSearch = $this->request->getGet("search");
        $intHidden = $this->request->getGet("hidden", FILTER_VALIDATE_INT);

        $strAction = $this->request->getGet("action");

        switch ($strAction) {

            case "state":
                $intId = $this->request->getGet("id", FILTER_VALIDATE_INT);
                $blnDisabled = $this->request->getGet("disabled", FILTER_VALIDATE_BOOLEAN);
                $objAddressModel = new AddressModel();
                $objAddressModel
                    ->where('pk_id', $intId)
                    ->set(['disabled' => $blnDisabled ? 0 : 1])
                    ->update();
                break;

            case "navigate":
                $intPage = $this->request->getGet("page", FILTER_VALIDATE_INT) ?? 0;
                $intOffset = $intLimit * ($intPage - 1);
                break;

            case "showing":
                break;

            case "search":
                break;
        }

        return view_cell(
            '\App\Libraries\Address::render',
            [
                'limit' => $intLimit,
                'offset' => $intOffset,
                'hidden' => $intHidden,
                'search' => $strSearch
            ]
        );
    }

    public function edit($intId = null)
    {
        $objSalutationModel = new \App\Models\SalutationModel();
        $data['salutations'] = $objSalutationModel->orderBy('pk_id', 'asc')->findAll();

        if (is_null($intId)) {
            $data['address'] = new \App\Entities\Address();
            $data['title'] = "New Address";
        } else {
            $objAddressModel = new AddressModel();
            $data['address'] = $objAddressModel->find($intId);
            if (empty($data['address'])) {
                $data['address'] = new \App\Entities\Address();
                $data['title'] = "New Address";
            } else {
                $data['title'] = $data['address']->fullName();
            }
        }

        return view('address/edit', $data);
    }

    public function save()
    {
        $arrFields = $this->request->getGet();
        $intId = $arrFields["pk_id"];
        unset($arrFields["pk_id"]);
        $arrFields['fk_salutation_id'] = (int) $arrFields['fk_salutation_id'];
        $objAddressModel = new AddressModel();
        if ($intId) {
            $objAddressModel->update($intId, $arrFields);
        } else {
            $objAddressModel->insert($arrFields);
        }

        return json_encode(
            ['valid' => true] + $this->request->getGet()
        );
    }
}