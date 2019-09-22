
const state = {
    player: [],
};

const getters = {
    getPlayer(state) {
        return state.player;
    }
};

const actions = {
    setPlayer({commit}, player) {
        commit('setPlayer', player);
    }
};

const mutations = {
    setPlayer(state, player) {
        state.player = player;
    }
};


export default {
    namespaced: true,
    getters,
    state,
    actions,
    mutations
}