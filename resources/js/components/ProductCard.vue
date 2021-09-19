<template>
	<div :class=" 'col-md-' + col_md ">
		<div class="card product-card col-md-12 mb-2">
			<div class="card-body">
				<p>{{ product.name }}</p>
				<p>{{ product.price }}</p>

				<form method="POST" :action="'/add-to-cart/' + product.id">
					<input type="hidden" name="_token" :value="csrf_token">
					<button class="btn btn-primary">Add to cart</button>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: "ProductCard",
		props: [
			'col_md',
			'product'
		],
		data() {
			return {
				csrf_token: ''
			}
		},
		mounted()
		{
			this.csrf_token = csrf_token;
		}
	}
</script>

<style scoped>
	.product-card
	{
	}
</style>