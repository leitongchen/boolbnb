<template>
    <div>

        <div class="card my-apartment-card">

            <div class="my-card-img-container">
                <img :src="'../../storage/' + this.apartment.img_url" class="card-img-top my-card-img-top img-fluid">
            </div>

            <div class="card-body my-card-body d-flex align-content-around flex-column">

                <h5 class="card-title my-card-title">
                    {{ this.apartment.title }}
                </h5>
                <p class="apartment_details_card">
                    <span>{{ this.apartment.rooms_number }} stanze</span>
                    <span>{{ this.apartment.beds_number }} letti</span>
                    <span>{{ this.apartment.bathrooms_number }} bagni</span>
                </p>

                <p class="service_details_card">
                    {{ this.printExtraServices() }}
                </p>

                <div class="m-auto my-btn-container">
                    <a :href="createApartmentLink()" class="btn_bool btn_outline link_bool">Vedi i dettagli</a>
                </div>

            </div>

        </div>

         <!-- 
        <img :src="'../../storage/' + this.apartment.img_url" class="card-img-top" alt="...">
        <div class="card-body">
            <h3>{{ this.apartment.title }}</h3>
            <p>{{ this.apartment.city }}</p>
           <p>{{ this.apartment.address_street + ' nr ' . this.apartment.street_number + ', ' + this.apartment.city + ', ' + this.apartment.zip_code + ', ' + this.apartment.nation }}</p> 
            <button class="text-center btn btn-secondary"><a href="#">Vedi i dettagli</a></button>
        </div>
        -->

    </div>

</template>

<script>
    export default {
        name: 'ApartmentCard',
        props: {
            apartment: Object
        },
        data() {
            return {
                extraServices: this.apartment.extra_services, 
            }
        },
        methods: {
            printExtraServices() {

                let servicesList = [];
                
                this.extraServices.forEach(service => {

                    if (servicesList.length <= 2) {
                        servicesList.push(service.name)
                    }  
                }); 

                return servicesList.join(' - ')
            },
            createApartmentLink() {
                // http://127.0.0.1:8000/apartments/{{this.apartment.id}}
                return "http://127.0.0.1:8000/apartments/" + this.apartment.id
            }
        },
        mounted() {
            console.log(this.extraServices)
            // console.log(this.apartment.address_street + ' nr ' . this.apartment.street_number + ', ' + this.apartment.city + ', ' + this.apartment.zip_code + ', ' + this.apartment.nation)

            // debugger
            // console.log('era una bella da dio')
        }
    }
</script>