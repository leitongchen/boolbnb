<template>
  <div>
    <!-- @reset="onReset" -->
    <!-- @submit.prevent="filterData" -->

    <div class="card mb-3">
      <div class="card-body">
          
        <form ref="form"
          action="/api/apartments/search/filter"
          method="get"
          @submit.prevent="onClick"
          @reset="onReset">
            

            <div class="row">
              <div class="col">

                <input-atom
                  label="Località"
                  v-model="filters.query"
                  inputType="text"
                ></input-atom>


                <input-atom
                  label="Locali"
                  v-model="filters.rooms_number"
                  inputType="number"
                ></input-atom>

                <input-atom
                  label="Bagni"
                  v-model="filters.bathrooms_number"
                  inputType="number"
                ></input-atom>

                <input-atom
                  label="Cerca nel raggio di"
                  v-model="filters.radius"
                  inputType="number"
                ></input-atom>km

              </div>

              <div class="col">
                

                <multi-check-atom
                  label="Servizi Extra"
                  :items="extra_servicesList"
                  v-model="filters.extra_services"
                ></multi-check-atom>

              
              </div>
            </div>

          <button type="submit" class="btn btn-primary">Filtra</button>
          <button type="reset" class="btn btn-outline-secondary">
            Annulla filtri
          </button>
        </form>


      </div>
    </div>

    <div class="alert alert-success mb-5" v-if="activeFilters">
      Sono stati trovati {{ finalList.length }} risultati per il filtro:
      <div v-html="printActiveFilters()"></div>
    </div>

    <div>

      <boolbnb-map
      :lat="filters.position.lat"
      :long="filters.position.lng"
      :apartments="finalList"
      :key="count">
      </boolbnb-map>

    </div>

  </div>
</template>

<script type="application/javascript">
// import InputAtom from "./formInputs/InputAtom.vue";
// import MultiCheckAtom from "./formInputs/MultiCheckAtom.vue";

export default {
  // components: { InputAtom, MultiCheckAtom },
  name: "ApartmentsIndex",
  props: 
  {
    apartments: Array,
    latitude: Number,
    longitude: Number,
    searchQuery: String
  },
  // [
  //   'apartments',
  //   'latitude', 
  //   'longitude',
  //   'query'
  // ],
  data() {
    return {
      apartamentsList: [],
      extra_servicesList: [],

      // at first finalList will contain the array of apartments coming from search.blade (props: apartments)
      // when filters selected, the finalList will contain an array of filtered apartments
      // finalList must be rendered
      finalList: [],

      filters: {
        query: this.searchQuery,
        position: {
          lat: this.latitude,
          lng: this.longitude,
        },
        radius: 20,
        rooms_number: null,
        bathrooms_number: null,
        extra_services: [],
      },
      activeFilters: null,

      count: 0,

      //tomtom token
      api_key: "SznQN02yzAXGOlDubCqT3PTfefEyd5Go",

      // CSRF
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

    };
  },
  computed: {
    setLat() {
      return this.filters.position.lat;
    },
    setLng() {
      return this.filters.position.lng;
    },
  },
  methods: {

    filterData() {
      axios.get("/api/apartments/search/filter", {
            params: this.filters
        })
        .then((resp) => {
            this.finalList = resp.data.results;
            this.activeFilters = resp.data.filters;
            console.log(resp)
        })
        .catch((er) => {
            if( er.response ){
                console.log(er.response.data); // => the response payload 
            }
            alert("Errore in fase di filtraggio dati.");
        });
    },

    printActiveFilters() {
      const toReturn = [];

      if (Object.keys(this.activeFilters).length === 0) {
        return;
      }

      for (const chiaveFiltro in this.activeFilters) {
        toReturn.push(chiaveFiltro + " = " + this.activeFilters[chiaveFiltro]);
      }

      return toReturn.join("<br>");
    },

    onReset() {
      this.activeFilters = null;
      this.finalList = this.apartamentsList;
    },

    setLatLng(incomingData) {
      this.filters.position.lat = incomingData.lat;
      this.filters.position.lng = incomingData.lng;

      console.log(incomingData);
    },

    ttApiRequest(query) {

        tt.services.fuzzySearch({
            key: this.api_key,
            query: query,
            // boundingBox: map.getBounds()

        }).go().then((resp) => {
            const position = resp.results[0].position; 
            this.setLatLng(position);

            this.filterData();
            this.count++;

        })
        .catch((er) => {
            console.log(er);
        });
    },

    onClick() {
        this.ttApiRequest(this.filters.query);   

        
    },
  },
  mounted() {
      console.log(this.filters.position.lat)
      console.log(this.filters.position.lng)

      this.finalList = this.apartments;

      axios.get("/api/apartments")
        .then((resp) => {
            this.apartamentsList = resp.data.results;
            this.activeFilters = resp.data.filters;
        })
        .catch((er) => {
            console.error(er);
            alert("Non è stato possibile recuperare gli appartamenti.");
        });


      axios.get("/api/extra-services")
        .then((resp) => {
          this.extra_servicesList = resp.data.results;
        })
        .catch((er) => {
          console.error(er);

          alert("Non posso recuperare gli extra service");
        });
  },
}
</script>