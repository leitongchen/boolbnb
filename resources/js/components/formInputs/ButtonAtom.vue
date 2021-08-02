<template>
    
    <div>
    
        <button @click.prevent="onClick"> CERCA </button>

    </div>

</template>

<script type="application/javascript">

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