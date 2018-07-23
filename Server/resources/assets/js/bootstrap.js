
window._ = require('lodash');
window.Popper = require('popper.js').default;
window.NProgress = require('nprogress');

try {
    window.$ = window.jQuery = require('jquery');

    require('semantic-ui-css');
} catch (e) {}

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.axios.interceptors.request.use((config) => {
    window.NProgress.start();
    return config;
});

window.axios.interceptors.response.use((response) => {
    window.NProgress.done();
    return response;
}, (error) => {
    window.NProgress.done();
    return Promise.reject(error);
});

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
