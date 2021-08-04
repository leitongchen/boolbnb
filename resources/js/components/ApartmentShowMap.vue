
<template>
    <div>
        <h1>L'appartamento si trova qui:</h1>

        <div class='map' id='map' ref="mapRef"> TomTom map! </div>
        <!-- <p>{{ this.apartment }}</p> -->

    </div>
</template>

<script>
export default {
    name:"ApartmentShowMap",
    props: ['apartment'], 

    data() {
        return {
            map: {},
        }
    },
    methods: {
        setMap() {
            const tt = window.tt;
            this.map = tt.map({
                key: "E8JECf2Pom9XoKTM5Gs0GGdIBDUOYbnS",
                container: 'map',
                center: [this.apartment.longitude, this.apartment.latitude], //dati passano
                zoom:14
            });
            this.map.addControl(new tt.FullscreenControl()); 
            this.map.addControl(new tt.NavigationControl());

            const location = [this.apartment.longitude, this.apartment.latitude];
            const marker = new tt.Marker()
                .setLngLat(location)
                .setPopup(new tt.Popup({
                offset: 35
            })
            .setHTML(this.apartment.title))
            .addTo(this.map);
        }
    },
    mounted() {

        this.setMap()
    }
};
</script>


<style> 
#map { 
    height: 50vh; 
    width: 50vw; 
} 
</style> 
