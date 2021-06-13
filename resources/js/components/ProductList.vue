<template>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Detail</th>
                <th>Variations</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(product, index) in products" :key="'p_'+index">
            <td>{{index + 1}}</td>
                <td>{{product.name}}</td>
                <td>{{product.detail}}</td>
                <td style="width: 50%">
                    <span v-for="(variation, vindex) in product.variations" :key="'p_'+index+'a_'+vindex"> {{variation.name + '(attributes: ' + variation.value + ')'}} </span>
                </td>
                <td>
                    <a class="btn btn-warning btn-icon-split" :href="'/products/edit/' + product.id">Edit</a> | 
                    <a class="btn btn-danger btn-icon-split" :href="'/products/delete/' + product.id">Delete</a> 
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
                products: [],
            }
        },
        methods: {
            getData() {
                axios.get('/products/all')
                .then((response) => {
                    this.products = response.data;
                })
            }
        }
    }
</script>
