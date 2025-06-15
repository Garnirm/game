<template>
    <div class="sidebar-left">
        <div class="sidebar-unlockable-tiles">
            <div class="unlockable-tiles-left">Cases débloquables</div>

            <div class="unlockable-tiles-right">{{ unlockable_tiles }}</div>
        </div>

        <div class="sidebar-block">
            <div class="block-label">Ressources</div>

            <div class="block-content block-resources" v-if="opened_blocks.includes('resources')">
                <div class="resources-line" v-for="r in resources" :key="r.label">
                    <div class="line-left">{{ r.label }}</div>

                    <div class="line-right">
                        <div>{{ this[ r.var_amount ]?.toLocaleString('fr-FR') }}</div>

                        <div v-if="this[ r.var_balance ]">{{ this[ r.var_balance ].toLocaleString('fr-FR') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar-block">
            <div class="block-label">Unités</div>
        </div>

        <div class="sidebar-block">
            <div class="block-label">Population</div>
        </div>

        <div class="sidebar-block">
            <div class="block-label">Villes</div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            opened_blocks: [ 'resources' ],

            resources: [
                { label: 'Monnaie', var_amount: 'money', var_balance: 'production_balance_money' },
                { label: 'Nourriture', var_amount: 'food', var_balance: 'production_balance_food' },
                { label: 'Acier', var_amount: 'steel', var_balance: 'production_balance_steel' },
                { label: 'Béton', var_amount: 'concrete', var_balance: 'production_balance_concrete' },
            ],
        }
    },

    computed: {
        unlockable_tiles: function () { return this.$store.getters['resources/get_resource']('unlockable_tiles') },

        concrete: function () { return this.$store.getters['resources/get_resource']('concrete') },
        food: function () { return this.$store.getters['resources/get_resource']('food') },
        influence: function () { return this.$store.getters['resources/get_resource']('influence') },
        money: function () { return this.$store.getters['resources/get_resource']('money') },
        steel: function () { return this.$store.getters['resources/get_resource']('steel') },

        production_concrete: function () { return this.$store.getters['resources/get_production']('concrete') },
        production_food: function () { return this.$store.getters['resources/get_production']('food') },
        production_influence: function () { return this.$store.getters['resources/get_production']('influence') },
        production_money: function () { return this.$store.getters['resources/get_production']('money') },
        production_steel: function () { return this.$store.getters['resources/get_production']('steel') },

        production_balance_concrete: function () { return this.$store.getters['resources/get_production_balance']('concrete') },
        production_balance_food: function () { return this.$store.getters['resources/get_production_balance']('food') },
        production_balance_influence: function () { return this.$store.getters['resources/get_production_balance']('influence') },
        production_balance_money: function () { return this.$store.getters['resources/get_production_balance']('money') },
        production_balance_steel: function () { return this.$store.getters['resources/get_production_balance']('steel') },

        upkeep_concrete: function () { return this.$store.getters['resources/get_upkeep']('concrete') },
        upkeep_food: function () { return this.$store.getters['resources/get_upkeep']('food') },
        upkeep_influence: function () { return this.$store.getters['resources/get_upkeep']('influence') },
        upkeep_money: function () { return this.$store.getters['resources/get_upkeep']('money') },
        upkeep_steel: function () { return this.$store.getters['resources/get_upkeep']('steel') },
    },
}
</script>

<style lang="scss" scoped>
.sidebar-left {
    background-color: #1A1E29;
    border-top: 1px solid #5388AA;
    height: 100%;
    padding: 16px;
    width: 300px;

    .sidebar-block {
        margin-bottom: 16px;

        .block-content {
            margin-top: 8px;

            &.block-resources {
                .resources-line {
                    color: white;
                    display: flex;
                    font-size: 15px;
                    justify-content: space-between;

                    .line-right {
                        text-align: right;
                    }
                }
            }
        }

        .block-label {
            color: white;
            cursor: pointer;
            font-size: 18px;
            font-weight: 500;
        }
    }

    .sidebar-unlockable-tiles {
        color: white;
        display: flex;
        font-size: 18px;
        justify-content: space-between;
        margin-bottom: 24px;
    }
}
</style>