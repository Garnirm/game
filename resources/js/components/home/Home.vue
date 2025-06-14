<template>
    <div class="home">
        <div class="home-menu">
            <div class="menu-item"><router-link to="/create">Créer une partie</router-link></div>
            <div class="menu-item">Charger une partie</div>
        </div>
    </div>
</template>

<script>
export default {}
</script>

<style lang="scss" scoped>
.home {
    align-items: center;
    display: flex;
    justify-content: center;
    flex-direction: column;
    height: 100vh;

    .home-menu {
        .menu-item {
            background: teal;
            border: 0 !important;
            border-radius: 20px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            color: white;
            cursor: pointer;
            font-size: 24px;
            outline: 0 !important;
            padding: 10px 15px;
            text-align: center;

            &:not(:last-child) {
                margin-bottom: 64px;
            }

            a {
                color: white;
                text-decoration: none;
            }
        }
    }
}
</style>