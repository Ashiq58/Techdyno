<template>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Variation Name</th>
                <th>Attributes</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(variation, index) in variations" :key="'v_'+index">
                <td>{{index + 1}}</td>
                <td>{{variation.name}}</td>
                <td>
                    <span class="badge badge-secondary mr-1" v-for="(value, vindex) in variation.value.split(',')" :key="'v_' + index + 'i_' + vindex">{{value}}</span>
                </td>
                <td>
                    <a class="btn btn-warning btn-icon-split" :href="'/variations/edit/' + variation.id">Edit</a> | 
                    <a class="btn btn-danger btn-icon-split" :href="'/variations/delete/' + variation.id">Delete</a>  
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        mounted() {
            this.getData();
        },
        data() {
            return {
                variations: [],
            }
        },
        methods: {
            getData() {
                axios.get('/variations/all')
                .then((response) => {
                    this.variations = response.data;
                })
            }
        }
    }
</script>
