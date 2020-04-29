<template>
    <div>
        <slot v-if="show == 'query'"></slot>
        <div v-else>
            <div>
                <span v-if="options.multiple">
                    ...
                </span>
                <span v-else>
                    ...
                </span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['show', 'options', 'value', 'translatable'],
};
</script>