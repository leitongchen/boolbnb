<template>
    <div>
        <h1>prova 2</h1>
        <input type="text" id="query" v-model="querySearch" @input="$emit('input', $event.currentTarget.value)">
        <button type="submit" @click="search">Cerca</button>

    </div>

</template>

<script>
    export default {
        name: "SearchForm",
        props: {
        
        },
        data() {
            return {
                querySearch: "",
                api_key: "SznQN02yzAXGOlDubCqT3PTfefEyd5Go",
            }
        },
        methods: {
            // if there are results
            // the position of the first result on the array of results 
            // were passed to the moveMap function
            handleResults(result) {
                console.log(result)

                // if (result.results) {
                //     moveMap(result.results[0].position)
                // }

                // var marker = new tt.Marker()
                // .setLngLat(result.results[0].position)
                // .addTo(map);
            },

            // search for locations based on the query 
            // results were passed through the handleResults function
            search() {
                tt.services.fuzzySearch({
                    key: this.api_key,
                    query: this.querySearch,
                    // boundingBox: map.getBounds()

                }).go().then(this.handleResults);
            }
        },
        mounted() {

        }
    }
</script>