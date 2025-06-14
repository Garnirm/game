import { createStore } from 'vuex'

import { stateGame, gettersGame, mutationsGame } from './game'
import { stateMap, gettersMap, mutationsMap } from './map'
import { stateResources, gettersResources, mutationsResources } from './resources'

export default createStore({
    modules: {
        game: {
            namespaced: true,
            state: stateGame,
            getters: gettersGame,
            mutations: mutationsGame,
        },
        map: {
            namespaced: true,
            state: stateMap,
            getters: gettersMap,
            mutations: mutationsMap,
        },
        resources: {
            namespaced: true,
            state: stateResources,
            getters: gettersResources,
            mutations: mutationsResources,
        },
    }
})
