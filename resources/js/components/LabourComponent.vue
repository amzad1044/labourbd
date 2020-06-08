<template>
<div>
<section class="content"> 
	<div class="row">
        <div class="col-md-12">

          <button type="submit" class="btn btn-danger" @click="OpenModal"><span><i class="fa fa-user-plus"></i></span> New Labour</button>
            <table class="table table-striped text-center">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Total Work</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Area</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Added By</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                	<tr v-for="(lab,index) in labours.data" :key="lab._id">
	                    <td >{{index+1}}</td>
                      <td>{{lab.name}}</td>
	                    <td>{{lab.totalwork}}</td>
	                    <td>{{lab.phone}}</td>
	                    <td v-if="lab.joinarea">{{lab.joinarea.name}}</td>
	                    <td v-if="lab.jointype">{{lab.jointype.name}}</td>
	                    <td>{{lab.price}}</td>
	                    <td>
	                      <img :src="img(lab.photo)" style="height: 70px;width: 70px">
	                    </td>
	                    <td v-if="lab.joinuser">{{lab.joinuser.name}}</td>


                      <td v-if="lab.status==0" class="text-green">FREE</td>
                      <td v-if="lab.status==1" class="text-warning">ON WORKING</td>

	                    <td>
	                    	<a href="#" @click="EditLab(lab)" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
	                      	<a href="#" @click="Delete_labr(lab._id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>

	                    </td>
                  	</tr>
                    <pagination :data="labours" @pagination-change-page="getResults"></pagination>
                </tbody>
              </table>
        </div>
      </div>    
      </section>



      <!-- Modal -->
      <div class="modal fade" id="addLabour" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 v-show="!editModal" class="modal-title" id="exampleModalLabel">Labour</h5>
              <h5 v-show="editModal" class="modal-title" id="exampleModalLabel">Edit Labour</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form @submit.prevent="editModal ? UpdateLab() : NewLabour()">
            <div class="modal-body">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 v-show="!editModal" class="box-title">CREATE LABOUR</h3>
                  <h3 v-show="editModal" class="box-title">UPDATE LABOUR</h3>
                </div>

                <div class="box-body">
                  <div class="form-group">
                    <label >Name</label>
                    <input v-model="form.name" type="text" name="name"
                      placeholder="Enter name here..." 
                      class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                  </div>

                  <div class="form-group">
                    <label >Phone</label>
                    <input v-model="form.phone" type="text" name="phone"
                      placeholder="Enter phone number here..." 
                      class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                    <has-error :form="form" field="phone"></has-error>
                  </div>

                   <div class="form-group">
                    <label >Area</label>
                    <select class="form-control" :class="{ 'is-invalid': form.errors.has('areaId') }" v-model="form.areaId">
                    	<option disabled value="" >Select One</option>
                    	<option v-for="area in areas" :value="area._id">{{area.name}}</option>
                    </select>
                  </div>


                   <div class="form-group">
                    <label >Worker Type</label>
                    <select  name="typeId" class="form-control" :class="{ 'is-invalid': form.errors.has('typeId') }" v-model="form.typeId">
                    	<option disabled value="" >Select One</option>
                    	<option :value="type._id" v-for="type in types">{{type.name}}</option>
                    </select>
                  </div>

                   <div class="form-group">
                    <label >Price</label>
                    <input v-model="form.price" type="text" name="price"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
                    <has-error :form="form" field="price"></has-error>
                  </div>

                  	<div class="form-group">
	                    <label >Photo</label>
	                    <div class="col-sm-12" >
	                        <input @change="changePhoto($event)" id="photo" type="file" :class="{ 'is-invalid': form.errors.has('photo') }" name="photo" class="form-input"><br>
	                        <img  v-show="!editModal" :src="avatar"  alt="Image" style="height: 70px;width: 70px"/>
	                        <img v-show="editModal" :src="updateViewImage()" alt="" style="height: 70px;width: 70px">
	                        <has-error :form="form" field="photo"></has-error>
	                    </div>
                	</div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button v-show="!editModal" type="submit" class="btn btn-danger">Save</button>
              <button v-show="editModal" type="submit" class="btn btn-success">Update</button>
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
          	editModal:false,
          	labours:{},
          	types:{},
          	areas:{},
            avatar:null,
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
          getResults(page = 1) {
            axios.get('api/labour?page=' + page)
              .then(response => {
                this.labours = response.data;
              });
          },
        	updateViewImage(){
                let img = this.form.photo;
                if(img.length>100){
                    return  this.form.photo
                }else{
                    return `img_upload/labour/${this.form.photo}`
                }
        	},
        	UpdateLab(){
        	this.$Progress.start();
              this.form.put('api/labour/'+this.form._id)
              .then(() => {
                Fire.$emit('reloadView');
                $('#addLabour').modal('hide');
                this.avatar = null;
                toast.fire({
                  icon: 'success',
                  title: 'Labour updated successfully'
                });
                this.$Progress.finish();
              })
              .catch(() => {
                this.$Progress.fail();
              })
          	}, 
        	EditLab(lab){
        		this.editModal= true;
        		$('#addLabour').modal('show');
        		this.form.fill(lab);
        	},
        	Delete_labr(id){
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
                  axios.delete('api/labour/'+id)
                  Fire.$emit('reloadView');
                      toast.fire({
                        icon: 'success',
                        title: 'Labour deleted successfully'
                      });
                  }

              })
          },
        	img(image){
              return "img_upload/labour/"+image;
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
	        NewLabour(){
	            this.$Progress.start();
	            this.form.post('api/labour')
	            .then(() => {
	                Fire.$emit('reloadView');
	                $('#addLabour').modal('hide');
	                $('#photo').val('');
	                this.avatar = null;
	                toast.fire({
	                  icon: 'success',
	                  title: 'Labour added successfully'
	                });
	                this.$Progress.finish();
	            })
	            .catch(() => {

	            })

	        },
        	getType(){
        		return axios.get("api/typesinlab").then(({data}) => (this.types = data));
        	},
        	getArea(){
            	axios.get("api/areasinlab").then(({data}) => (this.areas = data));
        	},
	        OpenModal(){
	        	this.editModal = false;
	            this.form.reset();
	            $('#photo').val(''); 
	            $('#addLabour').modal('show');
	          },
	        viewItem(){
	            this.$Progress.start();
	            axios.get("api/labour").then(({data}) => (this.labours = data));
	            this.$Progress.finish();
          },
        },
       created() {
            this.viewItem();
            Fire.$on('reloadView',() => {
              this.viewItem();
            });

            this.getType();
            this.getArea();

        }
    }
</script>