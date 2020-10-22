$(document).ready(function() {

    if (console) console.log("edit.js");

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
            validateRequired($(this));
        });
    });

    $("input[name=postcode]").keyup(function(e) {
        validatePostcode($(this));
    });

    $("input[name=tel]").keyup(function(e) {
        validateTel($(this));
    });

    $("input[name=tel]").keyup(function(e) {
        validateTel($(this));
    });

    $("input[name=email]").keyup(function(e) {
        validateEmail($(this));
    });

    function validateForm()
    {
        let blnValid = true;
        $.each(arrRequired, function(_, strName) {
            blnValid &= validateRequired($("input[name=" + strName + "]"));
        });
        blnValid &= validatePostcode($("input[name=postcode]"));
        blnValid &= validateTel($("input[name=tel]"));
        blnValid &= validateEmail($("input[name=email]"));
        return blnValid;
    }

    function validateRequired(objElement)
    {
        return addError(objElement, objElement.val().length > 0);
    }

    function validatePostcode(objElement)
    {
        return addError(objElement, isValidPostcode(objElement.val()));
    }

    function validateTel(objElement)
    {
        return addError(objElement, isValidTel(objElement.val()));
    }

    function validateEmail(objElement)
    {
        return addError(objElement, isValidEmail(objElement.val()));
    }

    function isValidPostcode(strValue) {
        strValue = strValue.replace(/\s/g, "");
        var re = /^[A-Z]{1,2}[0-9][A-Z0-9]? ?[0-9][A-Z]{2}$/i;
        return re.test(strValue);
    }

    function isValidTel(strValue)
    {
        strValue = strValue.replace(/\s/g, "");
        var re = /^\d+$/;
        return re.test(strValue);
    }

    function isValidEmail(strValue)
    {
        strValue = strValue.replace(/\s/g, "");
        var re = /^[^@]+@[^\.]+\..+$/;
        return re.test(strValue);
    }

    function addError(objElement, blnValid)
    {
        if (blnValid) {
            objElement.removeClass("error");
        } else {
            objElement.addClass("error");
        }
        return blnValid;
    }

});
