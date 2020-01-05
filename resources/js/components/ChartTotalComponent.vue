<template>
	<line-chart :chart-data="data" :height="150"
	            :options="options"></line-chart>
</template>

<script>
	import LineChart from './LineChart'
	import { line_options }  from './LineChart';
	import axios from 'axios'
	export default {
		name: 'ChartTotalComponent',
		components: {
			LineChart
		},
		data: function () {
			return {
				data: [],
				options: line_options
			}
		},
		mounted() {
			this.update()
		},
		methods: {
			update: function () {
				axios.get('/user/chart/total')
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




