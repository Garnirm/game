<template>
    <sprite-road :height="height_tile" :width="width_tile" />
</template>

<script>
import SpriteRoad from '../../../../sprites/SpriteRoad.vue'

export default {
    components: { SpriteRoad },

    computed: {
        height_tile: function () { return this.$store.getters['map/get_height_tile'] },
        width_tile: function () { return this.$store.getters['map/get_width_tile'] },
    },
}
</script>