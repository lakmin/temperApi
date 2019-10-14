<template>
  <div id="app">
    <img src="{ image }">
    <highcharts :options="chartOptions"></highcharts>
  </div>
</template>

<script>

import {Chart} from 'highcharts-vue'
import axios from 'axios';

import image from '@/assets/logo.png'

export default {
  name: 'app',
  components: {
    highcharts: Chart,
  },
  data() {
		return {
      chartOptions: {},
      action: 'http://localhost:1000/',
    }
  },
  mounted() {

    axios.get(this.action).then((response) => {

      
      this.chartOptions = response.data; // Set chartOptions
      console.log(this.chartOptions);
    });      
  } 
}
</script>

<style>
body {
  background: lightblue;
}
#app {
  background: #ffff;
  padding:25px 30px;
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  width: 70%;
  margin-left: auto;
  margin-right: auto;
  margin-top: 60px;
}
</style>
