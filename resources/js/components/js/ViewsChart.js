
const chartData = [
  {
    label: "Lundi",
    value: "90"
  },
  {
    label: "Mardi",
    value: "260"
  },
  {
    label: "Mercredi",
    value: "180"
  },
  {
    label: "Jeudi",
    value: "140"
  },
  {
    label: "Vendredi",
    value: "115"
  },
  {
    label: "Samedi",
    value: "100"
  },
  {
    label: "Dimanche",
    value: "30"
  },
];

const dataSource = {
  chart: {
    caption: "Vues par Jour",
    subcaption: "",
    xaxisname: "Date",
    yaxisname: "Vues",
    numbersuffix: "",
    theme: "fusion"
  },
  data: chartData
  };


export default {

  data(){
    return {
      type: "column2d",
      renderAt: "chart-container",
      width:  "800",
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
        type:   this.type,
        width:  this.width,
        height: this.height
      });

      fusionChart.setJSONData(this.dataSource);
      fusionChart.render(this.$root.$el.querySelector("#chart-container"));
    }
  }
}
