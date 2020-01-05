import { Line , mixins } from 'vue-chartjs'
export default {
	extends: Line,
	mixins: [mixins.reactiveProp],
	props: ['chartData', 'options'],
	mounted () {
		this.renderChart(this.chartData, this.options)
	}
}
const line_options = {
	responsive: true,
	maintainAspectRatio: true,
	legend: {
		display: true,
		labels: {
			fontColor: '#ffffff',
			fontSize: 13,
		}
	},
	scales: {
		xAxes: [{
			ticks: {
				fontColor: '#ffffff',
				fontSize: 13,
			},
			display: true,
			gridLines: {
				display: true,
				lineWidth: 1,
				color: '#ffffff'
			},
		}],
		yAxes: [{
			ticks: {
				callback: function (value, index, values) {
					return '₴' + value;
				},
				fontColor: '#ffffff',
				fontSize: 13,
				padding: 2
			},
			display: true,
			gridLines: {
				display: true,
				lineWidth: 1,
				color: '#ffffff'
			},
		}]
	}
};
export { line_options };


