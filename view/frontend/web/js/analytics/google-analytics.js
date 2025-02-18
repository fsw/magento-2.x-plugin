/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
/* jscs:disable */
/* eslint-disable */
define([
], function () {
    'use strict';

    /**
     * @param {Object} config
     */
    return function (config) {
        (function (i, s, o, g, r, a, m) {
            i.GoogleAnalyticsObject = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        // Process page info
        ga('create', config.pageTrackingData.accountId, 'auto');

        if (config.pageTrackingData.isAnonymizedIpActive) {
            ga('set', 'anonymizeIp', true);
        }

        ga('send', 'pageview');
    }
});
