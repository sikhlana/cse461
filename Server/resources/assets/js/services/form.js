import api from './api';
import helper from './helper';

export default {
    init(form, config) {
        let $form = $(form);

        $form.find('[name]').on('change', (e) => {
            $(e.target).popup('destroy');
        });

        $form.on('submit', (e) => {
            e.preventDefault();

            this.submit(form, config)
                .then(this.handlers.success)
                .catch(this.handlers.error);
        });
    },

    submit(form, config) {
        let $form = $(form), data,
            redirect = helper.truth(form.dataset.redirect) || false,
            method = form.getAttribute('method') || 'get',
            action = form.getAttribute('action');

        if (form.getAttribute('enctype') === 'multipart/form-data') {
            data = new FormData;

            _.forEach(form.querySelectorAll('[name]'), (el) => {
                let $el = $(el).eq(0);

                if ($el.attr('type') === 'file') {
                    for (let i = 0; i < el.files.length; i++) {
                        data.append($el.attr('name'), el.files[i]);
                    }
                } else {
                    if ($el.attr('type') === 'checkbox') {
                        if ($el.is(':checked')) {
                            data.append($el.attr('name'), $el.val());
                        }
                    } else {
                        data.append($el.attr('name'), $el.val());
                    }
                }
            });
        } else {
            data = $form.serialize();
        }

        form.classList.add('loading');

        return api.request(method, action, data, config).then((r) => {
            r.allowRedirection = redirect;
            form.classList.remove('loading');

            return r;
        }).catch((e) => {
            form.classList.remove('loading');

            throw e;
        });
    },

    handlers: {
        success(response) {
            if (typeof response.data.warning === 'string') {
                helper.notify('warning', response.data.warning);
            } else {
                helper.notify('success', response.data.message || 'Changes have been successfully saved.', 1200);
            }

            if (response.allowRedirection && response.data.redirect) {
                setTimeout(() => {
                    if (window.location.href === response.data.redirect) {
                        window.location.reload(true);
                    } else {
                        window.location.href = response.data.redirect;
                    }
                }, 1500);
            }

            return response;
        },

        error(error) {
            api.handlers.error(error);
        },
    },
}