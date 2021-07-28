<template>
  <div>
    <!-- @reset="onReset" -->
    <!-- @submit.prevent="filterData" -->

    <div class="card mb-3">
      <div class="card-body">
        <form @submit.prevent="filterData" @reset="onReset">
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
            </div>

            <div class="col">
              <multi-check-atom
                label="Servizi Extra"
                :items="extra_servicesList"
                v-model="filters.extra_services"
                @input="onInput"
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

    <div class="alert alert-success mb-5" v-if="filtriAttivi">
      Sono stati trovati {{ apartamentsList.length }} risulati per il filtro:
      <div v-html="printActiveFilters()"></div>
    </div>
  </div>
</template>

<script>
import InputAtom from "./formInputs/InputAtom.vue";
import MultiCheckAtom from "./formInputs/MultiCheckAtom.vue";

export default {
  components: { InputAtom, MultiCheckAtom },
  name: "ApartmentsIndex",
  props: {},
  data() {
    return {
      apartamentsList: [],
      filters: {
        query: null,
        rooms_number: null,
        bathrooms_number: null,
        extra_services: [],
      },
      filtriAttivi: null,
      extra_servicesList: null,
    };
  },
  methods: {
    filterData() {
      axios
        .get("/api/apartments/search", {
          params: this.filters,
        })
        .then((resp) => {
          this.apartamentsList = resp.data.results;
          this.filtriAttivi = resp.data.filters;
        })
        .catch((er) => {
          console.error(er);
          alert("Errore in fase di filtraggio dati.");
        });
    },
    onInput() {
      console.log("ciao");
    },

    printActiveFilters() {
      const toReturn = [];

      if (Object.keys(this.filtriAttivi).length === 0) {
        return;
      }

      for (const chiaveFiltro in this.filtriAttivi) {
        toReturn.push(chiaveFiltro + " = " + this.filtriAttivi[chiaveFiltro]);
      }

      return toReturn.join("<br>");
    },

    onReset() {
      this.filtriAttivi = null;
    },
  },
  mounted() {
    axios
      .get("/api/extra-services")
      .then((resp) => {
        this.extra_servicesList = resp.data.results;
      })
      .catch((er) => {
        console.error(er);

        alert("Non posso recuperare gli extra service");
      });
  },
};
</script>