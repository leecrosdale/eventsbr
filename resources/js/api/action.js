export default {
    getActions() {
        return window.axios.get('actions');
    },
    getUnusedActions() {
        return window.axios.get('actions/unused');
    }
}