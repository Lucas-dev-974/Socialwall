import ApexCharts from "apexcharts";

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



export default{
    components: {
      ApexCharts
    },

    data(){
        return {
            dialog: false,
            viewsNumber: 0,

            // Chart settings
            type: "column2d",
            renderAt: "chart-container",
            width:  "100%",
            height: '100%',
            dataFormat: "json",
            dataSource,
        }
    },

    mounted(){
      let _this = this
      document.addEventListener('DOMContentLoaded', () => {
        _this.render()
      })

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