<template>
  <!-- @submit.prevent="createApartment" -->

  <section class="form-message text-center">
    <form
      @submit="createApartment"
      action="/api/apartment"
      method="post"
      enctype="multipart/form-data"
    >
      <h1 class="text-center">Crea un nuovo appartamento</h1>

      <input type="hidden" name="_token" :value="csrf" />
      <input type="hidden" name="user_id" :value="this.userId" />

     <div class="row">
       <div class="col">
         <input-atom
           label="Breve descrizione dell'alloggio"
           name="title"
           v-model="userQuery.title"
         ></input-atom>
        </div>
      </div>

      <input-atom
        label="Indirizzo"
        name="address_street"
        v-model="userQuery.address_street"
      ></input-atom>

      <input-atom
        label="Numero civico"
        name="street_number"
        v-model="userQuery.street_number"
        inputType="number"
      ></input-atom>

      <input-atom
        label="CAP"
        name="zip_code"
        v-model="userQuery.zip_code"
        inputType="number"
      ></input-atom>

      <input-atom
        label="Città"
        name="city"
        v-model="userQuery.city"
      ></input-atom>

      <input-atom
        label="Provincia"
        name="province"
        v-model="userQuery.province"
      ></input-atom>

      <input-atom
        label="Stato"
        name="nation"
        v-model="userQuery.nation"
      ></input-atom>

      <input-atom
        label="Locali"
        name="rooms_number"
        v-model="userQuery.rooms_number"
        inputType="number"
      ></input-atom>

      <input-atom
        label="Posti letto"
        name="beds_number"
        v-model="userQuery.beds_number"
        inputType="number"
      ></input-atom>

      <input-atom
        label="Bagni"
        name="bathrooms_number"
        v-model="userQuery.bathrooms_number"
        inputType="number"
      ></input-atom>

      <input-atom
        label="Superficie"
        name="floor_area"
        v-model="userQuery.floor_area"
        inputType="number"
      ></input-atom>

      <div v-for="extraService in extraServices" :key="extraService.id">
        <label>
          <input
            name="extraServices[]"
            type="checkbox"
            :value="extraService.id"
            v-model="userQuery.extra_services"
          />
          {{ extraService.name }}
        </label>
      </div>

      <!-- @foreach($extraServices as $extraService)
            <label>
                <input name="extraServices[]" type="checkbox" value="{{ $extraService->id }}">
            {{ $extraService->name }}
            </label> <br>
            @endforeach -->

      <!-- <label for="visible">Rendi visibile l'appartamento</label>
      <input
        type="checkbox"
        name="visible"
        id="visible"
        v-model="userQuery.visible"
        checked
      /> -->

      <label for="img_url">Immagine principale</label>
      <input
        type="file"
        name="img_url"
        ref="inputUpload"
        accept=".jpeg, .jpg, .png"
      />
      <br />

      <label for="latitude">
        <input
          type="text"
          id="latitude"
          name="latitude"
          v-model="userQuery.latitude"
        />
      </label>
      <label for="longitude">
        <input
          type="text"
          id="longitude"
          name="longitude"
          v-model="userQuery.longitude"
        />
      </label>

      <a href="#" @click.prevent="getLatLng" class="btn btn-primary"
        >Genera Latitudine e Longitudine</a
      >

      <div class="form-group">
        <button>Crea appartamento</button>
      </div>
    </form>
  </section>
</template>

