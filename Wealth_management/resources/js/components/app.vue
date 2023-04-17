<template>
  <router-view :ro="d" :Productoptions="Productoptions" :Currencyoptions1="Currencyoptions" :Regionoptions="Regionoptions" :Countryoptions="Countryoptions" />
</template>
<script>
export default {
  data() {
    return {
      Productoptions: [],
      Currencyoptions: [],
      Riskoptions: [],
      Regionoptions: [],
      Countryoptions:[  ],
      d:"dfdf"
    };
  },
  methods: {
    gotoeditblog() {
        axios.post("/api/getall").then((res) => {
            if(res.status==200){
                this.Productoptions = res.data.data['project_types'];
                this.Currencyoptions = res.data.data['currency'];
                this.Countryoptions = res.data.data['country'];
                this.Regionoptions = res.data.data['regions'];
            }

          });
     },
  },
  mounted() {
    this.gotoeditblog()
  },
};
</script>
