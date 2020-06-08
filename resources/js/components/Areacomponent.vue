<template>
	  <div class="container">
     <div class="row">
        <div class="col-md-10">

          <div class="card-header">
            <h3 class="card-title">Area List</h3>

            <div class="card-tools">
            <button type="submit" class="btn btn-danger" @click="CreateModal"><span><i class="fa fa-plus"></i></span> New Area</button>
            </div>
          </div>
           <div class="card-body table-responsive p-0">
            <table class="table table-striped text-center">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(area,i) in areas.data" :key="area._id">
                    <td scope="row">{{i+1}}</td>
                    <td>{{area.name}}</td>
                    <td>{{area.created_at}}</td>
                    <td>
                      <a href="#" @click="EditModal(area)">Edit</a>
                      <a href="#" @click="DeleteArea(area._id)">Delete</a>
                    </td>
                  </tr>

                </tbody>

              </table>
            </div>
            <div class="card-footer">
               <pagination :data="areas" @pagination-change-page="getResults">
                 <span slot="prev-nav">&lt; Previous</span>
                <span slot="next-nav">Next &gt;</span>
               </pagination>
            </div>
        </div>
     </div>


      <!-- Modal -->
      <div class="modal fade" id="addArea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Area</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form @submit.prevent="editMode ? updateArea() : NewArea()">
            <div class="modal-body">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title" v-show="!editMode">CREATE AREA</h3>
                  <h3 class="box-title" v-show="editMode">UPDATE AREA</h3>
                </div>
                <div class="box-body">
                  <div class="form-group">
                    <label v-show="!editMode">Types of Area</label>
                    <label v-show="editMode">Edit Area</label>
                    <input v-model="form.name" type="text" name="name"
                      placeholder="Enter name here..." 
                      class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                  </div>
                </div>

              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" v-show="!editMode" class="btn btn-danger">Save</button>
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
            areas: {},
            form: new Form({
              _id:'',
              name: ''
            })
          }
        },
        methods:{
          getResults(page = 1) {
            axios.get('api/area?page=' + page)
              .then(response => {
                this.areas = response.data;
              });
          },
          updateArea(){
              this.$Progress.start();
              this.form.put('api/area/'+this.form._id)
              .then(() => {
                Fire.$emit('AfterCr');
                $('#addArea').modal('hide');
                toast.fire({
                  icon: 'success',
                  title: 'Area updated successfully'
                });
                this.$Progress.finish();
              })
              .catch(() => {
                this.$Progress.fail();
              })
          },
          EditModal(type){
              this.editMode = true;
              this.form.reset();

              $('#addArea').modal('show');
              this.form.fill(type);
          },
          CreateModal(){
            this.editMode = false;
            this.form.reset();
            $('#addArea').modal('show');
          },
          DeleteArea(id){
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
                  //this.form.delete('api/area/'+id)
                  axios.delete('api/area/'+id)
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
            axios.get("api/area").then(({ data }) => (this.areas = data));
            this.$Progress.finish();
          },
          NewArea(){
            this.$Progress.start();
            this.form.post('api/area')
            .then(() => {
               
                $('#addArea').modal('hide');
                toast.fire({
                  icon: 'success',
                  title: 'Types created successfully'
                });
                 Fire.$emit('AfterCr');
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
        },

    }
</script>