<template> 
     <keep-alive>
      <component :is="currentView"></component>
    </keep-alive>
</template>

<script>
import Chart from './Chart.vue'
export default {
  name: 'app',
  data () {
    return {
      selected: 'chart',
      currentView: 'chart',
    }
  },

  components: {
    chart: Chart,
  },

  methods: {
   }
}
</script>

