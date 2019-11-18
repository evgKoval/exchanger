import axios from 'axios'
import Cookies from 'js-cookie'
import * as types from '../mutation-types'

// state
export const state = {
  currencies: null,
  currenciesAll: null
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
  }
}

// actions
export const actions = {
  async fetchCurrencies ({ commit }) {
    try {
      const { data } = await axios.get('/api/v1/currencies')

      commit(types.FETCH_CURRENCIES, { currencies: data })
    } catch (e) {
      
    }
  },
  async fetchCurrenciesAll ({ commit }) {
    try {
      const { data } = await axios.get('/api/v1/currencies-all')

      console.log(data);

      commit(types.FETCH_CURRENCIES_ALL, { currenciesAll: data })
    } catch (e) {
      
    }
  }
}
