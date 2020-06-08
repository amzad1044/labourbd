<template>
<div>
    <header class="main-header">
    <a href="" class="logo">
      
      <span class="logo-mini"><b>D</b></span>
      
       <router-link to="/main">
        <span class="logo-lg" style="color: white;"><b>Dashboard</b></span>
      </router-link>
    </a>

    
    <nav class="navbar navbar-static-top">
      
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{{this.requests}}</span>
            </a>
            <ul class="dropdown-menu">
              
              <li class="header">
                <router-link to="/onworking">
                <a href="#">You have {{this.requests}} new request</a>
                </router-link>
              </li>
              
            </ul>
          </li>
          

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img :src="getProfilePhoto()" class="user-image">
              <span class="hidden-xs">{{this.form.name}}</span>
            </a>
            <ul class="dropdown-menu">

              <li class="user-header">
                <img :src="getProfilePhoto()" class="img-circle" alt="User Image">

                <p>
                 {{this.form.name}} - Web Developer

                </p>
              </li>
              <router-link :to="`/profile`">
              <li class="user-footer">
                <div class="pull-left" style="padding: 5px">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
              </li>
              </router-link>
            </ul>
          </li>
        </ul>
      </div>

    </nav>
  </header>
</div>
</template>
<script>
    export default 
    {
      data(){
          return{
            requests:'',
            form: new Form({
              _id:'',
              name: '',
              email: '',
              phone:'',
              photo:''
            })
          }
        },
        methods:{
            getProfilePhoto(){
                let photo =(this.form.photo.length > 200) ? this.form.photo : "img_upload/users/"+ this.form.photo;
                if(this.form.photo){
                  return photo;
                }
                else{
                  return "img_upload/no_image.png";
                }
            },
            RequestCount(){
             return axios.get("api/notifyRequest").then(({data}) => (this.requests = data));
          },
        },

        created() {
          this.RequestCount();
          
          axios.get("api/viewProfile")
          .then(({ data }) => (this.form.fill(data)));
          

        }
    }
</script>