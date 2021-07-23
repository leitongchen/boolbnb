const api_key = "SznQN02yzAXGOlDubCqT3PTfefEyd5Go";
var nav = new tt.NavigationControl({});

// [longitude,latitude]
const treviso = [12.250000,45.666668];
const italia = [12.49427,41.89056];

let map = tt.map({
    key: api_key,
    container: 'mymap',
    center: italia,
    zoom: 14,
    style: 'tomtom://vector/1/basic-main'
})

map.addControl(nav, 'top-left');


// On queryBtn click 
document.getElementById("queryBtn").addEventListener("click", search);


// show on the map the searched location
function moveMap(lnglat) {
    map.flyTo({
        center: lnglat,
        zoom: 14
    })
}

// if there are results
// the position of the first result on the array of results 
// were passed to the moveMap function
function handleResults(result) {
    console.log(result)

    if (result.results) {
        moveMap(result.results[0].position)
    }

    var marker = new tt.Marker()
    .setLngLat(result.results[0].position)
    .addTo(map);
}

// search for locations based on the query 
// results were passed through the handleResults function
function search() {
    tt.services.fuzzySearch({
        key: api_key,
        query: document.getElementById('query').value,
        boundingBox: map.getBounds()

    }).go().then(handleResults);
}