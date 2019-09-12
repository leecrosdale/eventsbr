<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Map Component</div>

                    <div class="card-body">
                        <table>
                            <tr style="height:32px;" v-for="row in terrain">
                                <td style="border:1px solid black; width:32px;" v-for="col in row">
                                    {{ col.x }}, {{ col.y }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: ['map', 'terrain']
    }
</script>
