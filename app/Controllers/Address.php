<?php namespace App\Controllers;

use App\Models\AddressModel;
use CodeIgniter\Controller;

class Address extends Controller
{
    /**
     * /address/
     * Displays the list of addresses.
     */
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

    /**
     * /address/data
     * Handles updates to the list of addresses.
     */
    public function data()
    {
        $intLimit = $this->request->getGet("limit", FILTER_VALIDATE_INT) ?? 0;
        $intOffset = $this->request->getGet("offset", FILTER_VALIDATE_INT) ?? 0;
        $strSearch = $this->request->getGet("search");
        $intHidden = $this->request->getGet("hidden", FILTER_VALIDATE_INT);

        $strAction = $this->request->getGet("action");

        switch ($strAction) {

            // Enabling/disablign a record
            case "state":
                $intId = $this->request->getGet("id", FILTER_VALIDATE_INT);
                $blnDisabled = $this->request->getGet("disabled", FILTER_VALIDATE_BOOLEAN);
                $objAddressModel = new AddressModel();
                $objAddressModel
                    ->where('pk_id', $intId)
                    ->set(['disabled' => $blnDisabled ? 0 : 1])
                    ->update();
                break;

            // Changing page
            case "navigate":
                $intPage = $this->request->getGet("page", FILTER_VALIDATE_INT) ?? 0;
                $intOffset = $intLimit * ($intPage - 1);
                break;

            // Changing visibility of disabled records
            case "showing":
                break;

            // Performing a search
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

    /**
     * /address/edit
     * Displays the edit form.
     */
    public function edit($intId = null)
    {
        // Populate an array of salutations
        $objSalutationModel = new \App\Models\SalutationModel();
        $data['salutations'] = $objSalutationModel->orderBy('pk_id', 'asc')->findAll();

        // If we are adding
        if (is_null($intId)) {
            $data['address'] = new \App\Entities\Address();
            $data['title'] = "New Address";

        // We are editing
        } else {

            // Populate our model
            $objAddressModel = new AddressModel();
            $data['address'] = $objAddressModel->find($intId);

            // If the slug is invalid just show the add form
            if (empty($data['address'])) {
                $data['address'] = new \App\Entities\Address();
                $data['title'] = "New Address";
            } else {
                $data['title'] = $data['address']->fullName();
            }
        }

        return view('address/edit', $data);
    }

    /**
     * /address/edit
     * Handles the ajax call to save data from the edit form.
     */
    public function save()
    {
        // Get the array of fields
        $arrFields = $this->request->getGet();

        // Tidy our array of data
        $intId = $arrFields["pk_id"];
        unset($arrFields["pk_id"]);
        $arrFields['fk_salutation_id'] = (int) $arrFields['fk_salutation_id'];

        /*
            We should probably do some server-side validation here.
            The json format is used for the response on the idea that an array
            of errors may be passed back as part of an "invalid" response.
        */

        // Update database
        $objAddressModel = new AddressModel();
        if ($intId) {
            $objAddressModel->update($intId, $arrFields);
        } else {
            $objAddressModel->insert($arrFields);
        }

        // Return a response to the form
        return json_encode(
            ['valid' => true] + $this->request->getGet()
        );
    }
}