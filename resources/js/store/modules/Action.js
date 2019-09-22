
const state = {
    actions: [],
};

const getters = {
    getActions(state) {
        return state.actions;
    }
};

const actions = {
    setActions({commit}, actions) {
        commit('setActions', actions);
    },
    addAction({commit}, action) {
        commit('addAction', action);
    },
    removeAction({commit}, action) {
        commit('removeAction', action);
    }
};

const mutations = {
    setActions(state, actions) {
        state.actions = actions;
    },
    addAction(state, action) {
        state.actions.push(action);
    },
    removeAction(state, action) {
        // state.actions.split(state.action.indexOf(action), 1)
        state.actions = state.actions.filter(function (a){
            return action.id !== a.id;
        })
    }
};


export default {
    namespaced: true,
    getters,
    state,
    actions,
    mutations
}