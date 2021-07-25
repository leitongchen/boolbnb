<template>

    <div>
        <label :for="label"> {{ label }} </label>
        <input :type="inputType" 
            :name="label" 
            :id="label"
            :value="value"
            @input="$emit('input', $event.currentTarget.value)"
        />
    </div>

</template>

<script>
    export default {
        name: "InputAtom",
        props: {
            label: String,
            name: String,
            value: String,
            inputType: {
                type: String,
                default: "text",
            },
        },
    }
</script>