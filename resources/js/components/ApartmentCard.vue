<template>
    <div>

        <div class="card text-center" style="width: 18rem;">
            <img :src="'../../storage/' + this.apartment.img_url" class="card-img-top" alt="...">
            <div class="card-body">
                <h3>{{ this.apartment.title }}</h3>
                <p>{{ this.apartment.city }}</p>
                <!-- <p>{{ this.apartment.address_street + ' nr ' . this.apartment.street_number + ', ' + this.apartment.city + ', ' + this.apartment.zip_code + ', ' + this.apartment.nation }}</p> -->
                <button class="text-center btn btn-secondary"><a href="#">Vedi i dettagli</a></button>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        name: 'ApartmentCard',
        props: {
            apartment: Object
        },
        // data() {
        //     return {
        //         apartment: this.apartment, 
        //     }
        // },
        mounted() {
            console.log(this.apartment)
            // console.log(this.apartment.address_street + ' nr ' . this.apartment.street_number + ', ' + this.apartment.city + ', ' + this.apartment.zip_code + ', ' + this.apartment.nation)

            // debugger
            // console.log('era una bella da dio')
        }
    }
</script>