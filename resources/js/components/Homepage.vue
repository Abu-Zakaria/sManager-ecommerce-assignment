<template>
	<div>
		<div class="row">
			<ProductCard v-for="product in products" :key="product.id" :product="product" col_md="4"></ProductCard>
		</div>
	</div>
</template>

<script>
	import ProductCard from './ProductCard.vue';

	export default {
		name: "Homepage",
		components: {
			ProductCard
		},
		data() {
			return {
				products: []
			}
		},
		mounted()
		{
			this.getProducts();

			console.log(this);
		},
		methods:
		{
			getProducts()
			{
				axios.get('/api/products')
					.then(response => {
						if(response.status == 200)
						{
							this.products = response.data;
						}
					})
					.catch(error => {
						console.log("got an error while fetching products", error.response);
					})
			}
		}
	}
</script>