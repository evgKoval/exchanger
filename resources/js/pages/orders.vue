<template>
  <div>
    <div class="title mb-4 text-center">
      History of your orders
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Transaction</th>
                  <th scope="col">Created at</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">10865</th>
                  <td>
                    From
                    <img src="https://corp.qiwi.com/dam/jcr:fbce4856-723e-44a2-a54f-e7b164785f01/qiwi_sign_rgb.png" alt="QIWI" width="15" height="15">
                    QIWI
                    1000 RUB
                    to
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/Bitcoin.svg/1024px-Bitcoin.svg.png" alt="QIWI" width="15" height="15">
                    Bitcoin
                    0.005 BTC
                  </td>
                  <td>15 Nov. 2019 at 14:35</td>
                  <td>
                    <button type="button" class="btn btn-warning btn-sm">In process</button>
                  </td>
                </tr>
                <tr>
                  <th scope="row">10865</th>
                  <td>
                    From
                    <img src="https://corp.qiwi.com/dam/jcr:fbce4856-723e-44a2-a54f-e7b164785f01/qiwi_sign_rgb.png" alt="QIWI" width="15" height="15">
                    QIWI
                    1000 RUB
                    to
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/Bitcoin.svg/1024px-Bitcoin.svg.png" alt="QIWI" width="15" height="15">
                    Bitcoin
                    0.005 BTC
                  </td>
                  <td>06 Nov. 2019 at 14:35</td>
                  <td>
                    <button type="button" class="btn btn-success btn-sm">Completed</button>
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
  middleware: 'auth',

  layout: 'default',

  data: () => ({
    
  })
}
</script>

<style scoped>
.title {
  font-size: 60px;
}
</style>
