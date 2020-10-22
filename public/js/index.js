$(document).ready(function() {

    if (console) console.log("index.js");

    var mprogress = new Mprogress({ template: 3 });
    var strSearch = $('#search').val();
    var intSearch = null;

    $('#add, .edit')
        .click(function(e) {
            mprogress.start();
        });

    $('#search')
        .keyup(function(e) {
            $('#clear').prop("disabled", $(this).val().length == 0);
            clearInterval(intSearch);
            if ($(this).val().length > 1 || ($(this).val().length == 0 && strSearch.length)) {
                strSearch = $(this).val();
                intSearch = setTimeout(startSearch, strSearch ? 1000 : 0);
            }
        });

    $('#clear')
        .click(function(e) {
            $('#search').val("").keyup();
        });

    $('#showing')
        .change(function(e) {
            let objData = addCore(
                {
                    action: 'showing',
                    hidden: $(this).val(),
                    offset: 0,
                }
            );
            doAjax(objData);
        });

    $('#container')
        .on("click", ".button.state", function() {
            let objData = addCore(
                {
                    action: 'state',
                    id: $(this).data("id"),
                    disabled: $(this).data("disabled")
                }
            );
            doAjax(objData);
        })
        .on("click", ".button.edit.disabled", function(e) {
            e.preventDefault();
            return false;
        })
        .on("click", "nav a", function(e) {
            e.preventDefault();
            let objData = addCore(
                {
                    action: 'navigate',
                    page: $(this).data("page")
                }
            );
            doAjax(objData);
            return false;
        });

    function doAjax(objData, objCallback)
    {
        $.get(
            '/public/address/data',
            objData,
            function(strHtml) {
                $('#container')
                    .html(strHtml);
                $('#addresses')
                    .data("offset", $("ul.pagination").data("offset"));
                if (objCallback) {
                    objCallback.apply();
                }
            },
            'html'
        );
    }

    function addCore(objData)
    {
        return $.extend(
            {},
            {
                limit: $('#addresses').data("limit"),
                offset: $('#addresses').data("offset"),
                search: $('#search').val(),
                hidden: $('#showing').val(),
            },
            objData
        );
    }

    function startSearch()
    {
        let objData = addCore(
            {
                action: 'search',
                search: strSearch,
                offset: 0,
            }
        );
        $('#search').addClass("waiting");
        mprogress.start();
        doAjax(objData, function() { $('#search').removeClass("waiting"); mprogress.end(); });
    }

    $('#search').keyup();
});