import _ from 'lodash';
import Noty from 'noty';
import api from './api';
import form from './form';

export default {
    activate(el) {
        _.forEach(el.querySelectorAll('.ui.dropdown'), (el) => {
            if (el.dataset.dropdownInit) {
                return;
            }

            let $el = $(el);

            if (el.dataset.value) {
                $el.val(el.dataset.value);
            }

            $el.dropdown({
                on: el.dataset.on || 'click',
                action: el.dataset.action || 'activate',
                allowAdditions: this.truth(el.dataset.allowAdditions),
                allowCategorySelection: this.truth(el.dataset.allowCategorySelection),
                placeholder: el.dataset.placeholder || 'auto',
            });

            el.dataset.dropdownInit = true;
        });

        _.forEach(el.querySelectorAll('.ui.modal'), (el) => {
            if (el.dataset.modalInit) {
                return;
            }

            let $el = $(el);

            $el.modal({
                blurring: this.truth(el.dataset.blurring || false),
            });

            el.dataset.modalInit = true;
        });

        _.forEach(el.querySelectorAll('.ui.checkbox'), (el) => {
            if (el.dataset.checkboxInit) {
                return;
            }

            let $el = $(el);

            $el.checkbox({

            });

            el.dataset.checkboxInit = true;
        });

        _.forEach(el.querySelectorAll('form.ajax'), (el) => {
            if (el.dataset.ajaxInit) {
                return;
            }

            form.init(el);
            el.dataset.ajaxInit = true;
        });

        _.forEach(el.querySelectorAll('[data-overlay]'), (el) => {
            if (el.dataset.overlayInit) {
                return;
            }

            el.addEventListener('click', (e) => {
                e.preventDefault();
                window.app.$emit('overlay-trigger', el, e);
            });

            el.dataset.overlayInit = true;
        });

        _.forEach(el.querySelectorAll('[data-delete]'), (el) => {
            if (el.dataset.deleteInit) {
                return;
            }

            el.addEventListener('click', (e) => {
                e.preventDefault();

                let href = el.dataset.href || el.getAttribute('href');

                api.delete(href, {}).then(form.handlers.success).then((response) => {
                    setTimeout(() => {
                        window.location.reload(true);
                    }, 1500);
                }).catch(form.handlers.error);
            });

            el.dataset.deleteInit = true;
        });
    },

    notify(type, text, timeout = false) {
        return new Noty({
            type, text, timeout,
        }).show();
    },

    truth(val) {
        return val === true || val === 1 || val === '1' || val === 'on' || val === 'yes' || val === 'true' || val === 'si';
    },
}