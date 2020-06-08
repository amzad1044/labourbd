<template>

  <div class="container">
     <div class="row">
        <div class="col-md-10">

          <button type="submit" class="btn btn-danger" @click="CreateModal"><span><i class="fa fa-plus"></i></span> New</button>
            <table class="table table-striped text-center">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Type</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(type,index) in types.data" :key="type._id">
                    <td scope="row">{{index+1}}</td>
                    <td>{{type.name}}</td>
                    <td>
                      <img :src="img(type.photo)" style="height: 70px;width: 70px">
                    </td>
                    <td>{{type.created_at}}</td>
                    <td>
                      <a href="#" @click="EditModal(type)">Edit</a>
                      <a href="#" @click="DeleteTypes(type._id)">Delete</a>
                    </td>
                  </tr>
                   <pagination :data="types" @pagination-change-page="getResults"></pagination>
                </tbody>
              </table>
        </div>
     </div>


      <!-- Modal -->
      <div class="modal fade" id="addTypes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Types</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form @submit.prevent="editMode ? updateType() : NewType()">
            <div class="modal-body">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title" v-show="!editMode">CREATE WORKER</h3>
                  <h3 class="box-title" v-show="editMode">UPDATE WORKER</h3>
                </div>
                <div class="box-body">
                  <div class="form-group">
                    <label v-show="!editMode">Types of worker</label>
                    <label v-show="editMode">Edit worker's types</label>
                    <input v-model="form.name" type="text" name="name"
                      placeholder="Enter name here..." 
                      class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name" style="color: red"></has-error>
                  </div>
                </div>

                <div class="form-group" >
                    <label >Photo</label>
                    <div class="col-sm-12" >
                        <input accept=".jpg, .png, .gif" id="photo" @change="changePhoto($event)" type="file" :class="{ 'is-invalid': form.errors.has('photo') }" name="photo" class="form-input">
                        <img v-if="avatar" :src="avatar"  alt="Image" style="height: 70px;width: 70px; padding-top: 5px"/>
                        <has-error :form="form" field="photo" style="color: red"></has-error>
                    </div>

                </div>

              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" v-show="!editMode" class="btn btn-danger" :disabled="form.busy">Save</button>
              <button type="submit" v-show="editMode" class="btn btn-info">Update</button>
            </div>
          </form>
          </div>
        </div>
      </div>



</div>
</template>
      

<script>
    export default {
        data(){
          return{
            editMode: false,
            avatar:null,
            types: {},
            form: new Form({
              _id:'',
              name: ''
            })
          }
        },
        methods:{
          getResults(page = 1) {
            axios.get('api/type?page=' + page)
              .then(response => {
                this.types = response.data;
              });
          },
          img(image){
              return "img_upload/"+image;
          },
          changePhoto(event){
            let file  = event.target.files[0];
            //console.log(file);
            if(file.size>2048576)
            {     
                Swal.fire(
                    'Error',
                    'Your image must be less then 2MB',
                    'error'
                )
                $('#photo').val('');
                this.avatar = null
            }
            else
            {
              let reader = new FileReader();
              reader.onload = event =>{
                  this.avatar = event.target.result;
                  this.form.photo = event.target.result;
              };
              reader.readAsDataURL(file);

            }


          },
          updateType(){
              this.$Progress.start();
              this.form.put('api/type/'+this.form._id)
              .then(() => {
                Fire.$emit('AfterCr');
                $('#addTypes').modal('hide');
                toast.fire({
                  icon: 'success',
                  title: 'Types updated successfully'
                });
                this.$Progress.finish();
              })
              .catch(() => {
                this.$Progress.fail();
              })
          },
          EditModal(type){
              this.editMode = true;
              $('#addTypes').modal('show');
              this.form.fill(type);
          },
          CreateModal(){
            this.editMode = false;
            this.form.reset();
            $('#photo').val(''); 
            this.avatar = null;
            $('#addTypes').modal('show');
          },
          DeleteTypes(id){
              Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                  if (result.value) {
                  //this.form.delete('api/type/'+id)
                  axios.delete('api/type/'+id)
                  Fire.$emit('AfterCr');
                      toast.fire({
                        icon: 'success',
                        title: 'Data deleted successfully'
                      });
                  }

              })
          },
          viewItem(){
            this.$Progress.start();
            axios.get("api/type").then(({data}) => (this.types = data));
            this.$Progress.finish();
          },
          NewType(){
            this.$Progress.start();
            this.form.post('api/type')
            .then(() => {
                Fire.$emit('AfterCr');
                $('#addTypes').modal('hide');
                $('#photo').val('');
                toast.fire({
                  icon: 'success',
                  title: 'Types created successfully'
                });
                this.$Progress.finish();
            })
            .catch(() => {

            })


          }
        },
        created() {
            this.viewItem();
            Fire.$on('AfterCr',() => {
              this.viewItem();
            });
            //setInterval(() => this.viewItem(),2000);
        }
    }
</script>
 