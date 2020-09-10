<template>
    <div class="container">
        <p>gggg</p>
        <form class="form">
            <label for="discount"> Discount (Rs)</label>
            <input id="discount" style="margin-left:10px;" placeholder="10" class="pl-3" type="number">
            <button  style="margin-left:10px;" class="btn-success" type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
