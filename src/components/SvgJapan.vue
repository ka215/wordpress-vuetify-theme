<template>
  <v-container>
    <v-row class="text-center">
      <v-col cols="12">
        <div id="my-map"></div>
      </v-col>

      <v-col class="mb-4">
        <h2 class="display-1 font-weight-bold mb-3">
          Choose the area which you want to see.
        </h2>

        <p class="subheading font-weight-regular">
          For help and collaboration with other Vuetify developers,
          <br>please join our online
          <a
            href="https://community.vuetifyjs.com"
            target="_blank"
          >Discord Community</a>
        </p>
      </v-col>

      <v-col
        class="mb-5"
        cols="12"
      >
        <v-row justify="center">
        </v-row>
      </v-col>

      <v-col
        class="mb-5"
        cols="12"
      >
        <h2 class="headline font-weight-bold mb-3"></h2>

        <v-row justify="center">
        </v-row>
      </v-col>

      <v-col
        class="mb-5"
        cols="12"
      >
        <h2 class="headline font-weight-bold mb-3"></h2>

        <v-row justify="center">
        </v-row>
      </v-col>
    </v-row>
    <template>
      <div class="text-center">
        <v-dialog
          v-model="dialog"
          width="500"
        >
          <v-card>
            <v-card-title class="headline grey lighten-2">
              {{ region }}
            </v-card-title>
            <v-card-text>
              {{ prefecture }}
              が選択されました。
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="primary"
                text
                @click="dialog = false"
              >
                閉じる
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </div>
    </template>
  </v-container>
</template>

<script>
export default {
  name: 'SvgJapan',

  data: () => ({
    dialog: false,
    region: '',
    prefecture: '',
    mapRegions: null,
  }),

  mounted: function() {
    let mapObj = window.svgJapan({
      element: '#my-map',
      type: 'deform',
      regionality: true,
      height: '480px',
    })
    this.mapRegions = mapObj.regions
    document.addEventListener('svgmap.click', (e) => {
      this.region = this.mapRegions.find(({ id }) => id == parseInt(e.target.dataset.region)).name
      this.prefecture = e.target.dataset.name
      this.dialog = true
    }, false)
  },
}
</script>
