<template>
	<div :class=" 'col-md-' + col_md ">
		<div class="card product-card col-md-12">
			<div class="card-body">
				<p>Product name</p>
				<p>Price</p>
				<button class="btn btn-primary">Add to cart</button>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: "ProductCard",
		props: ['col_md'],
		data() {
			return {

			}
		}
	}
</script>

<style scoped>
	.product-card
	{
	}
</style>