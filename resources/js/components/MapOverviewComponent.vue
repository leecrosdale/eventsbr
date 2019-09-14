<template>

<table style="border:0px; border-spacing:0; border-collapse: collapse;  overflow-x: scroll; table-layout:fixed">
    <tr style="height:64px; padding:0px;" v-for="row in terrain">
        <td v-for="col in row"
            style="border:1px solid black; width:64px; height:64px; max-width:64px; max-height:64px; "
            :style="{ 'background-color': terrainColors[col.type] }" >
<!--                                    {{ col.x }}, {{ col.y }}-->
            <p v-for="player in col.players">
<!--                                        {{ player.username }}-->
<!--                <img src="/svg/player.svg" />-->

                <svg viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12.5" cy="12.5" r="10"/>
                    <text x="9" y="17" fill="red" font-family="monospace">{{ player.username[0]}}</text>
                </svg>

            </p>
            <p v-if="Object.keys(col.items).length > 0">
                <svg viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                    <rect width="25" height="25"/>
                    <text x="9" y="17" fill="red" font-family="monospace">{{ Object.keys(col.items).length }}</text>
                </svg>
            </p>
        </td>
    </tr>
</table>

</template>

<script>
    export default {
        mounted() {
            this.getMap();
        },
        // props: ['terrain'],
        data(){
            return {
                terrain: [],
                terrainColors: [
                    '#228B22',
                    '#808000',
                    '#7CFC00',
                    '#00BFFF'
                ]
            }
        },
        methods: {
            getMap() {
                window.axios.get('update-map').then((response) => {
                    this.terrain = response.data;
                });
            }
        }


    }
</script>
