<template>
    <div>
        <h1>Qui mappa store locator</h1>

        <div class='map' id='map' ref="mapRef"> TomTom map! </div>
        <p> appartamenti {{ apartments }}</p>
    </div>
</template>

<script type="application/javascript">
export default {
    name:'BoolbnbMap',
    props: ['lat', 'long', 'apartments'],
    mounted() {
        console.log(this.lat, this.long)
        

        const tt = window.tt;
        var map = tt.map({
            key: "E8JECf2Pom9XoKTM5Gs0GGdIBDUOYbnS",
            container: 'map',
            center: [this.long, this.lat],
            zoom:9,
            //style: 'tomtom://vector/1/basic-main', 
        })
        map.addControl(new tt.FullscreenControl()); 
        map.addControl(new tt.NavigationControl()); 

        this.apartments.forEach(function (apartment, index) {
            
            const location = [apartment.lng, apartment.lat];
            const marker = new tt.Marker().setLngLat(location).setPopup(new tt.Popup({
                offset: 35
            }).setHTML(apartment.name)).addTo(map);
        });
    }
}

</script>

<style> 
#map { 
    height: 50vh; 
    width: 50vw; 
} 
</style> 
