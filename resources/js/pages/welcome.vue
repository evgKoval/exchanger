<template>
  <div>
    <div>
      <div class="title mb-4 text-center">
        Exchange your money
      </div>
      <div class="row">
        <div class="col-4">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="card-title mb-3">1. Give</h2>
              <div class="input-group input-group-lg mb-3">
                <input type="number" v-model.number="give" class="form-control">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <img src="https://corp.qiwi.com/dam/jcr:fbce4856-723e-44a2-a54f-e7b164785f01/qiwi_sign_rgb.png" width="30" height="30">
                  </span>
                </div>
              </div>
              <div class="currency mb-3">
                <h5>Currency of recoil</h5>
                <button type="button" class="btn btn-outline-dark">All</button>
                <button type="button" class="btn btn-outline-dark">UAH</button>
                <button type="button" class="btn btn-outline-dark">USD</button>
                <button type="button" class="btn btn-outline-dark">Coin</button>
              </div>
              <div class="currency">
                <h5>System</h5>
                <ul class="pt-1">
                  <li v-for="currency in currencies">
                      <button type="button" class="btn btn-light mb-1">
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
              <div class="input-group input-group-lg mb-3">
                <input type="text" class="form-control" readonly>
                <div class="input-group-append">
                  <span class="input-group-text">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/Bitcoin.svg/1024px-Bitcoin.svg.png" width="30" height="30">
                  </span>
                </div>
              </div>
              <div class="currency mb-3">
                <h5>Receipt currency</h5>
                <button type="button" class="btn btn-outline-dark">All</button>
                <button type="button" class="btn btn-outline-dark">UAH</button>
                <button type="button" class="btn btn-outline-dark">USD</button>
                <button type="button" class="btn btn-outline-dark">Coin</button>
              </div>
              <div class="currency">
                <div class="row">
                  <div class="col-7">
                    <h5>System</h5>
                  </div>
                  <div class="col-5 text-right">
                    <span class="small">Currency reserves</span>
                  </div>
                </div>
                <ul class="pt-1">
                  <li v-for="currency in currencies">
                      <button type="button" class="btn btn-light mb-1">
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
                <div class="mb-3">Exchange rate: 593642.06RUB = 1BTC</div>
                <div class="row mb-2">
                  <div class="col-2">
                    <img src="https://corp.qiwi.com/dam/jcr:fbce4856-723e-44a2-a54f-e7b164785f01/qiwi_sign_rgb.png" width="30" height="30">
                  </div>
                  <div class="col-5">
                    QIWI
                  </div>
                  <div class="col-5 text-right">
                    {{ give }}
                    <span class="small">RUB</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/Bitcoin.svg/1024px-Bitcoin.svg.png" width="30" height="30">
                  </div>
                  <div class="col-5">
                    Bitcion
                  </div>
                  <div class="col-5 text-right">
                    0.06667408
                    <span class="small">BTC</span>
                  </div>
                </div>
              </div>
              <hr>
              <form @submit="createCharge" action="/api/v1/charge-create" method="post">
                <div class="form-group">
                  <label for="input-email">Email address</label>
                  <input type="email" class="form-control" id="input-email" placeholder="Enter your email">
                </div>
                <div class="form-group">
                  <label for="wallet-from">QIWI wallet</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="wallet-from">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <img src="https://corp.qiwi.com/dam/jcr:fbce4856-723e-44a2-a54f-e7b164785f01/qiwi_sign_rgb.png" width="20" height="20">
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="wallet-to">Bitcoin wallet</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="wallet-to">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/Bitcoin.svg/1024px-Bitcoin.svg.png" width="20" height="20">
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="confirmPolitics">
                  <label class="form-check-label" for="confirmPolitics">Confirm <a href="#">politics</a></label>
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
    give: 1000
  }),

  computed: {
    ...mapGetters({
        authenticated: 'auth/check',
        currencies: 'currencies/currencies'
    })
  },

  methods: {
    createCharge(e) {
      e.preventDefault();

      axios.post('/api/v1/charge-create').then((res) => {
        console.log(res);
      });
    }
  },

  created() {
    this.$store.dispatch('currencies/fetchCurrencies');
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

.currency .btn {
  text-align: left;
}
</style>
