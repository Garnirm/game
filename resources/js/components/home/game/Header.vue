<template>
    <div class="game-header">
        <div class="header-left">
            {{ save_name }}
        </div>

        <div class="header-center">
            <div class="center-button-end-tour">
                Terminer tour {{ tour }}
            </div>
        </div>

        <div class="header-right"></div>
    </div>
</template>

<script>
export default {
    computed: {
        save_name: function () { return this.$store.getters['game/get_save_name'] },
        tour: function () { return this.$store.getters['game/get_tour'] },
    },
}
</script>

<style lang="scss" scoped>
.game-header {
    align-items: center;
    background-color: #1A1E29;
    color: white;
    display: flex;
    height: 96px;
    justify-content: space-between;

    .header-center {
        .center-button-end-tour {
            background-color: #5388AA;
            border: 1px solid white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 22px;
            padding: 12px;
        }
    }

    .header-left {
        font-size: 22px;
        margin-left: 64px;
    }
}
</style>