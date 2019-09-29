
const state = {
    game: [],
    id: null
};

const getters = {
    getGame(state) {
        return state.game
    },
    getGameId(state) {
        return state.id
    }
};

const actions = {
    setGameId({commit}, id) {
        commit('setGameId', id);
    },
    setGame({commit}, game) {
        commit('setGame', game);
    }
};

const mutations = {
    setGame(state, game) {
        state.game = game
    },
    setGameId(state, id) {
        state.id = id;
    }
};


export default {
    namespaced: true,
    getters,
    state,
    actions,
    mutations
}