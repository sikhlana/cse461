<template>
    <div :id="`ctrl_${inputName}`" class="image uploader" :style="{height: `${height}px`, width: `${width}px`}">
        <input ref="input" type="file" :name="inputName" accept="image/*" @change="updatePlaceholder">
        <div ref="placeholder" class="placeholder" :style="{backgroundImage: `url(${currentImage})`}"></div>
    </div>
</template>

<script>
    import helper from '../services/helper';

    export default {
        name: "image-uploader",

        props: {
            currentImage: {
                type: String,
                required: true,
            },
            inputName: {
                type: String,
                required: true,
            },
            height: {
                type: Number,
                default: 300,
            },
            width: {
                type: Number,
                default: 300,
            }
        },

        methods: {
            updatePlaceholder() {
                let input = this.$refs.input;

                if (input.files.length !== 1) {
                    helper.notify('error', 'Unable to process selected image.');
                    return;
                }

                let reader = new FileReader();

                reader.onload = () => {
                    this.$refs.placeholder.style.backgroundImage = `url(${reader.result})`;
                };

                reader.readAsDataURL(input.files[0]);
            },
        },
    }
</script>