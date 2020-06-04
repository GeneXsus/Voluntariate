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

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

//live_comments/resources/js/bootstrap.js

window._ = require('lodash');

window.axios = require('axios');
window.moment = require('moment');

// import 'vue-tel-input/dist/vue-tel-input.css';

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
window.axios.defaults.headers.common.crossDomain = true;
window.axios.defaults.baseURL = '/alumnado/curso1920/DAW/daw1920a3/voluntariate/';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://adonisjs.com/docs/4.1/csrf');
}


window.Pusher = require('pusher-js');

// this.pusher = new Pusher(environment.pusher.key, {
//     cluster: environment.pusher.cluster,
//     forceTLS: false,
//     wsHost: environment.wsHost,
//     wsPort: 6001,
//     wssPort: 6001,
//     // authEndpoint: environment.url+'/api/sockets/auth',
//     auth: {
//         headers: {
//             Authorization: this._userService.token
//         }
//     }
// });
// //
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     encrypted: false,
//     wsHost: window.location.hostname,
//     wsPort: 6001,
//     disableStats: true,
//     forceTLS: true,
//     cluster:'eu',
//     enabledTransports: ['ws']
//     // enabledTransports: ['ws', 'wss'], // <-- only use ws and wss as valid transports
// });

