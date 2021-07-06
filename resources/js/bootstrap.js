window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');
window.moment = require("moment");
(function (factory) {
    factory(moment);
})(function (moment) {
    var monthsShortDot = "ene._feb._mar._abr._may._jun._jul._ago._sep._oct._nov._dic.".split(
            "_"
        ),
        monthsShort = "ene_feb_mar_abr_may_jun_jul_ago_sep_oct_nov_dic".split(
            "_"
        );
    return moment.defineLocale("es", {
        months: "enero_febrero_marzo_abril_mayo_junio_julio_agosto_septiembre_octubre_noviembre_diciembre".split(
            "_"
        ),
        monthsShort: function (m, format) {
            if (/-MMM-/.test(format)) {
                return monthsShort[m.month()];
            } else {
                return monthsShortDot[m.month()];
            }
        },
        weekdays: "domingo_lunes_martes_miércoles_jueves_viernes_sábado".split(
            "_"
        ),
        weekdaysShort: "dom._lun._mar._mié._jue._vie._sáb.".split("_"),
        weekdaysMin: "Do_Lu_Ma_Mi_Ju_Vi_Sá".split("_"),
        longDateFormat: {
            LT: "H:mm",
            LTS: "LT:ss",
            L: "DD/MM/YYYY",
            LL: "D [de] MMMM [de] YYYY",
            LLL: "D [de] MMMM [de] YYYY LT",
            LLLL: "dddd, D [de] MMMM [de] YYYY LT",
        },
        calendar: {
            sameDay: function () {
                return "[hoy a la" + (this.hours() !== 1 ? "s" : "") + "] LT";
            },
            nextDay: function () {
                return (
                    "[mañana a la" + (this.hours() !== 1 ? "s" : "") + "] LT"
                );
            },
            nextWeek: function () {
                return "dddd [a la" + (this.hours() !== 1 ? "s" : "") + "] LT";
            },
            lastDay: function () {
                return "[ayer a la" + (this.hours() !== 1 ? "s" : "") + "] LT";
            },
            lastWeek: function () {
                return (
                    "[el] dddd [pasado a la" +
                    (this.hours() !== 1 ? "s" : "") +
                    "] LT"
                );
            },
            sameElse: "L",
        },
        relativeTime: {
            future: "en %s",
            past: "hace %s",
            s: "unos segundos",
            m: "un minuto",
            mm: "%d minutos",
            h: "una hora",
            hh: "%d horas",
            d: "un día",
            dd: "%d días",
            M: "un mes",
            MM: "%d meses",
            y: "un año",
            yy: "%d años",
        },
        ordinalParse: /\d{1,2}º/,
        ordinal: "%dº",
        week: {
            dow: 1, // Monday is the first day of the week.
            doy: 4, // The week that contains Jan 4th is the first week of the year.
        },
    });
});
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
