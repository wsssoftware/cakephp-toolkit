let focusOnSuccess = undefined;

let setListeners = function () {
    $(document).on('click', '.system-table-container a.table-filter-link', function (event) {
        event.preventDefault();
        let link = $(this);
        let url = link.attr('href');
        history.pushState({}, null, url);
        onUrlChange();
    });
    let localOnSearch = onSearch(700);
    $(document).on('keyup', '.table-search-input', function (event) {
        let notAllowedKeys = [9, 13, 16, 17, 18, 19, 20, 27, 33, 34, 35, 36, 37, 38, 39, 40, 45, 91, 92, 93];
        console.log('pressed: ' + event.which);
        if (notAllowedKeys.indexOf(event.which) !== -1) {
            return false;
        }
        focusOnSuccess = '#' + $(this).attr('id');
        localOnSearch();
    });
};

let onUrlChange = function () {
    $.ajax({
        url: location.href,
        dataType: 'json',
        headers: {
            tableUpdate: true,
        },
        beforeSend: function( xhr ) {
            $('.system-table-container .table-responsive').each(function () {
                $(this).addClass('table-loading');
            });
        },
        success: function (data, textStatus, jqXHR) {
            if (data.tables !== undefined) {
                $.each(data.tables, function (i, item) {
                    let table = $('#' + (item.id));
                    if (table.length) {
                        table.html(item.body);
                    }
                });
            }
            $('.system-table-container .table-responsive').each(function () {
                $(this).removeClass('table-loading');
            });
            if (focusOnSuccess !== undefined) {
                $(focusOnSuccess).focus();
                let inputVal = $(focusOnSuccess).val();
                $(focusOnSuccess).val('').val(inputVal);
                focusOnSuccess = undefined;
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('.system-table-container .table-responsive').each(function () {
                let element = $(this);
                element.removeClass('table-loading');
                window.setTimeout(function () {
                    element.addClass('table-loading-error');
                }, 500);
            });
        }
    });
};

let onSearch = function (delay) {
    let timer = null;
    return function () {
        clearTimeout(timer);
        timer = window.setTimeout(function () {
            let query = location.search.substring(1);
            if (query === '' || query === undefined) {
                query = JSON.parse('{}');
            } else {
                query = JSON.parse('{"' + decodeURI(query).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g, '":"') + '"}');
            }
            $('.table-search-input').each(function () {
                let value = $(this).val();
                let scope = $(this).data('scope');
                if (value === '' || value === undefined) {
                    delete query[scope + '[query]'];
                } else {
                    query[scope + '[query]'] = value;
                    delete query[scope + '[page]'];
                }
            });
            query = $.param(query);
            let url = window.location.origin + window.location.pathname;
            if (query !== '' && query !== undefined) {
                url += '?' + query;
            }
            history.pushState({}, null, url);
            onUrlChange();
        }, delay || 500);
    };
}

let SystemTable = function () {
    "use strict";
    return {
        //main function
        init: function () {
            setListeners();
        }
    };
}();

$(document).ready(function () {
    SystemTable.init();
});