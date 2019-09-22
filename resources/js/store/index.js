import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import map from './modules/Map';
import game from './modules/Game';
import player from './modules/Player';

export default new Vuex.Store({
    modules: {
        map,
        game,
        player
    }
})
