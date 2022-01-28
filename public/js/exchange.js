/*																	Создание графика																*/
const ctx = document.getElementById('myChart');
/*																	Массивы данных графика																*/
const dateArrayD15 = [
{x :"2020-07-01", y:"10"},
{x :"2020-07-02", y:"50"},
{x :"2020-07-03", y:"45"},
{x :"2020-07-04", y:"55"},
{x :"2020-07-05", y:"57"},
{x :"2020-07-06", y:"56"},
{x :"2020-07-07", y:"50"},
{x :"2020-07-08", y:"45"},
{x :"2020-07-09", y:"50"},
{x :"2020-07-10", y:"53"},
{x :"2020-07-11", y:"50"},
{x :"2020-07-12", y:"59"},
{x :"2020-07-13", y:"75"},
{x :"2020-07-14", y:"79"},
{x :"2020-07-15", y:"85"}
]
const dateArrayMon = [
{x :"2020-06-15", y:"10"},
{x :"2020-06-17", y:"10"},
{x :"2020-06-19", y:"10"},
{x :"2020-06-21", y:"10"},
{x :"2020-06-23", y:"10"},
{x :"2020-06-25", y:"10"},
{x :"2020-06-27", y:"10"},
{x :"2020-06-29", y:"10"},
{x :"2020-07-02", y:"50"},
{x :"2020-07-04", y:"55"},
{x :"2020-07-06", y:"56"},
{x :"2020-07-08", y:"45"},
{x :"2020-07-10", y:"53"},
{x :"2020-07-12", y:"59"},
{x :"2020-07-14", y:"79"},
{x :"2020-07-15", y:"89"},
]
const dateArray3Mon = [
{x :"2020-04-01", y:"1"},
{x :"2020-04-09", y:"2"},
{x :"2020-04-17", y:"3"},
{x :"2020-04-25", y:"4"},
{x :"2020-05-03", y:"5"},
{x :"2020-05-11", y:"6"},
{x :"2020-05-19", y:"7"},
{x :"2020-05-27", y:"8"},
{x :"2020-06-05", y:"9"},
{x :"2020-06-13", y:"10"},
{x :"2020-06-21", y:"50"},
{x :"2020-06-29", y:"59"},
{x :"2020-07-07", y:"79"},
{x :"2020-07-15", y:"73"},
{x :"2020-07-23", y:"85"}
]
/*																	Массивы данных графика																*/

/*																	Инициализация графика																*/
Chart.defaults.plugins.legend.display = false;
Chart.defaults.font.weight = '500';
// Chart.defaults.plugins.tooltips.displayColors = false;
Chart.defaults.font.size = 11;
const myChart = new Chart(ctx, {
	type: 'line',
	data: {
	// labels: parseDateArray,
	datasets: [{
		label: "",
		data: dateArrayD15,
		// pointRadius: 4,
		pointBackgroundColor: '#ffbb74',
		backgroundColor: [
		'#fff',
		],
		borderColor: [
		'#ffbb74'
		],
		borderWidth: 2,
	}]
},
options: {
	scales: {
		y: {
			beginAtZero: true,
			ticks: {
				min: 0,
				max: 100,
				stepSize: 20
			},
			grid: {
				borderDash: [8, 4],
			}
		},
		x: {
			grid: {
				display: false,
				drawBorder: true
			},
			type: 'time',
			time: {
				unit: 'day',
				tooltipFormat: 'dd-MM-yyyy',
				displayFormats: {
					"day": 'dd-MM yyyy'
				},
			},
			ticks: {
				autoSkip: false,
				maxRotation: 0,
				count:5,
				maxTicksLimit: 16,
				stepSize:10,
				color: "#000",
				callback: function(label, index, labels) {
              if (/\s/.test(label)) {
                 label = label.split(" ");
                return label;

              }else{
                return label;
              }              
            }
			},
		},
	},
	plugins: {
		tooltip: {
			backgroundColor: '#000',
			titleColor:'#ffbb74',
			bodyColor:'#ffbb74',
			displayColors: false,
			callbacks: {
                    label: function(context) {
                        let label = context.dataset.label || '';

                        if (label) {
                            label += ': ';
                        }
                        if (context.parsed.y !== null) {
                            label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(context.parsed.y);
                        }
                        return label;
                    }
                }
		},
	},
	responsive:true,
	maintainAspectRatio: false,
}
});
/*																	Инициализация графика																*/

