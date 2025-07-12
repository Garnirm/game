// State
var save_id = '687133839c13a419c90bdb72'

var housing_consumption = {}

var tour = null
var save_name = null

// Getters
function get_save_id (state) {
    return state.save_id
}

function get_tour (state) {
    return state.tour
}

function get_save_name (state) {
    return state.save_name
}

function get_housing_consumption (state) {
    return (housing_class) => {
        return state.housing_consumption[ housing_class ]
    }
}

// Mutations
function set_save_id (state, save_id) {
    state.save_id = save_id
}

function set_tour (state, tour) {
    state.tour = tour
}

function set_save_name (state, save_name) {
    state.save_name = save_name
}

function load_housing_consumption (state, housing_consumption) {
    state.housing_consumption = housing_consumption
}

// Export
export const stateGame = {
    save_id, tour, save_name, housing_consumption,
}

export const gettersGame = {
    get_save_id, get_tour, get_save_name, get_housing_consumption,
}

export const mutationsGame = {
    set_save_id, set_tour, set_save_name, load_housing_consumption,
}
