<template> 
  <div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Worker Types</span>
              <span class="info-box-number">{{typecountview}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa  fa-location-arrow"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Area</span>
              <span class="info-box-number">{{areaCountView}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Labour</span>
              <span class="info-box-number">{{LabCountView}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total User</span>
              <span class="info-box-number" >{{this.users}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

</template>
      

<script>
    export default {
        data(){
          return{
            types:[],
            areas:[],
            labs:[],
            users:''
          }
        },
        methods:{
          typeCount(){
            return axios.get("api/typesinlab").then(({data}) => (this.types = data));
          },
          areaCount(){
            return axios.get("api/areasinlab").then(({data}) => (this.areas = data));
          },
          LabourCount(){
            return axios.get("api/countLab").then(({data}) => (this.labs = data));
          },
          userCount(){
             return axios.get("api/users").then(({data}) => (this.users = data));


          },
        },
        computed: {
          typecountview() {
            return Object.keys(this.types).length;
          },
          areaCountView() {
            return Object.keys(this.areas).length;
          },
          LabCountView() {
            return Object.keys(this.labs).length;
          },


        },
        mounted() {
          this.userCount();
          this.typeCount();
          this.areaCount();
          this.LabourCount();

        },

    }
</script>
 