"use strict";

$(document).ready(function () {
    Toolkit.init();
});

let B5Form = {
    disableSubmit: function (element) {
        let button = $(element);
        let form = button.parent('form');
        $(document).on('submit', form, function (e) {
            let loadingFa = button.data('loading-fa') === undefined ? 'fa-duotone fa-floppy-disk' : button.data('loading-fa');
            let loadingFaAnimation = button.data('loading-fa-animation') === undefined ? 'fa-spin' : button.data('loading-fa-animation');
            let loadingText = button.data('loading-text') === undefined ? 'carregando' : button.data('loading-text');
            let loadingHtml = '<span><i class="' + loadingFa + ' ' + loadingFaAnimation + '"></i> ' + loadingText + '</span>';

            button.addClass('disabled');
            button.attr('data-html-original', button.html());
            button.children().fadeOut(300, function () {
                button.html(loadingHtml);
                button.children().fadeIn(300);
            });
        });
    },
    enableSubmit: function (element) {
        let button = $(element);
        button.removeClass('disabled');
        button.children().fadeOut(300, function () {
            button.html(button.data('html-original'));
            button.children().fadeIn(300);
            button.removeAttr('data-html-original');
        });
    }
};

let ToolkitTable = {
    focusOnSuccess: undefined,
    init: function () {
        this.setListeners();
    },
    setListeners: function () {
        let parent = this;
        $(document).on('click', '.system-table-container a.table-filter-link', function (event) {
            event.preventDefault();
            let link = $(this);
            let url = link.attr('href');
            history.pushState({}, null, url);
            parent.onUrlChange();
        });
        let localOnSearch = this.onSearch(700);
        $(document).on('keyup', '.table-search-input', function (event) {
            let notAllowedKeys = [9, 13, 16, 17, 18, 19, 20, 27, 33, 34, 35, 36, 37, 38, 39, 40, 45, 91, 92, 93];
            console.log('pressed: ' + event.which);
            if (notAllowedKeys.indexOf(event.which) !== -1) {
                return false;
            }
            this.focusOnSuccess = '#' + $(this).attr('id');
            localOnSearch();
        });
    },
    onUrlChange: function () {
        $.ajax({
            url: location.href,
            dataType: 'json',
            headers: {
                tableUpdate: true,
            },
            beforeSend: function (xhr) {
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
                if (this.focusOnSuccess !== undefined) {
                    $(this.focusOnSuccess).focus();
                    let inputVal = $(this.focusOnSuccess).val();
                    $(this.focusOnSuccess).val('').val(inputVal);
                    this.focusOnSuccess = undefined;
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
    },
    onSearch: function (delay) {
        let timer = null;
        let parent = this;
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
                parent.onUrlChange();
            }, delay || 500);
        };
    }
};

let ToolkitApexCharts = {
    charts: {},
    refreshTime: undefined,
    interval: undefined,
    /**
     *
     * @param id
     * @param {ApexCharts} apexChart
     * @param {boolean} lastChart
     */
    appendChart: function (id, apexChart, lastChart) {
        this.charts[id] = apexChart;
        let globalParent = this;
        if (lastChart) {
            if (this.interval === undefined && (this.refreshTime !== undefined || this.refreshTime !== -1)) {
                this.interval = setInterval(function () {
                    globalParent.updateCharts();
                }, this.refreshTime);
            }
            for (let key in this.charts) {
                this.charts[key].render();
            }
            this.updateCharts();
        }
    },
    updateCharts: function () {
        let charts = this.charts;
        $.ajax({
            url: location.href,
            dataType: 'json',
            headers: {
                apexChartsUpdate: true,
            },
            beforeSend: function (xhr) {

            },
            success: function (data, textStatus, jqXHR) {
                for (let key in charts) {
                    charts[key].updateOptions(data[key], true, true, false);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
    },
    formatters: {
        percentage: function (value, locale, maximumFractionDigits) {
            return new Intl.NumberFormat(locale, {
                style: "percent",
                maximumFractionDigits: maximumFractionDigits
            }).format(value / 100);
        },
        currency: function (value, locale, currency, maximumFractionDigits = 2) {
            return new Intl.NumberFormat(locale, {
                style: "currency",
                currency: currency,
                maximumFractionDigits: maximumFractionDigits
            }).format(value);
        },
    },
};

let Toolkit = {
    apexCharts: ToolkitApexCharts,
    b5form: B5Form,
    table: ToolkitTable,
    init: function () {
        this.table.init();
    },
};