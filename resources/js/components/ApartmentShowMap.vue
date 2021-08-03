
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
        }
    },
    mounted() {
        this.map = tt.map({
            key: "E8JECf2Pom9XoKTM5Gs0GGdIBDUOYbnS",
            container: 'map',
            center: [this.apartment.longitude, this.apartment.latitude], //dati passano
            zoom:14
        })

        // var location = [(apartment.longitude, apartment.latitude)];
        var location = [45.443520, 11.005780];

        console.log(location);

        var marker = new tt.Marker()
        .setLngLat(location)
        .addTo(map);

        // const marker = new tt.Marker().setLngLat(location).setPopup(new tt.Popup({
        // offset: 35}).setHTML("location")).addTo(map);
    }
};
</script>


<style> 
#map { 
    height: 50vh; 
    width: 50vw; 
} 
</style> 
