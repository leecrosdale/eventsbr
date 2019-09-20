import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import map from './modules/Map';
import game from './modules/Game';

export default new Vuex.Store({
    modules: {
        map,
        game
    }
})
