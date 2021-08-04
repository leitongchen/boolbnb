<template>
  <div>   

    <div class="search_page">
      
      <div class="left_side container-fluid">

        <div class="search_form">
          <div class="container">

            <h3 class="text-center">Cerca un alloggio</h3>

            <form ref="form"
              action="/api/apartments/search/filter"
              method="get"
              @submit.prevent="onClick"
              @reset="onReset">
                

              <div class="row">
                <div class="col">
                  
                  <div class="row">
                    <div class="col">

                      <input-atom
                      label="Località"
                      v-model="filters.query"
                      inputType="text"
                      ></input-atom>

                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col">
                      <input-atom
                        label="Locali"
                        v-model="filters.rooms_number"
                        inputType="number"
                      ></input-atom>
                    </div>

                    <div class="col">
                      <input-atom
                        label="Ospiti"
                        v-model="filters.beds_number"
                        inputType="number"
                      ></input-atom>
                    </div>

                    <div class="col">
                      <input-atom
                        label="Raggio di"
                        v-model="filters.radius"
                        inputType="number"
                      ></input-atom>
                    </div>
                  </div>
                </div>

                <div class="col">
                  
                  <span class="label">Filtra per servizi</span>

                  <div class="extra-service">

                    <multi-check-atom
                      label=""
                      :items="extra_servicesList"
                      v-model="filters.extra_services"
                    ></multi-check-atom>

                  </div>

                
                </div>
              </div>

              <div class="row">
                <div class="col">

                  <div class="btns_container d-flex justify-content-center">

                    <div class="btn_box">
                      <button type="submit" class="btn_bool btn_primary">Filtra</button>
                    </div>

                    <div class="btn_box">
                      <button type="reset" class="btn_bool btn_outline">
                        Annulla
                      </button>
                    </div>

                  </div>

                </div>
              </div>
            </form>

          </div>
        </div>

        <div class="apartments_container row">
          
          <div v-for="el in finalList" :key="el.id" 
          class="col-md-12 col-lg-6 my_col">
            
            <apartment-card
            :apartment="el"
            ></apartment-card>
              
             
          </div>
        </div>

      </div>

      <div class="right_side">

        <div class="map_container">

          <boolbnb-map
          :lat="filters.position.lat"
          :long="filters.position.lng"
          :apartments="finalList"
          :key="count">
          </boolbnb-map>

        </div>

      </div>

    </div>     

  </div>
</template>

<script type="application/javascript">

export default {
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
        beds_number: null,
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
      console.log(this.apartments)

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