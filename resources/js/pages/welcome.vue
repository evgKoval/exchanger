<template>
  <div>
    <div>
      <div class="title mb-4 text-center">
        Exchange your money
      </div>
      <div v-if="loading" class="text-center">
        <div class="spinner-border" role="status">
          <span class="sr-only"></span>
        </div>
      </div>
      <div v-else class="row">
        <div class="col-4">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="card-title mb-3">1. Give</h2>
              <div class="input-group input-group-lg mb-3">
                <input type="number" v-model.number="give" class="form-control">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <img :src="chosenGive.logo" width="30" height="30">
                  </span>
                </div>
              </div>
              <div class="currency mb-3">
                <h5>Currency of recoil</h5>
                <button type="button" 
                        class="btn" 
                        @click="filterGive = 'All'"
                        :class="filterGive == 'All' ? 'btn-dark' : 'btn-outline-dark'">All</button>
                <button type="button" 
                        class="btn"
                        @click="filterGive = 'UAH'"
                        :class="filterGive == 'UAH' ? 'btn-dark' : 'btn-outline-dark'">UAH</button>
                <button type="button" 
                        class="btn"
                        @click="filterGive = 'RUB'"
                        :class="filterGive == 'RUB' ? 'btn-dark' : 'btn-outline-dark'">RUB</button>
                <button type="button" 
                        class="btn"
                        @click="filterGive = 'USD'"
                        :class="filterGive == 'USD' ? 'btn-dark' : 'btn-outline-dark'">USD</button>
                <button type="button" 
                        class="btn"
                        @click="filterGive = 'Coin'"
                        :class="filterGive == 'Coin' ? 'btn-dark' : 'btn-outline-dark'">Coin</button>
              </div>
              <div class="currency-system">
                <h5>System</h5>
                <ul class="pt-1">
                  <li v-for="currency in currenciesFromGive">
                      <button type="button" 
                              class="btn mb-1" 
                              @click="chosenGive = currency"
                              :class="chosenGive.id == currency.id ? 'btn-primary' : 'btn-light'">
                        <div class="row">
                          <div class="col-2">
                            <img :src="currency.logo" :alt="currency.name" class="img-fluid">
                          </div>
                          <div class="col-10">
                            {{ currency.name }}
                          </div>
                        </div>
                      </button>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="card-title mb-3">2. Take</h2>
              <div class="input-group input-group-lg">
                <input type="text" class="form-control" readonly :value="toTake">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <img :src="chosenTake.logo" width="30" height="30">
                  </span>
                </div>
              </div>
              <span v-show="toTake > chosenTake.reserves" class="text-danger mt-2">You reached our reserves limit</span>
              <div class="currency mt-3 mb-3">
                <h5>Receipt currency</h5>
                <button type="button" 
                        class="btn"
                        @click="filterTake = 'All'"
                        :class="filterTake == 'All' ? 'btn-dark' : 'btn-outline-dark'">All</button>
                <button type="button" 
                        class="btn"
                        @click="filterTake = 'UAH'"
                        :class="filterTake == 'UAH' ? 'btn-dark' : 'btn-outline-dark'">UAH</button>
                <button type="button" 
                        class="btn"
                        @click="filterTake = 'RUB'"
                        :class="filterTake == 'RUB' ? 'btn-dark' : 'btn-outline-dark'">RUB</button>
                <button type="button" 
                        class="btn"
                        @click="filterTake = 'USD'"
                        :class="filterTake == 'USD' ? 'btn-dark' : 'btn-outline-dark'">USD</button>
                <button type="button" 
                        class="btn"
                        @click="filterTake = 'Coin'"
                        :class="filterTake == 'Coin' ? 'btn-dark' : 'btn-outline-dark'">Coin</button>
              </div>
              <div class="currency-system">
                <div class="row">
                  <div class="col-7">
                    <h5>System</h5>
                  </div>
                  <div class="col-5 text-right">
                    <span class="small">Currency reserves</span>
                  </div>
                </div>
                <ul class="pt-1">
                  <li v-for="currency in currenciesToTake">
                      <button type="button" 
                              class="btn mb-1"
                              @click="chosenTake = currency"
                              :class="chosenTake.id == currency.id ? 'btn-primary' : 'btn-light'">
                        <div class="row">
                          <div class="col-2">
                            <img :src="currency.logo" :alt="currency.name" class="img-fluid">
                          </div>
                          <div class="col-5">
                            {{ currency.name }}
                          </div>
                          <div class="col-5 text-right">
                            {{ currency.reserves }}
                            <span class="small">{{ currency.currency }}</span>
                          </div>
                        </div>
                      </button>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="card-title mb-3">3. Confirm</h2>
              <div class="rate">
                <div class="mb-3">
                  {{ exchangeRate }}
                </div>
                <div class="row mb-2">
                  <div class="col-2">
                    <img :src="chosenGive.logo" width="30" height="30">
                  </div>
                  <div class="col-5">
                    {{ chosenGive.name }}
                  </div>
                  <div class="col-5 text-right">
                    {{ give }}
                    <span class="small">{{ chosenGive.currency }}</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-2">
                    <img :src="chosenTake.logo" width="30" height="30">
                  </div>
                  <div class="col-5">
                    {{ chosenTake.name }}
                  </div>
                  <div class="col-5 text-right">
                    {{ toTake }}
                    <span class="small">{{ chosenTake.currency }}</span>
                  </div>
                </div>
              </div>
              <hr>
              <form @submit="createCharge" action="/api/v1/charge-create" method="post">
                <div class="form-group">
                  <label for="input-email">Email address</label>
                  <input type="email" v-model="form.email" class="form-control" id="input-email" placeholder="Enter your email">
                  <span v-show="errors.email" class="text-danger">This field must be filled</span>
                </div>
                <div class="form-group">
                  <label for="wallet-from">{{ chosenGive.name }} wallet</label>
                  <div class="input-group">
                    <input type="text" v-model="form.walletFrom" class="form-control" id="wallet-from">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <img :src="chosenGive.logo" width="20" height="20">
                      </span>
                    </div>
                  </div>
                  <span v-show="errors.walletFrom" class="text-danger">This field must be filled</span>
                </div>
                <div class="form-group">
                  <label for="wallet-to">{{ chosenTake.name }} wallet</label>
                  <div class="input-group">
                    <input type="text" v-model="form.walletTo" class="form-control" id="wallet-to">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <img :src="chosenTake.logo" width="20" height="20">
                      </span>
                    </div>
                  </div>
                  <span v-show="errors.walletTo" class="text-danger">This field must be filled</span>
                </div>
                <div class="form-group form-check">
                  <input type="checkbox" v-model="form.confirm" class="form-check-input" id="confirmPolitics">
                  <label  class="form-check-label" for="confirmPolitics">Confirm <a href="#">politics</a></label>
                  <br>
                  <span v-show="errors.confirm" class="text-danger">You must confirm politics</span>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Exchange now</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import axios from 'axios'

