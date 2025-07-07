// State
var save_id = '686c2069c09d49003808aee2'

var housing_consumption = {}

var tour = null
var save_name = null
var coord_position_view = null

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

function get_coord_position_view (state) {
    return state.coord_position_view
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

function set_coord_position_view (state, coord_position_view) {
    state.coord_position_view = coord_position_view
}

function load_housing_consumption (state, housing_consumption) {
    state.housing_consumption = housing_consumption
}

// Export
export const stateGame = {
    save_id, tour, save_name, coord_position_view, housing_consumption,
}

export const gettersGame = {
    get_save_id, get_tour, get_save_name, get_coord_position_view, get_housing_consumption,
}

export const mutationsGame = {
    set_save_id, set_tour, set_save_name, set_coord_position_view, load_housing_consumption,
}
