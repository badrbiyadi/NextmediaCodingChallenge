<template>
    <div>   
        <div class="row">
            <div class="col-6">
                <div class="py-3 ">
                    <h1>Sort by</h1>
                    <p>By clicking on the header of tables you will sort by field clicked</p>
                </div>

            </div>
            <div class="col-6">

                <div class="py-3 ">
                    <h1>Filter by categories</h1>
                    <div v-bind:key="category.id" v-for="category in categories" class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" :id="category.name+category.id" :value="category.id">
                        <label class="form-check-label" :for="category.name+category.id">{{ category.name }}</label>
                    </div>
                </div>
            </div>
        </div>

        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        Image
                    </th>
                    <th scope="col">
                        <a href="#" @click="sortBy('name')">Name</a>
                    </th>
                    <th scope="col">
                        <a href="#" @click="sortBy('price')" >Price</a>
                    </th>
                    <th scope="col">
                        Categories
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr  :key="product.id" v-for="product in products">
                    <td>
                        <div class="product-image">
                            <img class="img-fluid" :src="(product.image) ? product.image : '//getbootstrap.com/docs/4.0/assets/brand/bootstrap-social-logo.png'" alt="">
                        </div>
                    </td>
                    <td>
                        <h2>{{ product.name }}</h2>
                    </td>
                    <td>
                        <p>{{ product.price }}</p>
                    </td>
                    <td>
                        <span v-bind:key="category.id" v-for="category in product.categories">{{ category.name }} / </span>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
</template>

<script> 

    export default {
        name: "List" ,
        data() {
            return {
                products: [],
                categories: []
            }  
        },
        mounted() {
            axios.get('/api/products')
            .then( res => {
                this.products = res.data.data;
            })
            .catch( err => {
                console.log('products not imported')
            });

            axios.get('/api/categories')
            .then( res => {
                this.categories = res.data.data;
            })
            .catch( err => {
                console.log('categories not imported')
            });
        },
        methods: {
            sortBy(prop) {
                this.products.sort( (a,b) => a[prop] < b[prop] ? -1 : 1 );
            }
        }
    }
</script>

<style scoped>
    .product-image {
        width: 50px;
        margin-right: 2rem;
    }
</style>