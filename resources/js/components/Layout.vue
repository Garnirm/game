<template>
    <div class="layout">
        <router-view />
    </div>
</template>

<script>
export default {
    props: [ 'housing_consumption' ],

    created: function () {
        this.$store.commit('game/load_housing_consumption', this.housing_consumption)
    },
}
</script>
