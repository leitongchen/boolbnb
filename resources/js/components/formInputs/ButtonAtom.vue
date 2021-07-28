<template>
    
    <div>
    
        <button @click.prevent="onClick"> CERCA </button>

    </div>

</template>

<script>

export default {
    name: "ButtonAtom",
    props: {

    },
    data() {
        return {

        }
    },
    methods: {

        onClick() {
            this.$emit("submitted")
        },

    }
}

</script>