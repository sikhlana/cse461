<template>
    <table class="ui single line table" data-item-list>
        <thead>
        <tr>
            <th :colspan="columnCount">
                {{ title }}
            </th>
        </tr>
        </thead>
        <tbody ref="items">
            <slot></slot>
        </tbody>
        <tfoot>
        <tr>
            <th :colspan="columnCount" class="right aligned">
                Showing {{ count }} of {{ total }} items.
            </th>
        </tr>
        </tfoot>
    </table>
</template>

<script>
    import helper from '../services/helper';

    export default {
        name: "item-list",

        props: {
            title: {
                type: String,
                required: true,
            },
            count: {
                type: Number,
                required: true,
            },
            total: {
                type: Number,
                required: true,
            }
        },

        data() {
            return {
                columnCount: 1,
            };
        },

        methods: {
            selectItem() {
                if (this.$lastSelectedItem) {
                    this.$lastSelectedItem.classList.remove('selected');
                    this.$lastSelectedItem = false;
                }

                if (window.location.hash && window.location.hash.match(/^#_\d+$/)) {
                    let el = document.querySelector(window.location.hash);

                    if (el) {
                        el.classList.add('selected');
                        this.$lastSelectedItem = el;
                    }
                }
            }
        },

        mounted() {
            this.columnCount = this.$refs.items.firstChild.childElementCount;
            helper.activate(this.$el);

            this.selectItem();
            window.addEventListener('hashchange', this.selectItem);
        },
    }
</script>