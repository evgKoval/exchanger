<template>
  <div>
    <div>
      <div class="title mb-4 text-center">
        Currencies rates
      </div>
      <div class="row">
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
                  <tr v-for="(currency, index) in currencies">
                    <th scope="row">{{ index }}</th>
                    <td>
                      <img :src="currency.logo" :alt="currency.name" width="30" height="30">
                      <span class="currency-name">{{ currency.name }}</span>
                      <span class="small">{{ currency.currency }}</span>
                    </td>
                    <td>{{ currency.rate.amount }} UAH</td>
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

  computed: {
    ...mapGetters({
        currencies: 'currencies/currenciesAll'
    })
  },

  created() {
    this.$store.dispatch('currencies/fetchCurrenciesAll');
  }
}
</script>

<style scoped>
.title {
  font-size: 60px;
}

.currency-name {
  font-size: 21px;
  margin-left: 1rem;
}
</style>
