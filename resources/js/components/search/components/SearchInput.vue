<template>
    
    <div>
    
        <div class="input-group rounded">

            <form
            ref="form"
            action="/api/apartments/search" method="post">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="latitude" v-model="this.position.lat">
                <input type="hidden" name="longitude" v-model="this.position.lng">
                <input type="hidden" name="query" v-model="this.userQuery.text">

                <input v-model="userQuery.text" type="search" class="form-control rounded" placeholder="cerca un appartamento" aria-label="Search" aria-describedby="search-addon" />
                <button @click.prevent="onClick"><i class="fas fa-search"> CERCA</i></button>

            </form>

        </div>

    </div>


</template>

<script>

export default {
    name: "SearchInput",
    props: {

    },
    data() {
        return {

            // CSRF
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

            //tomtom token
            api_key: "SznQN02yzAXGOlDubCqT3PTfefEyd5Go",

            //Auth key 
            auth_token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNmE4NDU3OTc0MDUyMDViNzZhMzhmMzFlZTcwYzVjODliNmUzMDMyYmRkODJjOGJjOTM3ZDg1ZjUzMjQyY2M0Y2ViZDgxNjQxYmQ5MTc4YTYiLCJpYXQiOjE2MjcxOTgxMTQuNTk0NTkyLCJuYmYiOjE2MjcxOTgxMTQuNTk0NjA3LCJleHAiOjE2NTg3MzQxMTQuNTcxNDYyLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.p-RjR6BmklJGosGbYy1B3zDF3eDnMOddKNalJSw5Xfrxo3maqQFK9SUVL60-RaMt1Gcjcl4XOTA7ta29lYkASN3yZrmo7EG_Vn_BvyZZu7rp3gofegeQBgvB1JcMZTeSYVxGjyq2WL0Q3nV-PENfL1OcDSClLCR0_M_cOc4HorgBnvk3D5uRZZlbg6j602cmOWhDCa4axB4Sa-X_1DsBHc6ejKeYCEKdsGps7jNt2uKidSA9Hdo38-NscChCuh60jNghkeyDqwasGXQVPGVqE8-vQRImd4faqyx0t0imosnewQ5KKbmGp4WObuj-qWeVh9xipVjLffxs9Yruy8xHT_VrxJLCOrjSiXnJlR0_tqnbs1SuvXITfL_40xSNf8-BYzsWMPZJsstnDNpP5HKyZRxWrXpNt-koqZ-A8GDS1ZivXGo-tQQjtqXb8vktPF1t4fwwvDZdyaGG0UTO8Mt4b1PClo0JxdGvZq5qSk4Bgwa7cFbsXJ_fim5I-leX7u1p2adJJC18Nj1bpAK8KjOmwZYYPLMYgtATZ241NaO2lpHwZILAqWKZU765yg4B760rg8VpwEy40IYwJzDiZuU1XY_F6BPWAeuTegZR0Lm5aJMfvPUi-u_8Tn-HOA5HTi50rHydeg9t3-X588YLRhEifp7JWzXolHUgnl48vUPWHD0",
            
            userQuery: {
                text: "",
            },
            position: {
                lat: null,
                lng: null,
            }
        }
    },
    methods: {

        setLatLng(incomingData) {
            this.position.lat = incomingData.lat;
            this.position.lng = incomingData.lng;
        },

        ttApiRequest(query) {

            tt.services.fuzzySearch({
                key: this.api_key,
                query: query,
                // boundingBox: map.getBounds()

            }).go().then(resp => {
                const position = resp.results[0].position; 
                this.setLatLng(position);

                if (this.position.lat && this.position.lng) {

                    this.searchPath(); 
                }
            })
            .catch(er => {
                console.log(er);
            });
        },

        onClick() {
            this.ttApiRequest(this.userQuery.text);   
            debugger 
        },

        searchPath() {

            const formData = new FormData();

            axios.post('http://127.0.0.1:8000/api/apartments/search', formData,
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                    // 'Authorization': `Bearer ${this.auth_token}`
                }
            })
            .then(resp => {
                alert('Apartment added')
                console.log(resp)

                this.$refs.form.submit()
            })
            .catch(er => {
                console.log(er.response.data);
            })
        }
    }
}

</script>