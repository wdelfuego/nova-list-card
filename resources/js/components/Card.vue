<template>
  
  <Card class="flex flex-col items-center justify-center">

    <div class="wd-nova-list-card">
      <h1 class="text-90 font-normal text-xl md:text-2xl text-center">
        <span v-if="title">{{ title }}</span>
        <span v-else>&nbsp;</span>
      </h1>
      <h3 class="text-50 font-normal text-center">
        
      </h3>
      
      <div class="table-wrapper bg-gray-100 dark:bg-gray-900">
        <table v-if="!loading" class="noselect">
          <template v-for="item in items">
            <tr class="border-b border-gray-500 dark:border-gray-700">
              <td>
                <p>
                  <span v-if="item.badge" class="badge">{{ item.badge }}</span>
                  <span v-html="item.message"></span>
                </p>
              </td>
              <td style="text-align:right">
                <LoadingButton
                  v-if="item.buttonUri && item.buttonLabel"
                  @click="visit(item.buttonUri)"
                  :processing="ui_blocked"
                  :disabled="ui_blocked"
                  component="DefaultButton"
                >
                  {{ item.buttonLabel }}
                </LoadingButton>
              </td>
            </tr>
          </template>
        </table>
        <div v-else="loading" class="loading px-3 py-5">
          <Loader class="text-gray-300" width="30" />
          <!-- <h1 class="text-center text-3xl text-gray-500 font-light my-5">Loading...</h1> -->
        </div>
      </div>
    </div>
  </Card>
</template>

<script>
export default {
  props: [
    'card',
    // The following props are only available on resource detail cards...
    // 'resource',
    // 'resourceId',
    // 'resourceName',
  ],

  mounted() {
    this.reload();
  },
  
  
  methods: {
    reload() {
      this.loading = true;
      Nova.request().get('/nova-vendor/nova-list-card/data/' + this.card.dataSourceKey)
        .then(response => { 
          this.reloadFromResponse(response);
          this.loading = false;
        });
    },
    
    reloadFromResponse(response)
    {
        this.items = response.data.items;
        this.title = response.data.title;
    },
    
    visit(uri) {
      Nova.visit(uri)
    }
    
  },
  
  data () {
      return {
          loading: false,
          title: '',
          items: [],
          messages: {
          }
      }
  }
  
}
</script>
