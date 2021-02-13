<template>
    <div>
        <h1>Create a product</h1>
        <form action="">
            <div class="mb-3">
                <label for="productName" class="form-label">Product name</label>
                <input type="text" class="form-control" id="productName" placeholder="Product name">

                <label for="productDescription" class="form-label">Product description</label>
                <textarea class="form-control" id="productDescription" rows="2"></textarea>

                <label for="productPrice" class="form-label">Product price</label>
                <input type="number" class="form-control" id="productPrice" placeholder="Product price">

                <button class="btn btn-success">Create</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
     name: "Create"   
    }
</script>

<style scoped>

</style>