ajaxAdd = function (params) {
    let arParams = {
        "ADD_BUTTON": $(".blog_add-button"),
        "LANG_INSIDE_FAV": params.LANG_INSIDE_FAVORITES,
        "HLB_ID": params.HLB_ID,
    }
    function useAjax(arParams, action)
    {
        $.ajax({
            url: '/bitrix/services/main/ajax.php?' + $.param({
                    c: 'nfk:favorites',
                    action: action,
                    mode: 'class'
                },
                true
            ),
            method: 'POST',
            data: {
                elementId: arParams.ADD_BUTTON.data("elementId"),
                hlbId: arParams.HLB_ID,
                sessid: BX.message('bitrix_sessid'),
            }
        }).done(function (response)
        {
            if (response.data.result) {
                arParams.ADD_BUTTON.html(arParams.LANG_INSIDE_FAV).attr('href', params.LINK);
            }
        });
    }

    useAjax(arParams, "Check");
    arParams.ADD_BUTTON.on( "click", function() {
        useAjax(arParams, "Add");
    });
}