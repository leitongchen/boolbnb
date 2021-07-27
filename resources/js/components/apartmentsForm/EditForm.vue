<template>
<!-- @submit.prevent="createApartment" -->
    <div>
        <form @submit="createApartment"
        action="/api/apartament/edit" method="post" enctype="multipart/form-data">

            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="apartment_id" :value="this.apartment.id">
            <input type="hidden" name="user_id" :value="this.userId">

            <input-atom
                label="Titolo riepilogativo"
                name="title"
                v-model="apartment.title"
            ></input-atom>

            <input-atom
                label="Via"
                name="address_street"
                v-model="apartment.address_street"
            ></input-atom>

            <input-atom
                label="Numero civico"
                name="street_number"
                v-model="apartment.street_number"
                inputType="number"
            ></input-atom>

            <input-atom
                label="CAP"
                name="zip_code"
                v-model="apartment.zip_code"
                inputType="number"
            ></input-atom>

            <input-atom
                label="Città"
                name="city"
                v-model="apartment.city"
            ></input-atom>

            <input-atom
                label="Provincia"
                name="province"
                v-model="apartment.province"
            ></input-atom>  

            <input-atom
                label="Stato"
                name="nation"
                v-model="apartment.nation"
            ></input-atom>

            <input-atom
                label="Locali"
                name="rooms_number"
                v-model="apartment.rooms_number"
                inputType="number"
            ></input-atom>

            <input-atom
                label="Posti letto"
                name="beds_number"
                v-model="apartment.beds_number"
                inputType="number"
            ></input-atom>

            <input-atom
                label="Bagni"
                name="bathrooms_number"
                v-model="apartment.bathrooms_number"
                inputType="number"
            ></input-atom>

            <input-atom
                label="Superficie"
                name="floor_area"
                v-model="apartment.floor_area"
                inputType="number"
            ></input-atom>

            <div v-for="extraService in extraServices" :key="extraService.id">

                <label>
                    <input name="extraServices[]" type="checkbox" 
                    :value="extraService.id" 
                    v-model="checkedExtraServices"
                    >
                    {{ extraService.name }}
                </label>
                <!-- checkedServices.includes(extraService.id) -->

            </div>

            <label for="visible">Rendi visibile l'appartamento</label>
            <input type="checkbox" name="visible" id="visible" v-model="apartment.visible"> <br>

            <label for="img_url">Immagine principale</label>
            <input type="file" name="img_url" ref="inputUpload" accept=".jpeg, .jpg, .png"> <br>
            
            <label for="latitude">
                <input type="text" id="latitude" name="latitude" v-model="apartment.latitude">
            </label>

            <label for="longitude">
                <input type="text" id="longitude" name="longitude" v-model="apartment.longitude">
            </label>

            <a href="#" @click.prevent="getLatLng" class="btn btn-primary">Genera Latitudine e Longitudine</a>

            <div class="form-group">
                <button>Fatto</button>
            </div>
        
        </form>
    
    </div>

</template>

<script>
    import InputAtom from '../formInputs/InputAtom.vue';

    export default {

        components: { 
            InputAtom 
        },
        name: "EditForm",
        props: {
            apartment: Object,
            extraServices: Array,
            apExtraservices: Array,
            userId: Number
        },
        data() {
            return {

                // CSRF
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

                //TOMTOM APIKEY
                api_key: "SznQN02yzAXGOlDubCqT3PTfefEyd5Go",

                auth_token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNmE4NDU3OTc0MDUyMDViNzZhMzhmMzFlZTcwYzVjODliNmUzMDMyYmRkODJjOGJjOTM3ZDg1ZjUzMjQyY2M0Y2ViZDgxNjQxYmQ5MTc4YTYiLCJpYXQiOjE2MjcxOTgxMTQuNTk0NTkyLCJuYmYiOjE2MjcxOTgxMTQuNTk0NjA3LCJleHAiOjE2NTg3MzQxMTQuNTcxNDYyLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.p-RjR6BmklJGosGbYy1B3zDF3eDnMOddKNalJSw5Xfrxo3maqQFK9SUVL60-RaMt1Gcjcl4XOTA7ta29lYkASN3yZrmo7EG_Vn_BvyZZu7rp3gofegeQBgvB1JcMZTeSYVxGjyq2WL0Q3nV-PENfL1OcDSClLCR0_M_cOc4HorgBnvk3D5uRZZlbg6j602cmOWhDCa4axB4Sa-X_1DsBHc6ejKeYCEKdsGps7jNt2uKidSA9Hdo38-NscChCuh60jNghkeyDqwasGXQVPGVqE8-vQRImd4faqyx0t0imosnewQ5KKbmGp4WObuj-qWeVh9xipVjLffxs9Yruy8xHT_VrxJLCOrjSiXnJlR0_tqnbs1SuvXITfL_40xSNf8-BYzsWMPZJsstnDNpP5HKyZRxWrXpNt-koqZ-A8GDS1ZivXGo-tQQjtqXb8vktPF1t4fwwvDZdyaGG0UTO8Mt4b1PClo0JxdGvZq5qSk4Bgwa7cFbsXJ_fim5I-leX7u1p2adJJC18Nj1bpAK8KjOmwZYYPLMYgtATZ241NaO2lpHwZILAqWKZU765yg4B760rg8VpwEy40IYwJzDiZuU1XY_F6BPWAeuTegZR0Lm5aJMfvPUi-u_8Tn-HOA5HTi50rHydeg9t3-X588YLRhEifp7JWzXolHUgnl48vUPWHD0",
            
                apartmentData: this.apartment,
                checkedExtraServices: [],
            }
        },
        methods: {

            extraServicesCheck() {
                let services = [];

                this.apExtraservices.forEach( el => {
                    services.push(el.id);
                })

                return this.checkedExtraServices = services; 
            },

            // set extra services on userQuery obj
            setExtraServices() {
                let services = [];

                this.apExtraservices.forEach( el => {
                    services.push(el.id);
                })

                this.apartment.extra_services = services;
            },

            // after user click
            // retrieve complete address from form
            // clean the query and make api request to tomtom
            getLatLng() {
                
                const el = this.apartmentData;

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

            // save lat and lng values to aparmentData(obj)
            setLatLng(position) {

                this.apartment.latitude = position.lat;
                this.apartment.longitude = position.lng;

            },

            // API reequest to tomtom return lat and lng position values
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
                formData.append('_method', 'PUT');

                // API POST request passing the new apartment object to ApartmentController@store
                axios.put('http://127.0.0.1:8000/api/apartament/edit', { 
                    formData,
                    ...this.apartmentData,
                    ...this.checkedExtraServices,
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
            },

            clearQuery(addressObj) {

                let valueArr = (Object.values(addressObj)).join(', ');

                return valueArr;
            },

        },
        mounted() {
            this.extraServicesCheck();
            console.log(this.userId);
        }
    }
</script>