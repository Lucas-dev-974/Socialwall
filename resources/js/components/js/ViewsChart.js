
const chartData = [
  {
    label: "Venezuela",
    value: "290"
  },
  {
    label: "Saudi",
    value: "260"
  },
  {
    label: "Canada",
    value: "180"
  },
  {
    label: "Iran",
    value: "140"
  },
  {
    label: "Russia",
    value: "115"
  },
  {
    label: "UAE",
    value: "100"
  },
  {
    label: "US",
    value: "30"
  },
  {
    label: "China",
    value: "30"
  }
];

const dataSource = {
  chart: {
    caption: "Vues par Jour",
    subcaption: "",
    xaxisname: "Date",
    yaxisname: "Vue",
    numbersuffix: "V",
    theme: "fusion"
  },
  data: chartData
  };


export default {

  data(){
    return {
      type: "column2d",
      renderAt: "chart-container",
      width: "1000",
      height: "350",
      dataFormat: "json",
      dataSource
    }
  },

  mounted () {
      this.render()
  },

  methods: {
    render() {
      const fusionChart = new FusionCharts({
        type: this.type,
        width: this.width,
        height: this.height
      });

      fusionChart.setJSONData(this.dataSource);
      fusionChart.render(this.$root.$el.querySelector("#chart-container"));
    }
  }
}
