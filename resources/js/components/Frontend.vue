<template>
    
  <div class="row">
	<div class="col-3 mt-3" v-for="(product, pindex) in products" :key="'p_'+pindex">
		<div class="card">
            <div class="card-header">{{product.name}}</div>
            <div class="card-body">
                <p>{{product.detail}}</p>
                <p v-for="(variation, varindex) in product.variations" :key="'p_'+pindex + 'var_'+varindex">
                    <b><span>{{ variation.name}}:</span></b>
                    <span class="badge badge-secondary mr-1" v-for="(value, vindex) in variation.value.split(',')" :key="'v_' + pindex  + 'var_'+varindex + 'i_' + vindex">{{value}}</span>
                </p>
            </div>
            <div class="card-footer text-right">
                <button class="btn btm-sm btn-info">Add to cart</button>
            </div>
		</div>
	</div>
  </div>
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
