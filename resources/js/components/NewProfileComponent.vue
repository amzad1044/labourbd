<template>
<div>
<section class="content"> 
  <div class="row">
    <div class="col-md-12">

          <div class="modal-content">

            <form >
            <div class="modal-body">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3  class="box-title">Create new user</h3>
                </div>

                <div class="box-body">
                  <div class="form-group">
                    <label >Name</label>
                    <input v-model="form.name" type="text" name="name"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                  </div>

                   <div class="form-group">
                    <label >Email</label>
                    <input v-model="form.email" type="email" name="email"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                    <has-error :form="form" field="email"></has-error>
                  </div>

                  <div class="form-group">
                    <label >Phone</label>
                    <input v-model="form.phone" type="text" name="phone"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                    <has-error :form="form" field="phone"></has-error>
                  </div>

                   <div class="form-group">
                    <label >User Type</label>
                    <select class="form-control" :class="{ 'is-invalid': form.errors.has('type') }" v-model="form.type">
                      <option >User</option>
                      <option >Admin</option>
                      <option >Editable</option>
                    </select>
                  </div>


                   <div class="form-group">
                    <label >Password</label>
                    <input  type="text" name="price"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
                    <has-error :form="form" field="price"></has-error>
                  </div>

                    <div class="form-group">
                      <label >Photo</label>
                      <div class="col-sm-12" >
                          <input  id="photo" type="file" :class="{ 'is-invalid': form.errors.has('photo') }" name="photo" class="form-input"><br>
                          <img   alt="Image" style="height: 70px;width: 70px"/>
                          <has-error :form="form" field="photo"></has-error>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-danger">Save</button>
            </div>
          </form>
          </div>

</div>
</div>
</section>

  </div>
</template>
<script>
    export default {
      data(){
          return{
            form: new Form({
            _id:'',
              name: '',
              phone:'',
              areaId:'',
              typeId:'',
              price:'',
              photo:''
            })
          }
        },
        methods:{

        },
       created() {
        }
    }
</script>