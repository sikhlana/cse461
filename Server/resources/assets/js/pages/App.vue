<script>
    import helper from '../services/helper';

    // modules...
    import Overlay from '../modules/Overlay';

    // pages...

    export default {
        components: {
            Overlay,
        },

        methods: {

        },

        mounted() {
            helper.activate(this.$el);
        }
    }
</script>