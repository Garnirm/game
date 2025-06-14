<template>
    <button class="btn" :class="[ 'btn-'+type ]">
        <template v-if="icon_component">
            <component :is="icon_component" :height="icon_component_size" :width="icon_component_size" />
        </template>

        <span>{{ label }}</span>
    </button>
</template>

<script>
export default {
    props: [ 'type', 'icon', 'icon_size', 'label' ],
    computed: {
        icon_component: function () {
            if (typeof this.icon === 'undefined') {
                return null
            }

            return 'icon-'+this.icon
        },
        icon_component_size: function () {
            if (typeof this.icon_size === 'undefined') {
                return 20
            }

            return this.icon_size
        },
    },
}
</script>