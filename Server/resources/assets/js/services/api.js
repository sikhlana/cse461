import _ from 'lodash';
import helper from './helper';

export default {
    get(url, data, config) {
        return this.request('get', url, data, config);
    },

    post(url, data, config) {
        return this.request('post', url, data, config);
    },

    delete(url, data, config) {
        return this.request('delete', url, data, config);
    },

    request(method, url, data, config) {
        if (typeof config !== 'object') {
            config = {};
        }

        let query = '';
        if (['get', 'delete'].includes(method.toLowerCase())) {
            if (typeof data === 'string') {
                query = data;
            } else {
                _.forEach(data, (value, key) => {
                    query += encodeURIComponent(key) + '=' + encodeURIComponent(value) + '&';
                });
            }

            if (query !== '') {
                url += (url.includes('?') ? '&': '?') + (query.endsWith('&') ? query.slice(0, -1) : query);
            }

            data = {};
        }

        if (! url.includes('://')) {
            url = '/api/' + url;
        }

        _.extend(config, {
            url, method, data,
        });

        return window.axios.request(config);
    },

    handlers: {
        error(error) {
            if (typeof error.response === 'object') {
                if (typeof error.response.data === 'object') {
                    let data = error.response.data;

                    helper.notify('error', data.message || error.response.statusText);

                    if (typeof data.errors === 'object') {
                        _.forEach(data.errors, (msg, key) => {
                            let $el = $(`[name=${key}], #ctrl_${key}`).eq(0);

                            if ($el.not(':visible')) {
                                $el = $el.parent();
                            }

                            $el.popup({
                                content: msg[0],
                                position: 'right center',
                                on: 'manual',
                            }).popup('show');
                        });
                    }
                } else {
                    helper.notify('error', error.response.statusText);
                }
            } else {
                helper.notify('error', 'Please check console for more information.');
                throw error;
            }
        },
    },
}