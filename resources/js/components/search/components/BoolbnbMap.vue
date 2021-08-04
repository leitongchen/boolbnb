<template>
    <div>
        

        <div class='map' id='map' ref="mapRef"> TomTom map! </div>
        <!-- <p> appartamenti {{ apartments }}</p> -->


        <div v-for="el in apartments" :key="el.id">

            <apartment-card
            :apartment="el"
            ></apartment-card>

        </div>
        

    </div>
</template>

<script type="application/javascript">
export default {
    name:'BoolbnbMap',
    props: ['lat', 'long', 'apartments'],
    watch: {
        apartments: function(newval, oldval) {
            const tt = window.tt;
            var map = tt.map({
                key: "E8JECf2Pom9XoKTM5Gs0GGdIBDUOYbnS",
                container: 'map',
                center: [this.long, this.lat],
                zoom:13,
                //style: 'tomtom://vector/1/basic-main', 
            })
            map.addControl(new tt.FullscreenControl()); 
            map.addControl(new tt.NavigationControl()); 

            this.apartments.forEach(function (apartment, index) {
                // console.log(apartment)
                const location = [apartment.longitude, apartment.latitude];
                const marker = new tt.Marker().setLngLat(location).setPopup(new tt.Popup({
                    offset: 35
                }).setHTML(apartment.title)).addTo(map);
            });
        },
    }, 
    mounted() {
        // console.log(this.apartments)
    }
}

</script>

<style> 
#map { 
    height: 50vh; 
    width: 50vw; 
} 
</style> 
