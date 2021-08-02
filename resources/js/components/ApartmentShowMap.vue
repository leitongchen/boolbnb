<template>
    <div>
        <h1>L'appartamento si trova qui:</h1>

        <div class='map' id='map' ref="mapRef"> TomTom map! </div>
        <p> appartamenti {{ apartment }}</p>
    </div>
</template>

<script type="application/javascript">
export default {
    name:'ApartmentShowMap',
    props: ['apartment'],
    data() {
        return {
            tt : window.tt,
            map : tt.map({
                key: "E8JECf2Pom9XoKTM5Gs0GGdIBDUOYbnS",
                container: 'map',
                center: [10.9916215, 45.4383842],
                zoom:13,
                style: 'tomtom://vector/1/basic-main', 
            }),
            control1 : map.addControl(new tt.FullscreenControl()),
            control2 : map.addControl(new tt.NavigationControl())
        }
    },
            

    //         this.apartment(function (apartment, index) {
    //             console.log(`apartment ${index}`)
    //             const location = [apartment.longitude, apartment.latitude];
    //             const marker = new tt.Marker().setLngLat(location).setPopup(new tt.Popup({
    //                 offset: 35
    //             }).setHTML(apartment.title)).addTo(map);
    //         });
    //     },
    // }
}

</script>

<style> 
#map { 
    height: 50vh; 
    width: 50vw; 
} 
</style> 