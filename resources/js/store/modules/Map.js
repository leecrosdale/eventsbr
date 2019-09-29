const state = {
    map: []
};

const getters = {
    getMap(state) {
        return state.map;
    },
    getItems(state) {
        // return state.map.filter(function (col) {
        //     console.log(col);
        // })
    }
};

const mutations = {
    setMap(state, map) {
        state.map = map;
    }
};

const actions = {
    setMap({commit}, map) {
        commit('setMap', map)
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}