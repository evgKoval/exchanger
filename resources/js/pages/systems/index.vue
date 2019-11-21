<template>
  <div>
    <div class="title mb-4 text-center">
      Systems
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
            <a href="systems/create" class="btn btn-primary d-block">Add a system</a>
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Reserves</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="currency in currencies" :key="currency.id">
                  <td>
                    <img :src="currency.logo" :alt="currency.name" class="currency-logo" width="30" height="30">
                    {{ currency.name }}
                  </td>
                  <td>
                    {{ currency.reserves }}
                    {{ currency.currency }}
                  </td>
                  <td>
                    <router-link :to="'systems/edit/' + currency.id" class="btn btn-warning">Edit</router-link>
                    <button @click="deleteSystem(currency.id)" class="btn btn-danger">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  middleware: 'admin',

  layout: 'default',

  data: () => ({
    loading: true,
  }),

  computed: {
    ...mapGetters({
        currencies: 'currencies/currencies'
    })
  },

  methods: {
    deleteSystem(id) {
      this.$store.dispatch('currencies/deleteSystem', id)
    }
  },

  created() {
    this.$store.dispatch('currencies/fetchCurrencies')
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
.currency-logo {
  margin-right: .5rem;
}
</style>
