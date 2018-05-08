<template>
    <div>
        <input type="text" :name="name" class="form-control" :id="id">
    </div>
</template>

<script>
    export default {
        props: ['id', 'name'],

        mounted() {
            jQuery('#' + this.id).datepicker({});
        }
    };
</script>
