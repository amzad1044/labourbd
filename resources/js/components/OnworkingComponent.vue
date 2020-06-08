<template>
	  <div class="container">
     <div class="row">
        <div class="col-md-10">

          <div class="card-header">
            <h3 class="card-title">On working</h3>

            <div class="card-tools">
            </div>
          </div>
           <div class="card-body table-responsive p-0">
            <table class="table table-striped text-center">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Client Name</th>
                    <th scope="col">Client Phone</th>
                    <th scope="col">Labour Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(working,i) in workings.data" :key="working._id">
                  	<td scope="row">{{i+1}}</td>
                    <td >{{working.clientName}}</td>
                    <td>{{working.clientPhone}}</td>

                    <td v-if="working.joinlab">{{working.joinlab.name}}</td>
                    <td v-if="working.joinlab">{{working.joinlab.price}}</td>
                    <td v-if="working.status==1" class="text-warning">On working</td>
                    <td v-if="working.status==2" class="text-yellow">New Request</td>
                    <td v-if="working.status==0" class="text-green">Completed</td>

                    <td>
                    	<a href="#" @click="ViewRequest(working)">View</a>
                      	<a href="#" @click="DeleteWork(working._id)">Delete</a>
                    </td>
                  </tr>

                </tbody>
               <pagination :data="workings" @pagination-change-page="getResults">
                 <span slot="prev-nav">&lt; Previous</span>
                <span slot="next-nav">Next &gt;</span>
               </pagination>
              </table>
            </div>
            <div class="card-footer">
            </div>
        </div>
     </div>

      <!-- Modal -->
      <div class="modal fade" id="RqstModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Request Action</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
	            <form>
	            	<div class="modal-body">
	            		<div class="text-center">
	            		<h2>Request Action</h2>
						<div class="row">
							<div class="col-md-12">
								<p><span>Client Name</span> : {{this.form.clientName}}</p>
								<p><span>Client Phone</span> : {{this.form.clientPhone}}</p>
							</div>

						</div>
	            		</div>
	            	</div>
		            <div class="modal-footer">
		            	<div class="text-center">
						<button type="submit" v-if="this.form.status==2" @click.prevent="RequestUpdate()" class="btn btn-primary">Accept</button>
						<button type="submit" v-if="this.form.status==1" @click.prevent="CompleteWork()" class="btn btn-success">Complete</button>
						</div>
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
            workings: {},
            form: new Form({
            	_id:'',
            	labourid:'',
            	clientName:'',
            	clientPhone:'',
              status:''
            })
          }
        },
        methods:{
          DeleteWork(id){
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
                  axios.delete('api/work/'+id)
                  Fire.$emit('Afterreload');
                      toast.fire({
                        icon: 'success',
                        title: 'Data deleted successfully'
                      });
                  }

              })
          },
          getResults(page = 1) {
            axios.get('api/work?page=' + page)
              .then(response => {
                this.workings = response.data;
              });
          },
        	CompleteWork(){
              this.$Progress.start();
              this.form.post('api/completeWork/'+this.form._id)
              .then(() => {
                Fire.$emit('Afterreload');
                $('#RqstModal').modal('hide');
                toast.fire({
                  icon: 'success',
                  title: 'Work Complete Successfully'
                });
                this.$Progress.finish();
              })
              .catch(() => {
                this.$Progress.fail();
              })
              this.form.post('api/DoneWorkLab/'+this.form.labourid)
        	},
        	RequestUpdate(){
              this.$Progress.start();
              this.form.put('api/work/'+this.form._id)
              .then(() => {
                Fire.$emit('Afterreload');
                $('#RqstModal').modal('hide');
                toast.fire({
                  icon: 'success',
                  title: 'Request Accepted'
                });
                this.$Progress.finish();
              })
              .catch(() => {
                this.$Progress.fail();
              })
              this.form.post('api/updateReq/'+this.form.labourid)
        	},
          	ViewRequest(work){
              	$('#RqstModal').modal('show');
              	this.form.fill(work);
          	},
	          	viewItem(){
	            this.$Progress.start();
	            axios.get("api/work").then(({ data }) => (this.workings = data));
	            this.$Progress.finish();
          },
        },
        created() {
            this.viewItem();
            Fire.$on('Afterreload',() => {
              this.viewItem();
            });
        },
	 }
</script>