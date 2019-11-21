<template>
  <div>
    <div>
      <div class="title mb-4 text-center">
        Currencies rates
      </div>
      <div v-if="loading" class="text-center">
        <div class="spinner-border" role="status">
          <span class="sr-only"></span>
        </div>
      </div>
      <div v-else class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(currency, index, key) in currencies"> 
                    <th scope="row">{{ index + 1 }}</th>
                    <td>
                      <span>{{ currency.data.base }}</span>
                    </td>
                    <td>{{ currency.data.amount }} {{ currency.data.currency }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  layout: 'default',

  data: () => ({
    loading: true
  }),

  computed: {
    ...mapGetters({
        currencies: 'currencies/currenciesAll'
    })
  },

  created() {
    this.$store.dispatch('currencies/fetchCurrenciesAll')
      .then(() => {
        this.loading = false;
      });
  }
}
</script>

<style scoped>
.title {
  font-size: 60px;
}
</style>
