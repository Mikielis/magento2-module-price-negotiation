
define([
    'jquery'
], function ($) {
    'use strict';

    $(document).ready(function() {
        $('#price-negotiation-button').click(function () {
            $('#price-negotiation').toggle();
        })
    });
});
