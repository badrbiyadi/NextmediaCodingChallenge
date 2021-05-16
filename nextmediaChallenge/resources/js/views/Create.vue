<template>
    <div>
        <h1>Create a product</h1>
            <div class="row">
                <div class="col-9">
                    <div class="p-3 border">
                        <div v-if="created" class="alert alert-primary" role="alert">Product created</div>
                        <div class="alert alert-danger" v-if="errors.length">
                            <b>Please correct the following error(s):</b>
                            <ul>
                                <li v-bind:key="error" v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="productName" class="form-label">Product name</label>
                            <input v-model="name" type="text" class="form-control ">
                        </div>
                        <div class="form-group">
                            <label for="productName" class="form-label">Product price</label>
                            <input v-model="price" type="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="productDescription" class="form-label">Product Description</label>
                            <textarea v-model="description" class="form-control"></textarea>
                        </div>
                
                        <div class="form-group">
                            <label>Product image (not required)</label>
                            <input  type="file" class="form-control-file" @change="selectImage">
                        </div>
                        <button class="btn btn-success" @click="submitForm">Create</button>
                    </div>
                </div>
                <div class="col-3">
                    <div class="p-3 border">
                        <h2>Categories</h2>
                        <ul class="list-group">
                            <li v-bind:key="category.id" v-for="category in categories" class="list-group-item">
                                <input type="checkbox" :id="category.name+category.id" :value="category.id" v-model="checkedCategories">
                                <label :for="category.name+category.id">{{category.name}}</label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
    </div>
</template>

<script>
    export default {
        name: "Create" ,
        data: () => {
            return {
                name: null,
                description: null,
                price: null,
                categories: [],
                checkedCategories: [],
                image: null,
                created: false,
                errors: [],
                ready: false
            }  
        },
        mounted() {
            axios.get('/api/categories')
            .then( (res) => {
                this.categories = res.data.data;
                console.log(this.categories);
            })
            .catch((err) => {
                this.errors = err.message;
            })
        },
        methods: {
            selectImage(event) {
                this.image = event.target.files[0];
            },
            submitForm() {
                this.errors = [];
                this.ready = true;
                // we can do the form validation here
                if (!this.name) {
                    this.errors.push('Name required');
                    this.ready = false;
                }

                if (!this.description) {
                    this.errors.push('Description required');
                    this.ready = false;
                }

                if (!this.price) {
                    this.errors.push('Price required');
                    this.ready = false;
                }

                if (this.ready) {
                    
                    var data = new FormData()
                    data.append('name', this.name);
                    data.append('description', this.description);
                    data.append('price', this.price);
                    if (this.image) {
                        data.append('image', this.image);
                    }
                    if (this.checkedCategories.length) {
                        data.append('categories', this.checkedCategories);
                    }
                    axios.post('/api/product', data)
                    .then((res) => {
                        console.log('Product created');
                        this.created = true;
                        this.name = null;
                        this.checkedCategories = [];
                        this.description = null;
                        this.price = null;
                        this.image = null;
                    })

                }
            }
        }
    }
</script>

<style scoped>

</style>