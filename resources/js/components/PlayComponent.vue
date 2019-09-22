<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Play  - <button class="btn btn-success">End Turn</button></div>

                    <div class="card-body">

                        <div>

                            <!-- Lobby -->

                            <!-- Play -->

                            <div class="row">
                                <div class="col-md-6">
                                    <map-overview-component></map-overview-component>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    Movement - {{ player.pivot.x }} , {{ player.pivot.y }}
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Center of zone is [CENTER]
                                                        </div>
                                                    </div>
                                                    <controls-component></controls-component>
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
                                                            Your current [weapon] shoots [2] squares
                                                        </div>
                                                    </div>
                                                    <controls-component></controls-component>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row py-2">
                                        <div class="col-md-12">
                                            <div class="card" v-if="player.pivot !== undefined">
                                                <div class="card-header">
                                                    Stats
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Health
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{ player.pivot.health }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Stamina
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{ player.pivot.stamina }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Stance
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{ states[player.pivot.state] }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Weapon
                                                        </div>
                                                        <div class="col-md-6">
                                                            Fists
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


    export default {
        mounted() {

            playerApi.getPlayer().then((response) => {
                this.setPlayer(response.data);
            });

            actionApi.getActions().then((response) => {
                this.setActions(response.data);
            });

            window.Echo.private(`game_id{$game_id}`).listen('NewMessage', (e) => {
                // New Log
            });


        },
        data() {
            return {
                state: 0, // Lobby, Playing, Dead, Ended
                states: ['Standing', 'Crawling'],
                stats: []

            }
        },
        methods: {

            // Move

            // Stance

            // Shoot

            // Pickup

            // End Turn

            ...mapActions({
                setPlayer: 'player/setPlayer',
                setActions: 'action/setActions'
            })

        },
        computed: {
            ...mapGetters({
                player: 'player/getPlayer',
                actions: 'action/getActions',
                map: 'map/getMap',
                items: 'map/getItems'
            })
        }
    }
</script>
