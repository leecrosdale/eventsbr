<template>

    <div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                North is this way
            </div>
        </div>
        <table style="border:0px; border-spacing:0; border-collapse: collapse;  overflow-x: scroll; table-layout:fixed">
            <tr style="height:64px; padding:0px;" v-for="row in map">
                <td v-for="col in row"
                    style="border:1px solid black; width:64px; height:64px; max-width:64px; max-height:64px;"
                    :style="{ 'background-color': terrainColors[col.terrain.type] }">

                    <p v-for="player in col.players">
                        <svg viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12.5" cy="12.5" r="10"/>
                            <text x="9" y="17" fill="red" font-family="monospace">{{ player.username[0]}}</text>
                        </svg>
                    </p>

                    <p v-if="col.items && col.items.length > 0">
                        <svg viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                            <rect width="25" height="25"/>
                            <text x="9" y="17" fill="red" font-family="monospace">{{ col.items.length }}</text>
                        </svg>
                    </p>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>

    import {mapGetters, mapActions} from 'vuex'
    import mapApi from '../api/map'

    export default {
        mounted() {

            if (!this.overview) {
                mapApi.getMap(this.gameId).then((response) => {
                    this.setMap(response.data);
                });

                window.Echo.private(`game_id{$game_id}`).listen('NextTurn', (e) => {
                    mapApi.getMap(this.gameId).then((response) => {
                        this.setMap(response.data);
                    });
                });
            } else {

                mapApi.getMapOverview(this.gameId).then((response) => {
                    this.setMap(response.data);
                });

                window.Echo.private(`game_id{$game_id}`).listen('NextTurn', (e) => {
                    mapApi.getMapOverview(this.gameId).then((response) => {
                        this.setMap(response.data);
                    });
                });

            }

        },
        props: ['gameId', 'overview'],
        data() {
            return {
                terrainColors: [
                    '#228B22',
                    '#808000',
                    '#7CFC00',
                    '#00BFFF'
                ]
            }
        },
        computed: {
            ...mapGetters({
                map: 'map/getMap'
            }),
        },
        methods: {
            ...mapActions({
                setMap: 'map/setMap'
            })
        }

    }
</script>
