<template>
    <div class="create">
        <div class="create-left">
            <div class="create-block mb-4">
                <div class="block-title">Informations de partie</div>

                <div class="block-form">
                    <div class="form-line mb-4">
                        <div class="form-line-label">Nom du peuple</div>

                        <div class="form-line-input">
                            <input type="text" v-model="people_name" class="input w-100" />
                        </div>
                    </div>

                    <div class="form-line mb-4">
                        <div class="form-line-label">Nom de la sauvegarde</div>

                        <div class="form-line-input">
                            <input type="text" v-model="save_name" class="input w-100" />
                        </div>
                    </div>

                    <div class="form-line mb-4">
                        <div class="form-line-label">Difficulté</div>

                        <div class="form-line-input">
                            <div class="select-buttons one-line">
                                <div class="select-buttons-choice" :class="{ selected: difficulty === 'easy' }">
                                    <input type="radio" v-model="difficulty" value="easy" id="difficulty-easy" />
                                    <label for="difficulty-easy">Facile</label>
                                </div>

                                <div class="select-buttons-choice" :class="{ selected: difficulty === 'normal' }">
                                    <input type="radio" v-model="difficulty" value="normal" id="difficulty-normal" />
                                    <label for="difficulty-normal">Normale</label>
                                </div>

                                <div class="select-buttons-choice" :class="{ selected: difficulty === 'hard' }">
                                    <input type="radio" v-model="difficulty" value="hard" id="difficulty-hard" />
                                    <label for="difficulty-hard">Dure</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-line">
                        <div class="form-line-label">Croissance territoriale</div>

                        <div class="form-line-input">
                            <div class="select-buttons one-line">
                                <div class="select-buttons-choice" :class="{ selected: territory_growth === 'slow' }">
                                    <input type="radio" v-model="territory_growth" value="slow" id="territory-growth-slow" />
                                    <label for="territory-growth-slow">Lente</label>
                                </div>

                                <div class="select-buttons-choice" :class="{ selected: territory_growth === 'normal' }">
                                    <input type="radio" v-model="territory_growth" value="normal" id="territory-growth-normal" />
                                    <label for="territory-growth-normal">Normale</label>
                                </div>

                                <div class="select-buttons-choice" :class="{ selected: territory_growth === 'fast' }">
                                    <input type="radio" v-model="territory_growth" value="fast" id="territory-growth-fast" />
                                    <label for="territory-growth-fast">Rapide</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="create-block mb-4">
                <div class="block-title">Paramètres du monde</div>

                <div class="block-form">
                    <div class="form-line mb-4">
                        <div class="form-line-label">Richesse en ressources</div>

                        <div class="form-line-input">
                            <div class="select-buttons one-line">
                                <div class="select-buttons-choice" :class="{ selected: wealth_resources === 'not_much' }">
                                    <input type="radio" v-model="wealth_resources" value="not_much" id="wealth-resource-not_much" />
                                    <label for="wealth-resource-not_much">Pas beaucoup</label>
                                </div>

                                <div class="select-buttons-choice" :class="{ selected: wealth_resources === 'normal' }">
                                    <input type="radio" v-model="wealth_resources" value="normal" id="wealth-resource-normal" />
                                    <label for="wealth-resource-normal">Normal</label>
                                </div>

                                <div class="select-buttons-choice" :class="{ selected: wealth_resources === 'much' }">
                                    <input type="radio" v-model="wealth_resources" value="much" id="wealth-resource-much" />
                                    <label for="wealth-resource-much">Beaucoup</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-line mb-4">
                        <div class="form-line-label">Densité des IA</div>

                        <div class="form-line-input">
                            <div class="select-buttons one-line">
                                <div class="select-buttons-choice" :class="{ selected: ia_density === 'very_weak' }">
                                    <input type="radio" v-model="ia_density" value="very_weak" id="ia-density-very_weak" />
                                    <label for="ia-density-very_weak">Très faible</label>
                                </div>

                                <div class="select-buttons-choice" :class="{ selected: ia_density === 'weak' }">
                                    <input type="radio" v-model="ia_density" value="weak" id="ia-density-weak" />
                                    <label for="ia-density-weak">Faible</label>
                                </div>

                                <div class="select-buttons-choice" :class="{ selected: ia_density === 'normal' }">
                                    <input type="radio" v-model="ia_density" value="normal" id="ia-density-normal" />
                                    <label for="ia-density-normal">Normal</label>
                                </div>

                                <div class="select-buttons-choice" :class="{ selected: ia_density === 'high' }">
                                    <input type="radio" v-model="ia_density" value="high" id="ia-density-high" />
                                    <label for="ia-density-high">Elevée</label>
                                </div>

                                <div class="select-buttons-choice" :class="{ selected: ia_density === 'chaos' }">
                                    <input type="radio" v-model="ia_density" value="chaos" id="ia-density-chaos" />
                                    <label for="ia-density-chaos">Chaos</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-line mb-4">
                        <div class="form-line-label">Proximité initiale</div>

                        <div class="form-line-input">
                            <div class="select-buttons one-line">
                                <div class="select-buttons-choice" :class="{ selected: initial_proximity === 'isolated' }">
                                    <input type="radio" v-model="initial_proximity" value="isolated" id="initial-proximity-isolated" />
                                    <label for="initial-proximity-isolated">Isolement</label>
                                </div>

                                <div class="select-buttons-choice" :class="{ selected: initial_proximity === 'far_away' }">
                                    <input type="radio" v-model="initial_proximity" value="far_away" id="initial-proximity-far_away" />
                                    <label for="initial-proximity-far_away">Loin</label>
                                </div>

                                <div class="select-buttons-choice" :class="{ selected: initial_proximity === 'normal' }">
                                    <input type="radio" v-model="initial_proximity" value="normal" id="initial-proximity-normal" />
                                    <label for="initial-proximity-normal">Normal</label>
                                </div>

                                <div class="select-buttons-choice" :class="{ selected: initial_proximity === 'near' }">
                                    <input type="radio" v-model="initial_proximity" value="near" id="initial-proximity-near" />
                                    <label for="initial-proximity-near">Proche</label>
                                </div>

                                <div class="select-buttons-choice" :class="{ selected: initial_proximity === 'contact' }">
                                    <input type="radio" v-model="initial_proximity" value="contact" id="initial-proximity-contact" />
                                    <label for="initial-proximity-contact">Contact</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-line">
                        <div class="form-line-label">Graine de la carte</div>

                        <div class="form-line-input">
                            <input type="text" v-model="map_seed" class="input w-100" />
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary" @click="create()">Créer la partie</button>
        </div>

        <div class="create-right">
            <div class="create-block">
                <div class="block-title">Civilisations</div>

                <div class="block-form">
                    <div class="form-line mb-4">
                        <div class="form-line-label">Nom de la première ville</div>

                        <div class="form-line-input">
                            <input type="text" v-model="first_city_name" class="input w-100" />
                        </div>
                    </div>

                    <div class="form-part mb-4">
                        <div class="form-part-label">Héritage de départ</div>
                    </div>

                    <div class="form-part">
                        <div class="form-line mb-4">
                            <div class="form-line-label">Points de trait que vous avez</div>

                            <div class="form-line-input">
                                <input type="number" v-model.number="player_trait_points" class="input w-100" />
                            </div>
                        </div>

                        <div class="form-line mb-4">
                            <div class="form-line-label">Points de trait qu'ont les IA</div>

                            <div class="form-line-input">
                                <input type="number" v-model.number="ia_trait_points" class="input w-100" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            people_name: 'Drarek',
            save_name: 'Drarekstanie',
            difficulty: 'normal',
            territory_growth: 'normal',

            wealth_resources: 'normal',
            ia_density: 'normal',
            initial_proximity: 'normal',
            map_seed: null,

            first_city_name: 'Faligadrie',
            player_trait_points: 4,
            ia_trait_points: 4,
        }
    },

    methods: {
        create: function () {
            axios.post('/save/create', {
                save_name: this.save_name, people_name: this.people_name, difficulty: this.difficulty, territory_growth: this.territory_growth,
                wealth_resources: this.wealth_resources, ia_density: this.ia_density, initial_proximity: this.initial_proximity, map_seed: this.map_seed,
                first_city_name: this.first_city_name, player_trait_points: this.player_trait_points, ia_trait_points: this.ia_trait_points,
            }).then((res) => {
                this.$store.commit('game/set_save_id', res.data.data)

                this.$router.push('/game')
            }).catch((e) => {})
        },
    },
}
</script>

<style lang="scss" scoped>
.create {
    display: flex;
    justify-content: center;
    padding-bottom: 96px;
    padding-top: 96px;

    .create-left {
        margin-right: 64px;
        padding-left: 128px;
        width: 100%;
    }

    .create-right {
        margin-left: 64px;
        padding-right: 128px;
        width: 100%;
    }

    .create-block {
        border: 1px solid gray;
        border-radius: 8px;
        padding: 24px;
        width: 100%;

        .block-form {
            .form-line {
                display: flex;
                justify-content: space-between;

                .form-line-input {
                    width: 55%;
                }

                .form-line-label {
                    width: 35%;
                }
            }

            .form-part {
                .form-part-label {}
            }
        }

        .block-title {
            font-size: 20px;
            margin-bottom: 32px;
        }
    }
}
</style>