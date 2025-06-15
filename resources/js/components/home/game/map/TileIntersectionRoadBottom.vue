<template>
    <sprite-one-intersection-road :height="height_tile" :width="width_tile" />
</template>

<script>
import SpriteOneIntersectionRoad from '../../../sprites/SpriteOneIntersectionRoad.vue'

export default {
    components: { SpriteOneIntersectionRoad },

    computed: {
        height_tile: function () { return this.$store.getters['map/get_height_tile'] },
        width_tile: function () { return this.$store.getters['map/get_width_tile'] },
    },
}
</script>