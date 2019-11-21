import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  loading: true
}

// getters
export const getters = {
  loading: state => state.loading,
}

// mutations
export const mutations = {
  [types.LOADING_TOGGLE] (state, bool) {
    state.loading = bool
  }
}

// actions
export const actions = {
  loadingToggle ({ commit }, bool) {
    commit(types.LOADING_TOGGLE, bool)
  }
}
