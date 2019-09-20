
const state = {
    game: [],
    id: null
};

const getters = {
    getGame(state) {
        return state.game
    },
    getId(state) {
        return state.id
    }
};

const actions = {
    setGameId({commit}, id) {
        commit('setGameId', id);
    }
};

const mutations = {
    setGame(game) {
        this.game = game
    },
    setGameId(id) {
        this.id = id;
    }
};


export default {
    namespaced: true,
    getters,
    state,
    actions,
    mutations
}