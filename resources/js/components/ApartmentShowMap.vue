
<template>
    <div>
        <h1>L'appartamento si trova qui:</h1>

        <div class='map' id='map' ref="mapRef"> TomTom map! </div>
        <p>{{ this.apartment }}</p>

    </div>
</template>

<script>
export default {
    name:"ApartmentShowMap",
    props: ['apartment'], 

    data() {
        return {
            // location: [],
            map: {},
            marker: []
        }
    },
    mounted() {
        this.map = tt.map({
            key: "E8JECf2Pom9XoKTM5Gs0GGdIBDUOYbnS",
            container: 'map',
            center: [11.005780, 45.443520],
            zoom:14
        })

        // var location = [(apartment.longitude, apartment.latitude)];
        var HQ = { lat: 45.443520, lng: 11.005780 }

        console.log(location);

        this.marker = new tt.Marker()
        .setLngLat(HQ)
        .addTo(map);
    }
};
</script>


<style> 
#map { 
    height: 50vh; 
    width: 50vw; 
} 
</style> 