/*																	Изменение данных графика																*/
chartButton = document.querySelectorAll(".chart__time-period_button");
chartButton.forEach(button => {
	button.addEventListener('click', changeTimePeriod);
})
function changeTimePeriod() {
	chartButton.forEach(button => {
		button.classList.remove('active');
	})
	this.classList.add('active');
	if(this.id == "d15") {
		myChart.data.datasets[0].data = dateArrayD15;
	}
	if(this.id == 'month') {
		myChart.data.datasets[0].data = dateArrayMon;
	}
	if(this.id == "month3") {
		myChart.data.datasets[0].data = dateArray3Mon;
		// myChart.options.scales.x.time.unit = "month"
	}
	myChart.update()
}


if (window.matchMedia("(max-width: 700px)").matches) {
	myChart.options.scales.x.ticks.maxTicksLimit = ""
	myChart.update()
}
window.addEventListener("load", mediaQuery);
window.addEventListener("resize", mediaQuery);
function mediaQuery(){
	if(document.body.clientWidth <= 700) {
		myChart.options.scales.x.ticks.maxTicksLimit = ""
		myChart.update()
	}
	if(document.body.clientWidth <= 500) {
		myChart.options.scales.x.ticks.maxTicksLimit = 8;
		Chart.defaults.font.size = 10;
		myChart.update()
	}
		if(document.body.clientWidth <= 370) {
		myChart.options.scales.x.ticks.maxTicksLimit = 6;
		Chart.defaults.font.size = 10;
		myChart.update()
	}
} 
/*																	Изменение данных графика																*/

/*																	Создание графика																*/

/*																	калькулятор стоимости																*/

let gfAmountPurchaseInput = document.getElementById('gf-amount_purchase');
let gfRatePurchase = document.getElementById('gf-rate_purchase');
let gfPricePurchaseInput = document.getElementById('gf-price_purchase');
let purchaseGfInputs = document.querySelectorAll(".stock-exchange__purchase .stock-exchange__form_input");
let gfAmountSellInput = document.getElementById('gf-amount_sell');
let gfRateSell = document.getElementById('gf-rate_sell');
let gfPriceSellInput = document.getElementById('gf-price_sell');
let sellGfInputs = document.querySelectorAll(".stock-exchange__sell .stock-exchange__form_input");
let rangeInp = document.querySelectorAll(".stock-exchange__form-range-inp");
let amountInps = document.querySelectorAll(".stock-exchange__amount-inp")
purchaseGfInputs.forEach(input => {
	input.addEventListener('input', calcPricePurchase);
})

sellGfInputs.forEach(input => {
	input.addEventListener('input', calcPriceSell);
})
rangeInp.forEach(input => {
	input.addEventListener('input', rangeInpFunc);
})
function rangeInpFunc() {
	amountInps.forEach(input => {
		if(this.dataset.range == input.dataset.range) {
			input.value = this.value;
			calcPriceSell();
			calcPricePurchase();
		}
	})
	
}

let gfAmountPurchaseValue = gfAmountPurchaseInput.value;
let gfRatePurchaseValue = gfRatePurchase.value;
function calcPricePurchase(e) {
	gfAmountPurchaseValue = gfAmountPurchaseInput.value;
	gfPricePurchaseInput.value = gfAmountPurchaseValue * gfRatePurchaseValue;
}

let gfAmountSellValue = gfAmountSellInput.value;
let gfRateSellValue = gfRateSell.value;
function calcPriceSell() {
	gfAmountSellValue = gfAmountSellInput.value;
	gfPriceSellInput.value = gfAmountSellValue * gfRateSellValue;
}
calcPriceSell()
calcPricePurchase()
/*																	калькулятор стоимости																*/