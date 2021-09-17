<template>
	<div>
		<div class="row">
			<ProductCard col_md="4"></ProductCard>
			<ProductCard col_md="4"></ProductCard>
			<ProductCard col_md="4"></ProductCard>
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

			}
		}
	}
</script>