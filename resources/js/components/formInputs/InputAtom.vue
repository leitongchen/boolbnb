<template>

    <div>
        <label :for="label"> {{ label }} </label>
        <input :type="inputType" 
            :name="name" 
            :id="label"
            :value="value"
            @input="$emit('input', $event.currentTarget.value)"
            class="form-control"
        />
    </div>

</template>

<script type="application/javascript">
    export default {
        name: "InputAtom",
        props: {
            label: String,
            name: String,
            value: [String, Number],
            inputType: {
                type: String,
                default: "text",
            },
        },
    }
</script>