export default {
  layout: 'default',

  data: () => ({
    loading: true,
    give: 1000,
    chosenGive: {
      created_at: '2019-11-15 14:55:25',
      currency: 'RUB',
      id: 1,
      logo: 'https://corp.qiwi.com/dam/jcr:fbce4856-723e-44a2-a54f-e7b164785f01/qiwi_sign_rgb.png',
      name: 'QIWI',
      reserves: 395402.48,
      updated_at: '2019-11-15 14:55:25'
    },
    chosenTake: {
      created_at: '2019-11-15 14:56:35',
      currency: 'BTC',
      id: 2,
      logo: 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/Bitcoin.svg/1024px-Bitcoin.svg.png',
      name: 'Bitcoin',
      reserves: 35.36,
      updated_at: '2019-11-15 14:56:35'
    },
    filterGive: 'All',
    filterTake: 'All',
    rates: {},
    form: {
      email: '',
      walletFrom: '',
      walletTo: '',
      confirm: false
    },
    errors: {
      email: false,
      walletFrom: false,
      walletTo: false,
      confirm: false
    }
  }),

  computed: {
    ...mapGetters({
        authenticated: 'auth/check',
        currencies: 'currencies/currencies'
    }),
    currenciesToTake() {
      const index = this.currencies.findIndex((currency) => {
        return currency.id === this.chosenGive.id
      })

      let copy = [...this.currencies];
      copy.splice(index, 1);

      if(this.filterTake === 'All') {
        return copy
      } else if(this.filterTake === 'Coin') {
        return copy.filter(elem => elem.currency !== 'UAH' && elem.currency !== 'USD' && elem.currency !== 'RUB');
      } else {
        return copy.filter(elem => elem.currency === this.filterTake);
      }
    },
    currenciesFromGive() {
      if(this.filterGive === 'All') {
        return this.currencies
      } else if(this.filterGive === 'Coin') {
        return this.currencies.filter(elem => elem.currency !== 'UAH' && elem.currency !== 'USD' && elem.currency !== 'RUB');
      } else {
        return this.currencies.filter(elem => elem.currency === this.filterGive);
      }
    },
    toTake() {
      return this.give * this.rates[this.chosenGive.currency][this.chosenTake.currency]
    },
    exchangeRate() {
      const give = this.rates[this.chosenTake.currency][this.chosenGive.currency];
      const take = this.rates[this.chosenGive.currency][this.chosenTake.currency];

      if(give > take) {
        return `Exchange rate: ${Math.round(give)}${this.chosenGive.currency} = ${Math.round(give * take)}${this.chosenTake.currency}`
      } else {
        return `Exchange rate: ${Math.round(take)}${this.chosenTake.currency} = ${Math.round(give * take)}${this.chosenGive.currency}`
      }
    }
  },

  methods: {
    createCharge(e) {
      e.preventDefault();

      if(this.form.email == '') {
        this.errors.email = true;
      } else {
        this.errors.email = false;
      }

      if(this.form.walletFrom == '') {
        this.errors.walletFrom = true;
      } else {
        this.errors.walletFrom = false;
      }

      if(this.form.walletTo == '') {
        this.errors.walletTo = true;
      } else {
        this.errors.walletTo = false;
      }

      if(this.form.confirm === false) {
        this.errors.confirm = true;
      } else {
        this.errors.confirm = false;
      }

      if(Object.values(this.errors).some(a => a == false) && !(this.toTake > this.chosenTake.reserves)) {
        axios.post('/api/v1/charge-create', {
          email: this.form.email,
          walletFrom: this.chosenGive.id,
          walletTo: this.chosenTake.id,
          give: this.give,
          take: this.give * this.rates[this.chosenGive.currency][this.chosenTake.currency]
        }).then((res) => {
          console.log(res);
        });
      }
    }
  },

  async created() {
    await this.$store.dispatch('currencies/fetchCurrencies');

    await axios.get('https://api.coinbase.com/v2/exchange-rates?currency=USD')
      .then((response) => {
        this.rates[response.data.data.currency] = response.data.data.rates
      })

    await axios.get('https://api.coinbase.com/v2/exchange-rates?currency=RUB')
      .then((response) => {
        this.rates[response.data.data.currency] = response.data.data.rates
      })

    await axios.get('https://api.coinbase.com/v2/exchange-rates?currency=BTC')
      .then((response) => {
        this.rates[response.data.data.currency] = response.data.data.rates
      })

    await axios.get('https://api.coinbase.com/v2/exchange-rates?currency=UAH')
      .then((response) => {
        this.rates[response.data.data.currency] = response.data.data.rates
      })

    await axios.get('https://api.coinbase.com/v2/exchange-rates?currency=ETH')
      .then((response) => {
        this.rates[response.data.data.currency] = response.data.data.rates
      })

    await axios.get('https://api.coinbase.com/v2/exchange-rates?currency=BCH')
      .then((response) => {
        this.rates[response.data.data.currency] = response.data.data.rates
      })

    await axios.get('https://api.coinbase.com/v2/exchange-rates?currency=LTC')
      .then((response) => {
        this.rates[response.data.data.currency] = response.data.data.rates
        this.loading = false;
      })
  }
}
</script>

<style scoped>
.title {
  font-size: 60px;
}

ul {
  padding: 0;
  list-style: none;
}

.currency-system .btn {
  text-align: left;
  width: 100%;
}
</style>
