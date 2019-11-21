import axios from 'axios'
import Cookies from 'js-cookie'
import * as types from '../mutation-types'

// state
export const state = {
  currencies: [],
  currenciesAll: []
}

// getters
export const getters = {
  currencies: state => state.currencies,
  currenciesAll: state => state.currenciesAll
}

// mutations
export const mutations = {
  [types.FETCH_CURRENCIES] (state, { currencies }) {
    state.currencies = currencies
  },
  [types.FETCH_CURRENCIES_ALL] (state, { currenciesAll }) {
    state.currenciesAll = currenciesAll
  },
  [types.SYSTEM_DELETE] (state, { id }) {
    const index = state.currencies.findIndex(currency => currency.id === id);
    state.currencies.splice(index, 1);
  }
}

// actions
export const actions = {
  async fetchCurrencies ({ commit }) {
    try {
      const { data } = await axios.get('/api/v1/currencies')

      commit(types.FETCH_CURRENCIES, { currencies: data })
    } catch (e) {
      console.warn(e);
    }
  },
  async fetchCurrenciesAll ({ commit }) {
    try {
      const { data } = await axios.get('/api/v1/currencies-all')

      commit(types.FETCH_CURRENCIES_ALL, { currenciesAll: data })
    } catch (e) {
      console.warn(e);
    }
  },
  async createSystem ({ commit }, form) {
    try {
      await axios.post('/api/v1/currencies', {
        name: form.name,
        currency: form.currency,
        logo: form.logo,
        reserves: form.reserves
      })
    } catch (e) {
      console.warn(e);
    }
  },
  async editSystem ({ commit }, form) {
    try {
      await axios.put('/api/v1/currencies/' + form.id, {
        name: form.name,
        currency: form.currency,
        logo: form.logo,
        reserves: form.reserves
      });
    } catch (e) {
      console.warn(e);
    }
  },
  async byIdSystem ({ commit }, id) {
    try {
      return axios.get('/api/v1/currencies/' + id)
    } catch (e) {
      console.warn(e);
    }
  },
  async deleteSystem ({ commit }, id) {
    try {
      await axios.delete('/api/v1/currencies/' + id)

      commit(types.SYSTEM_DELETE, { id: id })
    } catch (e) {
      console.warn(e);
    }
  }
}