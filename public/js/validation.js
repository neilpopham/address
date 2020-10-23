export function validateRequired(objElement)
{
    return addError(objElement, objElement.val().length > 0);
}

export function validatePostcode(objElement)
{
    return addError(objElement, isValidPostcode(objElement.val()));
}

export function validateTel(objElement)
{
    return addError(objElement, isValidTel(objElement.val()));
}

export function validateEmail(objElement)
{
    return addError(objElement, isValidEmail(objElement.val()));
}

export function isValidPostcode(strValue) {
    strValue = strValue.replace(/\s/g, "");
    var re = /^[A-Z]{1,2}[0-9][A-Z0-9]? ?[0-9][A-Z]{2}$/i;
    return re.test(strValue);
}

export function isValidTel(strValue)
{
    strValue = strValue.replace(/\s/g, "");
    var re = /^\d+$/;
    return re.test(strValue);
}

export function isValidEmail(strValue)
{
    strValue = strValue.replace(/\s/g, "");
    var re = /^[^@]+@[^\.]+\..+$/;
    return re.test(strValue);
}

export function addError(objElement, blnValid)
{
    if (blnValid) {
        objElement.removeClass("error");
    } else {
        objElement.addClass("error");
    }
    return blnValid;
}