<script type="application/javascript">
    import InputAtom from '../formInputs/InputAtom.vue';

    export default {
        components: { 
            InputAtom 
        },
        name: "CreateForm",
        props: {
            extraServices: Array,
            userId: Number
        },
        data() {
            return {
                // querySearch: "",

                userQuery: {
                    latitude:"",
                    longitude:"",
                    extra_services: []
                },

                // CSRF
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

                //TOMTOM APIKEY
                api_key: "SznQN02yzAXGOlDubCqT3PTfefEyd5Go",

                auth_token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNmE4NDU3OTc0MDUyMDViNzZhMzhmMzFlZTcwYzVjODliNmUzMDMyYmRkODJjOGJjOTM3ZDg1ZjUzMjQyY2M0Y2ViZDgxNjQxYmQ5MTc4YTYiLCJpYXQiOjE2MjcxOTgxMTQuNTk0NTkyLCJuYmYiOjE2MjcxOTgxMTQuNTk0NjA3LCJleHAiOjE2NTg3MzQxMTQuNTcxNDYyLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.p-RjR6BmklJGosGbYy1B3zDF3eDnMOddKNalJSw5Xfrxo3maqQFK9SUVL60-RaMt1Gcjcl4XOTA7ta29lYkASN3yZrmo7EG_Vn_BvyZZu7rp3gofegeQBgvB1JcMZTeSYVxGjyq2WL0Q3nV-PENfL1OcDSClLCR0_M_cOc4HorgBnvk3D5uRZZlbg6j602cmOWhDCa4axB4Sa-X_1DsBHc6ejKeYCEKdsGps7jNt2uKidSA9Hdo38-NscChCuh60jNghkeyDqwasGXQVPGVqE8-vQRImd4faqyx0t0imosnewQ5KKbmGp4WObuj-qWeVh9xipVjLffxs9Yruy8xHT_VrxJLCOrjSiXnJlR0_tqnbs1SuvXITfL_40xSNf8-BYzsWMPZJsstnDNpP5HKyZRxWrXpNt-koqZ-A8GDS1ZivXGo-tQQjtqXb8vktPF1t4fwwvDZdyaGG0UTO8Mt4b1PClo0JxdGvZq5qSk4Bgwa7cFbsXJ_fim5I-leX7u1p2adJJC18Nj1bpAK8KjOmwZYYPLMYgtATZ241NaO2lpHwZILAqWKZU765yg4B760rg8VpwEy40IYwJzDiZuU1XY_F6BPWAeuTegZR0Lm5aJMfvPUi-u_8Tn-HOA5HTi50rHydeg9t3-X588YLRhEifp7JWzXolHUgnl48vUPWHD0",
                
            }
        },
        methods: {

            // When creating a new apartment
            // we need to also save latitude and longitude fields (already existing but set to null)
            // First: we need to format the address data to obtain only the values and convert to String
                // - address_street 
                // - street_number 
                // - city 
                // - zip_code 
                // - province 
                // - nation
            // Second: we pass the value through the search function and handle the json result
                // where we can find lat and lng values of the specific address
            // Third: we save lat and lng values for each apartment of the array
            // Fourth: the data needs to be sent to backend in order to be stored

            clearQuery(addressObj) {

                let valueArr = (Object.values(addressObj)).join(', ');

                return valueArr;
            },

            getLatLng() {
                
                const el = this.userQuery;
                this.apartmentData = this.userQuery;

                // const el = this.allApartmentsData[2];
                // this.apartmentData = this.allApartmentsData[2];

                console.log(this.apartmentData);
                console.log('ciao');

                let completeAddress = {
                    address_street: el.address_street,
                    street_number: el.street_number,
                    city: el.city,
                    zip_code: el.zip_code,
                    province: el.province,
                    nation: el.nation,
                }  
                
                let addressStr = this.clearQuery(completeAddress);
                this.ttApiRequest(addressStr);          
            },

            setLatLng(position) {

                this.apartmentData.latitude = position.lat;
                this.apartmentData.longitude = position.lng;

            },

            ttApiRequest(query) {

                tt.services.fuzzySearch({
                    key: this.api_key,
                    query: query,
                    // boundingBox: map.getBounds()

                }).go().then(resp => {
                    const position = resp.results[0].position; 
                    this.setLatLng(position);
                })
                .catch(er => {
                    console.log(er);
                });
            },


            createApartment() {

                const imageData = this.$refs.inputUpload.files[0];
                const formData = new FormData();
                formData.append("img_url", imageData);

                // API POST request passing the new apartment object to ApartmentController@store
                axios.post('http://127.0.0.1:8000/api/apartment', { 
                    formData,
                    ...this.apartmentData, 
                    // user_id = this.userId
                    }, 
                    {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        // 'Authorization': `Bearer ${this.auth_token}` 
                    }
                })
                .then(resp => {
                    alert('Apartment added')
                    console.log(resp)
                })
                .catch(er => {
                    console.log(er.response.data);
                })
            }
        },
        mounted() {
            console.log(this.userId)

            //API GET request to get all the apartments saved in db
            // axios.get('http://127.0.0.1:8000/api/user/apartments', {
            //     headers: {
            //         'Authorization': `Bearer ${this.auth_token}` 
            //     }
            // })
            // .then(resp => {
            //     this.allApartmentsData = resp.data.results;
            //     this.getLatLng();
            // })
            // .catch(er => {
            //     console.log(er);
            // })
        }
    }
</script>