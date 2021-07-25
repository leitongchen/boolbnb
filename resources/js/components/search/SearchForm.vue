<template>
    <div>
        <div>
            <h1>prova 2</h1>
            <input type="text" id="query" v-model="querySearch" @input="$emit('input', $event.currentTarget.value)">
            <button type="submit" @click="search">Cerca</button>
        </div>


        <!-- <form @submit.prevent="search"
        action="#" method="post" enctype="multipart/form-data">
                
            <input-atom
                label="Titolo riepilogativo"
                name="title"
                v-model="userQuery.titleInput"
            ></input-atom>

            <input-atom
                label="Via"
                name="address_street"
                v-model="userQuery.addressStreetInput"
            ></input-atom>

            <input-atom
                label="Numero civico"
                name="street_number"
                v-model="userQuery.streetNumberInput"
                inputType="number"
            ></input-atom>

            <input-atom
                label="CAP"
                name="zip_code"
                v-model="userQuery.zipCodeInput"
                inputType="number"
            ></input-atom>

            <input-atom
                label="Città"
                name="city"
                v-model="userQuery.cityInput"
            ></input-atom>

            <input-atom
                label="Provincia"
                name="province"
                v-model="userQuery.provinceInput"
            ></input-atom>  

            <input-atom
                label="Stato"
                name="nation"
                v-model="userQuery.nationInput"
            ></input-atom>

            <input-atom
                label="Locali"
                name="rooms_number"
                v-model="userQuery.roomsNumberInput"
                inputType="number"
            ></input-atom>

            <input-atom
                label="Posti letto"
                name="beds_number"
                v-model="userQuery.bedsNumberInput"
                inputType="number"
            ></input-atom>

            <input-atom
                label="Bagni"
                name="bathrooms_number"
                v-model="userQuery.bathroomsNumberInput"
                inputType="number"
            ></input-atom>

            <input-atom
                label="floor_area"
                name="Superficie"
                v-model="userQuery.floorAreaInput"
                inputType="number"
            ></input-atom>


            <label for="visible">Rendi visibile l'appartamento</label>
            <input type="checkbox" name="visible" id="visible"> <br>


            <label for="img_url">Immagine principale</label>
            <input type="file" name="img_url" accept=".jpeg, .jpg, .png">

            <div class="form-group">
                <button type="submit">Cerca</button>
            </div>
        
        </form> -->
    
    </div>

</template>

<script>
import InputAtom from '../formInputs/InputAtom.vue';
    export default {
  components: { InputAtom },
        name: "SearchForm",
        props: {
        
        },
        data() {
            return {
                userQuery: {},

                querySearch: "",
                api_key: "SznQN02yzAXGOlDubCqT3PTfefEyd5Go",

                auth_token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNmE4NDU3OTc0MDUyMDViNzZhMzhmMzFlZTcwYzVjODliNmUzMDMyYmRkODJjOGJjOTM3ZDg1ZjUzMjQyY2M0Y2ViZDgxNjQxYmQ5MTc4YTYiLCJpYXQiOjE2MjcxOTgxMTQuNTk0NTkyLCJuYmYiOjE2MjcxOTgxMTQuNTk0NjA3LCJleHAiOjE2NTg3MzQxMTQuNTcxNDYyLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.p-RjR6BmklJGosGbYy1B3zDF3eDnMOddKNalJSw5Xfrxo3maqQFK9SUVL60-RaMt1Gcjcl4XOTA7ta29lYkASN3yZrmo7EG_Vn_BvyZZu7rp3gofegeQBgvB1JcMZTeSYVxGjyq2WL0Q3nV-PENfL1OcDSClLCR0_M_cOc4HorgBnvk3D5uRZZlbg6j602cmOWhDCa4axB4Sa-X_1DsBHc6ejKeYCEKdsGps7jNt2uKidSA9Hdo38-NscChCuh60jNghkeyDqwasGXQVPGVqE8-vQRImd4faqyx0t0imosnewQ5KKbmGp4WObuj-qWeVh9xipVjLffxs9Yruy8xHT_VrxJLCOrjSiXnJlR0_tqnbs1SuvXITfL_40xSNf8-BYzsWMPZJsstnDNpP5HKyZRxWrXpNt-koqZ-A8GDS1ZivXGo-tQQjtqXb8vktPF1t4fwwvDZdyaGG0UTO8Mt4b1PClo0JxdGvZq5qSk4Bgwa7cFbsXJ_fim5I-leX7u1p2adJJC18Nj1bpAK8KjOmwZYYPLMYgtATZ241NaO2lpHwZILAqWKZU765yg4B760rg8VpwEy40IYwJzDiZuU1XY_F6BPWAeuTegZR0Lm5aJMfvPUi-u_8Tn-HOA5HTi50rHydeg9t3-X588YLRhEifp7JWzXolHUgnl48vUPWHD0",
            
                allApartmentsData: [],
            }
        },
        methods: {
            // if there are results
            // the position of the first result on the array of results 
            // were passed to the moveMap function
            handleResults(result) {
                console.log(result)

                // if (result.results) {
                //     moveMap(result.results[0].position)
                // }

                // var marker = new tt.Marker()
                // .setLngLat(result.results[0].position)
                // .addTo(map);
            },

            // search for locations based on the query 
            // results were passed through the handleResults function
            search() {
                let query; 
                if (this.userQuery) {
                    query = this.clearQuery(this.userQuery);

                    console.log(query)
                }
                query = this.querySearch;

                tt.services.fuzzySearch({
                    key: this.api_key,
                    query: query,
                    // boundingBox: map.getBounds()

                }).go().then(this.handleResults);
            },

            clearQuery(...data) {
                // console.log(data)

                let valueArr = (Object.values(data[0])).join(', ');
                // console.log(valueArr);

                return valueArr;
            }

            
            // for every apartment (object)
            // we needs to also save latitude and longitude fields (already created but set to null)
            // First: we need to format the address data to obtain only the values
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
        },
        mounted() {

            // API request for db apartments
            axios.get('http://127.0.0.1:8000/api/user/apartments', {
                headers: {
                    'Authorization': `Bearer ${this.auth_token}` 
                }
            })
            .then(resp => {
                this.allApartmentsData = resp.data.results;
            })
            .catch(er => {
                console.log(er);
            })
        }
    }
</script>