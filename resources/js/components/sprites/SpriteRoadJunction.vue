<template>
    <svg :width="width" :height="height" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
        <rect class="asphalt" x="0" y="30" width="80" height="20" />
        <rect class="asphalt" x="30" y="0" width="20" height="80" />

        <line class="center-line" x1="0" y1="40" x2="30" y2="40" />
        <line class="center-line" x1="50" y1="40" x2="80" y2="40" />

        <line class="center-line" x1="40" y1="0" x2="40" y2="30" />
        <line class="center-line" x1="40" y1="50" x2="40" y2="80" />
    </svg>
</template>

<script>
import sprite from '../../mixins/sprite'

export default {
    mixins: [ sprite ],
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