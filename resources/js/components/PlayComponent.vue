<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Play - Turn {{ game.current_turn }}
                        <button class="btn btn-success" @click="endTurn">End Turn ({{ timer }})</button>
                    </div>
                    <div class="card-body" >
                        <div>
                            <!-- Lobby -->
                            <div class="row" v-if="game.status === 0">
                                <div class="col-md-12">
                                    Game is starting - 1/10 players joined
                                </div>
                            </div>

                            <div class="row" v-else-if="status === 'dead'">
                                <div class="col-md-12">
                                   You have been killed by {X}
                                </div>
                            </div>

                            <div class="row" v-else-if="game.status === 3">
                                <div class="col-md-12">
                                   Game has ended - (Show leaderboard)
                                </div>
                            </div>

                            <!-- Play -->
                            <div class="row" v-else-if="player !== undefined && game.status === 1">
                                <div class="col-md-6">
<!--                                    <map-overview-component></map-overview-component>-->
                                    <canvas-map-component :gameId="gameId"></canvas-map-component>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    Movement - {{ player.x }} , {{ player.y }}
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Center of zone is [CENTER]
                                                        </div>
                                                    </div>
                                                    <controls-component controlType="move"></controls-component>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row py-2">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    Shoot
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Shoot!
                                                        </div>
                                                    </div>
                                                    <controls-component controlType="shoot"></controls-component>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row py-2">
                                        <div class="col-md-12">
                                            <div class="card" v-if="player !== undefined">
                                                <div class="card-header">
                                                    Stats
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Health
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{ player.health }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Stamina
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{ player.stamina }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Stance
                                                        </div>
                                                        <div class="col-md-8">
                                                            {{ states[player.state] }} - <button class="btn btn-success">Switch Stance</button>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Weapon
                                                        </div>
                                                        <div class="col-md-8" v-if="!player.weapon">
                                                            Nothing
                                                        </div>
                                                        <div v-else>
                                                            Your {{ player.weapon.name}} shoots {{ player.weapon.distance }} squares for {{ player.weapon.stat }} damage
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Armor
                                                        </div>
                                                        <div class="col-md-8" v-if="!player.armor">
                                                            Nothing
                                                        </div>
                                                        <div v-else>
                                                            {{ player.armor.name }}
                                                            Your {{ player.armor.name}} has {{ player.armor.stat }} protection
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row py-2">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    World
                                                </div>
                                                <div class="card-body">
                                                    <items-component :items="items"></items-component>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row py-2">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    Actions
                                                </div>
                                                <div class="card-body">
                                                    <p v-for="action in actions">{{ action.action }} - {{ action.data
                                                        }} </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <!-- Dead-->

                            <!-- Ended-->

                            <!-- Game Log (What's happening in the game -->
                            <!-- Chat (Maybe) -->
                            <!-- Game Status, Players Remaining -->

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    import {mapGetters, mapActions} from 'vuex'

    import playerApi from '../api/player'
    import actionApi from '../api/action'
    import gameApi from '../api/game'

    export default {
        mounted() {

            this.loadGame();

        },
        created() {
            window.Echo.private(`game.${this.gameId}`).listen('GameStarted', (e) => {
               this.setGame(e.game);
            });
            window.Echo.private(`game.${this.gameId}`).listen('NextTurn', (e) => {
                console.log("Next turn");
                this.setGame(e.game);
                this.loadGame();
            });

            window.Echo.private(`game.${this.gameId}.${this.player.player_id}`).listen('Dead', (e) => {
               console.log("You're dead");
               this.status = 'dead';
            });

        },
        data() {
            return {
                states: ['Standing', 'Crawling'],
                stats: [],
                status: null,
                timer: 30
            }
        },
        methods: {

            loadGame() {
                playerApi.getPlayer().then((response) => {
                    this.setPlayer(response.data);

                    // TODO If player is dead set status to dead..
                });

                gameApi.getGame(this.gameId).then((response) => {
                    this.setGame(response.data);
                });

                actionApi.getActions().then((response) => {
                    this.setActions(response.data);
                });
            },

            // End Turn
            endTurn()
            {
                console.log("Fire event here");
            },

            ...mapActions({
                setGame: 'game/setGame',
                setPlayer: 'player/setPlayer',
                setActions: 'action/setActions'
            })

        },
        computed: {
            ...mapGetters({
                gameId: 'game/getGameId',
                game: 'game/getGame',
                player: 'player/getPlayer',
                actions: 'action/getActions',
                map: 'map/getMap'
            }),
            items() {

                if (this.player) {

                    if (this.map[this.player.y] && this.map[this.player.y][this.player.x]) {
                        return this.map[this.player.y][this.player.x]['items'];
                    }
                }
                return null;

            }
        },
        watch: {

        }
    }
</script>
