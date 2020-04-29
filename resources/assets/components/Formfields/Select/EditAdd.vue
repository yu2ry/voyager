<template>
    <div>
        <label class="label" v-if="translate(options.label, true) !== ''">{{ translate(options.label, true) }}</label>
        <select
            class="voyager-input w-full"
            :multiple="options.multiple || false"
            v-model="selected">
            <option v-for="option in options.options" :value="option.key" :key="option.key">
                {{ translate(option.value, true) }}
            </option>
        </select>
        <p class="description" v-if="translate(options.description, true) !== ''">
            {{ translate(options.description, true) }}
        </p>
    </div>
</template>

<script>
export default {
    props: ['options', 'value'],
    data: function () {
        return {
            selected: (this.options.multiple || false ? [] : ''),
        };
    },
    watch: {
        value: function (value) {
            this.parseInput();
        },
        selected: function (value) {
            this.$emit('input', value);
        }
    },
    methods: {
        parseInput: function () {
            if ((this.options.multiple || false) && this.isString(this.value)) {
                try {
                    this.selected = JSON.parse(this.value);
                } catch (e) {
                    this.selected = [];
                }
            } else {
                this.selected = this.value;
            }
        },
    },
    mounted: function () {
        this.parseInput();
    }
};
</script>