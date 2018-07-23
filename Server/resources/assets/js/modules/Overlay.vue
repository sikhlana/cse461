<template>
    <div id="overlay-modal" class="ui modal" :class="size">
        <i class="close icon" v-if="close"></i>

        <div v-if="title" class="header">
            {{ title }}
        </div>

        <div ref="container" class="ui content container">
            <!-- replace -->
        </div>
    </div>
</template>

<script>
    import Vue from 'vue';
    import api from '../services/api';
    import form from '../services/form';
    import helper from '../services/helper';

    export default {
        name: "overlay",

        data() {
            return {
                size: 'large',
                close: true,
                title: '',
            };
        },

        methods: {
            load(el) {
                this.$refs.container.innerHTML = '<div id="modal-contents-mount-point"></div>';
                let href = el.dataset.href || el.getAttribute('href');

                api.get(href, {}).then((response) => {
                    let data = response.data;

                    if (data.message || data.warning) {
                        return form.handlers.success(response);
                    }

                    if (response.headers['x-modal-size'] || data.modal_size) {
                        this.size = response.headers['x-modal-size'] || data.modal_size;
                    } else {
                        this.size = 'large';
                    }

                    if (response.headers['x-modal-no-title'] === 'true') {
                        this.title = false;
                    } else {
                        this.title = data.title || false;
                    }

                    this.close = response.headers['x-modal-no-close'] !== 'true';

                    if (data.body_id) {
                        this.$el.id = 'modal-' + data.body_id;
                    } else {
                        this.$el.id = '';
                    }

                    let contents = Vue.extend({
                        template: data.html,
                    });

                    new contents().$mount('#modal-contents-mount-point');
                    $(this.$el).modal('refresh').modal('show');

                    helper.activate(this.$el);
                }).catch(api.handlers.error);
            },
        },

        mounted() {
            $(this.$el).modal();
            this.$root.$on('overlay-trigger', this.load);
        }
    }
</script>