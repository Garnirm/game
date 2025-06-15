<template>
    <svg :width="width" :height="height" xmlns="http://www.w3.org/2000/svg" :style="style" viewBox="0 0 80 80">
        <rect class="asphalt" x="0" y="30" width="80" height="20" />
        <rect class="asphalt" x="30" y="30" width="20" height="50" />

        <line class="center-line" x1="0" y1="40" x2="80" y2="40" />
        <line class="center-line" x1="40" y1="50" x2="40" y2="80" />
    </svg>
</template>

<script>
import sprite from '../../mixins/sprite'

export default {
    mixins: [ sprite ],
    props: [ 'orientation' ],

    computed: {
        style: function () {
            if (typeof this.orientation !== 'undefined') {
                return {
                    transform: 'rotate('+this.orientation+'deg)'
                }
            }
        },
    },
}
</script>

<style lang="scss" scoped>
.asphalt {
    fill: #4a4a4a;
}

.center-line { 
    stroke: #ffffff;
    stroke-dasharray: 8 6; /* Crée l'effet de pointillé */
    stroke-width: 1;
}
</style>