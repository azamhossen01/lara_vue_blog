<template>
    <div class="row justify-content-around mt-2">
          <!-- <div class="col-8 offset-2"> -->
          <div class="col-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Categories</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                    <button class="btn btn-primary" @click="add_new_category()">Add New</button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(category,index) in categories" :key="category.id">
                        <td>{{index+1}}</td>
                        <td>{{category.name}}</td>
                        <td>
                            <button class="btn btn-warning" @click="edit_category(category)">Edit</button>
                            <button class="btn btn-danger" @click="delete_category(category.id)">Delete</button>
                        </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>




          <!-- modal -->
          <div class="modal" tabindex="-1" role="dialog" id="category_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{is_edit?'Edit Category':'Add New Category'}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                 <form action="" @submit.prevent="is_edit?update_category() : save_category()">
                <div class="modal-body">
                   
                        <div class="form-group">
                        <label>Name</label>
                        <input v-model="form.name" type="text" name="name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                        </div>
                        
                        
                   
                </div>
                <div class="modal-footer">
                    <button type="submit" v-bind:class="get_button()">{{is_edit?'Update':'Save'}}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        return {
            categories : {},
            warning  : 'btn btn-warning',
            primary : 'btn btn-primary',
            is_edit : false,
            form : new Form({
                id : '',
                name : ''
            })
        }
    },
    methods : {
        get_button(){
            return this.is_edit?this.warning:this.primary;
        },
        all_categories(){
            axios.get('all_categories')
            .then(res=>{
                this.categories = res.data
            });
        },
        add_new_category(){
            this.form.reset();
            this.form.clear();
            this.is_edit = false;
            $('#category_modal').modal('show');
        },
        save_category(){
            this.form.post('save_category')
            .then(res=>{
                Toast.fire({
                icon: 'success',
                title: res.data.message
                })
                Fire.$emit('refresh_data');
                // this.$router.push('/category');
                $('#category_modal').modal('hide');
            });
        },
        edit_category(category){
                this.form.fill(category);
                this.is_edit = true;
                $('#category_modal').modal('show');
        },
        update_category(){
          // alert(this.form.id);
          this.form.put('update_category/'+this.form.id)
          .then(res=>{
            console.log(res.data);
            $('#category_modal').modal('hide');
            Toast.fire({
                icon: 'success',
                title: res.data.message
                })
                Fire.$emit('refresh_data');
          })
          .catch(err => {
            console.log(err)
          });
        },
        delete_category(id){
          this.form.delete('delete_category/'+id)
          .then(res=>{
            Toast.fire({
                icon: 'success',
                title: res.data.message
                })
                Fire.$emit('refresh_data');
          });
        }
        
    },
    created(){
        this.all_categories();
        Fire.$on('refresh_data',()=>{
          this.all_categories();
        });
    }
}
</script>