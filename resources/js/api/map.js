export default {
    getMap() {
        return window.axios.get(`update-map`);
    },
    getMapOverview() {
        return window.axios.get(`update-map-overview`);
    }
}
