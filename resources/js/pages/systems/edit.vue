<template>
  <div>
    <div>
      <div class="title mb-4 text-center">
        Edit the system
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
              <form @submit="edit">
                <div class="form-group">
                  <label for="input-name">Name</label>
                  <input type="text" v-model="form.name" class="form-control" id="input-name" placeholder="Enter system name">
                  <span v-show="errors.name" class="text-danger">This field must be filled</span>
                </div>
                <div class="form-group">
                  <label for="input-currency">Currency</label>
                  <input type="text" v-model="form.currency" class="form-control" id="input-currency" placeholder="Enter system currency">
                  <span v-show="errors.currency" class="text-danger">This field must be filled</span>
                </div>
                <div class="form-group">
                  <label for="input-logo">Logo</label>
                  <input type="text" v-model="form.logo" class="form-control" id="input-logo" placeholder="Enter logo url">
                  <span v-show="errors.logo" class="text-danger">This field must be filled</span>
                </div>
                <div class="form-group">
                  <label for="input-reserves">Reserves</label>
                  <input type="number" step="any" v-model="form.reserves" class="form-control" id="input-reserves" placeholder="Enter currency reserves">
                  <span v-show="errors.reserves" class="text-danger">This field must be filled</span>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Edit</button>
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
  middleware: 'admin',

  layout: 'default',

  data: () => ({
    loading: true,
    form: {
      name: '',
      currency: '',
      logo: '',
      reserves: 0
    },
    errors: {
      name: false,
      currency: false,
      logo: false,
      reserves: false
    }
  }),

  methods: {
    edit(e) {
      e.preventDefault();

      if(this.form.name == '') {
        this.errors.name = true;
      } else {
        this.errors.name = false;
      }

      if(this.form.currency == '') {
        this.errors.currency = true;
      } else {
        this.errors.currency = false;
      }

      if(this.form.logo == '') {
        this.errors.logo = true;
      } else {
        this.errors.logo = false;
      }

      if(this.form.reserves === '') {
        this.errors.reserves = true;
      } else {
        this.errors.reserves = false;
      }

      if(!Object.values(this.errors).some(a => a == true)) {
        this.$store.dispatch('currencies/editSystem', this.form).then(() => {
          this.$router.push({ name: 'systems' })
        });
      }
    }
  },

  created() {
    const id = this.$route.params.id;

    this.$store.dispatch('currencies/byIdSystem', id).then((res) => {
      this.form = {
        name: res.data.name,
        currency: res.data.currency,
        logo: res.data.logo,
        reserves: res.data.reserves,
        id: res.data.id
      }
      this.loading = false
    });
  }
}
</script>

<style scoped>
.title {
  font-size: 60px;
}
</style>
