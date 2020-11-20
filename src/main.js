import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import svgJapan from 'svg-japan/dist/svg-japan.min.js'

Vue.config.productionTip = false

new Vue({
  vuetify,
  svgJapan,
  render: h => h(App)
}).$mount('#app')
