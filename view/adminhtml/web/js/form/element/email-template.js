define([
    'jquery',
    'Magento_Ui/js/form/element/select'
], function ($, Select) {
    'use strict';

    return Select.extend({
        defaults: {
            customName: '${ $.parentName }.${ $.index }_input'
        },
        /**
         * Change currently selected option
         *
         * @param {String} id
         */
        selectOption: function (id) {
            setTimeout(function () {
                if (($("#" + id).val() == 0) || ($("#" + id).val() == undefined)) {
                    $('div[data-index="email_subject"]').show();
                    $('div[data-index="email_header"]').show();
                    $('div[data-index="email_message"]').show();
                } else {
                    $('div[data-index="email_subject"]').hide();
                    $('div[data-index="email_header"]').hide();
                    $('div[data-index="email_message"]').hide();
                }
            }, 10);
        },
    });
});