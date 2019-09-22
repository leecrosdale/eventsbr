<template>

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
                                Movement
                            </div>
                            <div class="card-body">
                                <controls-component></controls-component>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Stats
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-2">
                                        Health
                                    </div>
                                    <div class="col-md-4">
                                        {{ player.pivot.health }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        Stamina
                                    </div>
                                    <div class="col-md-4">
                                        {{ player.pivot.stamina }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        Stance
                                    </div>
                                    <div class="col-md-4">
                                        {{ states[player.pivot.state] }}
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

</template>

<script>

    import {mapGetters, mapActions} from 'vuex'

    import playerApi from '../api/player'


    export default {
        mounted() {

            playerApi.getPlayer().then((response) => {
                this.setPlayer(response.data);
            });

            window.Echo.private(`game_id{$game_id}`).listen('NewMessage', (e) => {
                // New Log
            });


        },
        props: ['player'],
        data() {
            return {
                state: 0, // Lobby, Playing, Dead, Ended
                states: ['Standing', 'Crawling'],
                actions: [],
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
                setPlayer: 'player/setPlayer'
            })

        },
        computed: {
            ...mapGetters({
                player: 'player/getPlayer'
            })
        }
    }
</script>
