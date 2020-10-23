import * as Validation from './validation.js'

$(document).ready(function() {

    const mprogress = new Mprogress({ template: 3 });

    const arrRequired = [
        'first_name',
        'last_name',
        'dob',
        'address_1',
        'city',
        'postcode',
        'tel',
        'email'
    ];

    const arrFields = $.merge(
        ['pk_id', 'fk_salutation_id', 'middle_name', 'address_2', 'address_3'],
        arrRequired
    );

    $("#cancel").click(function(e) {
        mprogress.start();
        window.location.href = "/public/address";
        return false;
    });

    $("#save").click(function(e) {
        e.preventDefault();
        mprogress.start();
        const blnValid = validateForm();
        if (blnValid) {
            const objData = {}
            $.each(arrFields, function (_, strName) {
                objData[strName] = $.trim($("*[name=" + strName + "]").val());
            });
            objData.postcode = objData.postcode.toUpperCase();
            $.get(
                '/public/address/save',
                objData,
                function(objResponse) {
                    if (objResponse.valid) {
                        window.location.href = "/public/address";
                    } else {
                        mprogress.end();
                    }
                },
                'json'
            );
        } else {
            mprogress.end();
        }
        return false;
    });

    $.each(arrRequired, function(_, strName) {
        $("input[name=" + strName + "]").keyup(function() {
            Validation.validateRequired($(this));
        });
    });

    $("input[name=postcode]").keyup(function(e) {
        Validation.validatePostcode($(this));
    });

    $("input[name=tel]").keyup(function(e) {
        Validation.validateTel($(this));
    });

    $("input[name=email]").keyup(function(e) {
        Validation.validateEmail($(this));
    });

    function validateForm()
    {
        let blnValid = true;
        $.each(arrRequired, function(_, strName) {
            blnValid &= Validation.validateRequired($("input[name=" + strName + "]"));
        });
        blnValid &= Validation.validatePostcode($("input[name=postcode]"));
        blnValid &= Validation.validateTel($("input[name=tel]"));
        blnValid &= Validation.validateEmail($("input[name=email]"));
        return blnValid;
    }
});
