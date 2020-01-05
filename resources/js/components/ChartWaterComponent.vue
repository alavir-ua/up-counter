<template>
	<bar-chart :chart-data="data" :height="150"
	            :options="options"></bar-chart>
</template>

<script>
	import BarChart from './BarChart'
	import { bar_options }  from './BarChart';
	import axios from 'axios'
	export default {
		name:'ChartWaterComponent',
		components: {
			BarChart
		},
		data: function () {
			return {
				data: [],
				options:bar_options
			}
		},
		mounted() {
			this.update()
		},
		methods: {
			update: function () {
				axios.get('/user/chart/water')
					.then((response) => {
						this.data = response.data
					})
					.catch(error => {
						console.log(error);
						this.errored = true;
					})
			}
		}
	}
</script>
